<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use App\Models\Payment;
use App\Models\User;
use App\Queries\AccountDataTable;
use App\Repositories\AccountRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AccountController extends AppBaseController
{
    /** @var AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return Datatables::of((new AccountDataTable())->get($request->only([
                'account_status', 'account_type',
            ])))->make(true);
        }
        $data['statusArr'] = Account::STATUS_ARR;
        $data['typeArr'] = Account::TYPE_ARR;

        return view('accounts.index')->with($data);
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param  CreateAccountRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $this->accountRepository->create($input);

        return $this->sendSuccess('Account saved successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $account = Account::find($id);
        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }
        $payments = $account->payments;

        return view('accounts.show', compact('payments', 'account'));
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  Account  $account
     *
     * @return JsonResponse
     */
    public function edit(Account $account)
    {
        return $this->sendResponse($account, 'Account retrived successfully.');
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  Account  $account
     * @param  UpdateAccountRequest  $request
     *
     * @return JsonResponse
     */
    public function update(Account $account, UpdateAccountRequest $request)
    {
        $this->accountRepository->update($request->all(), $account->id);

        return $this->sendSuccess('Account updated successfully.');
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  Account  $account
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Account $account)
    {
        $accountModel = [
            Payment::class,
        ];
        $result = canDelete($accountModel, 'account_id', $account->id);
        if ($result) {
            return $this->sendError('Account can\'t be deleted.');
        }
        $this->accountRepository->delete($account->id);

        return $this->sendSuccess('Account deleted successfully.');
    }

    /**
     * @param  Account  $account
     *
     * @return JsonResponse
     */
    public function activeDeactiveAccount(Account $account)
    {
        $account->status = ! $account->status;
        $account->save();

        return $this->sendSuccess('Account updated successfully.');
    }
}
