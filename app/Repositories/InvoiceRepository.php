<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Accountant;
use App\Models\BillItems;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Models\Setting;
use App\Models\User;
use Arr;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Validator;

/**
 * Class InvoiceRepository
 * @version February 24, 2020, 5:51 am UTC
 */
class InvoiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'invoice_date',
        'amount',
        'status',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Invoice::class;
    }

    /**
     * @return mixed
     */
    public function getSyncList()
    {
        $invoiceRepo = app(BillRepository::class);
        $data['accounts'] = Account::whereStatus(1)->orderBy('name', 'asc')->pluck('name', 'id');
        $data['associateAccounts'] = $this->getAssociateAccountList();
        $data['patients'] = $invoiceRepo->getPatientList();
        $invoiceStatusArr = Invoice::STATUS_ARR;
        unset($invoiceStatusArr[Invoice::STATUS_ALL]);
        $data['statusArr'] = $invoiceStatusArr;

        return $data;
    }

    /**
     * @return array
     */
    public function getAssociateAccountList()
    {
        $result = Account::whereStatus(1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $accounts = [];
        foreach ($result as $key => $item) {
            $accounts[] = [
                'key'   => $key,
                'value' => $item,
            ];
        }

        return $accounts;
    }

    /**
     * @param  array  $input
     *
     * @return Invoice
     */
    public function saveInvoice($input)
    {
        $invoiceItemInputArray = Arr::only($input, ['account_id', 'description', 'quantity', 'price']);
        $invoiceExist = Invoice::where('invoice_id', $input['invoice_id'])->exists();
        if($invoiceExist){
            throw new UnprocessableEntityHttpException('Invoice id already exist');
            return false;
        }
//        $input['invoice_id'] = Invoice::generateUniqueInvoiceId();
        /** @var Invoice $invoice */
        $invoice = $this->create(Arr::only($input, ['patient_id', 'invoice_date', 'discount', 'status', 'invoice_id']));
        $totalAmount = 0;

        $invoiceItemInput = $this->prepareInputForInvoiceItem($invoiceItemInputArray);
        foreach ($invoiceItemInput as $key => $data) {
            $validator = Validator::make($data, InvoiceItem::$rules);

            if ($validator->fails()) {
                throw new UnprocessableEntityHttpException($validator->errors()->first());
            }

            $data['total'] = $data['price'] * $data['quantity'];
            $totalAmount += $data['total'];

            /** @var BillItems $invoiceItem */
            $invoiceItem = new InvoiceItem($data);
            $invoice->invoiceItems()->save($invoiceItem);
        }
        $invoice->amount = $totalAmount;
        $invoice->save();

        return $invoice;
    }

    /**
     * @param  array  $input
     *
     * @return array
     */
    public function prepareInputForInvoiceItem($input)
    {
        $items = [];
        foreach ($input as $key => $data) {
            foreach ($data as $index => $value) {
                $items[$index][$key] = $value;
                if (! (isset($items[$index]['price']) && $key == 'price')) {
                    continue;
                }
                $items[$index]['price'] = removeCommaFromNumbers($items[$index]['price']);
            }
        }

        return $items;
    }

    public function updateInvoice($invoiceId, $input)
    {
        $invoiceItemInputArr = Arr::only($input, ['account_id', 'description', 'quantity', 'price', 'id']);

        /** @var Invoice $invoice */
        $invoice = $this->update(Arr::only($input, ['patient_id', 'invoice_date', 'discount', 'status']), $invoiceId);
        $totalAmount = 0;

        $invoiceItemInput = $this->prepareInputForInvoiceItem($invoiceItemInputArr);
        foreach ($invoiceItemInput as $key => $data) {
            $validator = Validator::make($data, InvoiceItem::$rules, [
                'account_id.integer' => 'Please select an account',
            ]);

            if ($validator->fails()) {
                throw new UnprocessableEntityHttpException($validator->errors()->first());
            }

            $data['total'] = $data['price'] * $data['quantity'];
            $invoiceItemInput[$key] = $data;
            $totalAmount += $data['total'];
        }
        /** @var InvoiceItemRepository $invoiceItemRepo */
        $invoiceItemRepo = app(InvoiceItemRepository::class);
        $invoiceItemRepo->updateInvoiceItem($invoiceItemInput, $invoice->id);

        $invoice->amount = $totalAmount;
        $invoice->save();

        return $invoice;
    }

    /**
     * @param  null  $invoiceId
     *
     * @return mixed
     */
    public function getSyncListForCreate($invoiceId = null)
    {
        $data['setting'] = Setting::all()->pluck('value', 'key')->toArray();

        return $data;
    }

    /**
     * @param  array  $input
     */
    public function saveNotification($input)
    {
        $patient = Patient::with('user')->where('id', $input['patient_id'])->first();
        $receptionists = Receptionist::pluck('user_id', 'id')->toArray();
        $accountants = Accountant::pluck('user_id', 'id')->toArray();
        $status = $input['status'] == 0 ? Invoice::STATUS_ARR[Invoice::PENDING] : Invoice::STATUS_ARR[Invoice::PAID];
        $userIds = [
            $patient->user_id => Notification::NOTIFICATION_FOR[Notification::PATIENT],
        ];

        foreach ($receptionists as $key => $userId) {
            $userIds[$userId] = Notification::NOTIFICATION_FOR[Notification::RECEPTIONIST];
        }

        foreach ($accountants as $key => $userId) {
            $userIds[$userId] = Notification::NOTIFICATION_FOR[Notification::ACCOUNTANT];
        }

        $adminUser = User::role('Admin')->first();
        $allUsers = $userIds + [$adminUser->id => Notification::NOTIFICATION_FOR[Notification::ADMIN]];
        $users = getAllNotificationUser($allUsers);

        foreach ($users as $key => $notification) {
            if ($notification == Notification::NOTIFICATION_FOR[Notification::PATIENT]) {
                $title = $patient->user->full_name.' your invoice has been '.$status;
            } else {
                $title = $patient->user->full_name.' invoice has been '.$status;
            }

            addNotification([
                Notification::NOTIFICATION_TYPE['Invoice'],
                $key,
                $notification,
                $title,
            ]);
        }
    }
}
