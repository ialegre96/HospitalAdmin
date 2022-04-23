<?php

namespace App\Repositories;

use App;
use App\Models\IpdPayment;
use App\Models\Transaction;
use DB;
use Exception;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class StripeRepository
 */
class StripeRepository
{
    public function patientPaymentSuccess($sessionId)
    {
        setStripeApiKey();

        $sessionData = \Stripe\Checkout\Session::retrieve($sessionId);

        $stripeID = $sessionData->id;
        $paymentStatus = $sessionData->payment_status;
        $amount = $sessionData->amount_total / 100;
        $ipdPaientId = $sessionData->client_reference_id;
        $userId = getLoggedInUserId();

        $transactionData = [
            'transaction_id' => $stripeID,
            'amount'         => $amount,
            'user_id'        => $userId,
            'status'         => $paymentStatus,
            'meta'           => $sessionData->toArray(),
        ];
        try {
            DB::beginTransaction();

            $transaction = Transaction::create($transactionData);

            $ipdPaymentData = [
                'transaction_id'            => $transaction->id,
                'ipd_patient_department_id' => $ipdPaientId,
                'payment_mode'              => IpdPayment::PAYMENT_MODES_STRIPE,
                'date'                      => Carbon::now(),
                'amount'                    => $amount,
            ];

            $ipdPayment = App::make(IpdPaymentRepository::class);
            $ipdPayment->store($ipdPaymentData);

            // update ipd bill
            $ipdPatientDepartment = App\Models\IpdPatientDepartment::findOrFail($ipdPaientId);
            $ipdBill = $ipdPatientDepartment->bill;
            if ($ipdBill) {
                $ipdBill->total_payments = $ipdBill->total_payments + $amount;
                $ipdBill->net_payable_amount = $ipdBill->net_payable_amount - $amount;
                $ipdBill->save();

                $ipdPatientDepartment->bill_status = 1;
                $ipdPatientDepartment->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
