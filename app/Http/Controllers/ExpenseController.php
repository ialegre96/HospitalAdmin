<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseExport;
use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Queries\ExpenseDataTable;
use App\Repositories\ExpenseRepository;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExpenseController extends AppBaseController
{
    /**
     * @var ExpenseRepository
     */
    private $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View
     * @throws Exception
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return \DataTables::of((new ExpenseDataTable())
                ->get($request->only(['expense_head'])))
                ->make(true);
        }
        $expenseHeads = Expense::EXPENSE_HEAD;
        asort($expenseHeads);
        $filterExpenseHeads = Expense::FILTER_EXPENSE_HEAD;
        asort($filterExpenseHeads);

        return view('expenses.index', compact('expenseHeads', 'filterExpenseHeads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateExpenseRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateExpenseRequest $request)
    {
        $input = $request->all();
        $input['amount'] = removeCommaFromNumbers($input['amount']);
        $this->expenseRepository->store($input);
        $this->expenseRepository->createNotification($input);

        return $this->sendSuccess('Expense saved successfully.');
    }

    /**
     * @param  Expense  $expense
     *
     * @return Application|Factory|View
     */
    public function show(Expense $expense)
    {
        $expenses = $this->expenseRepository->find($expense->id);
        $expenseHeads = Expense::EXPENSE_HEAD;
        asort($expenseHeads);

        return view('expenses.show', compact('expenses', 'expenseHeads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Expense  $expense
     *
     * @return JsonResponse
     */
    public function edit(Expense $expense)
    {
        return $this->sendResponse($expense, 'Expense retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateExpenseRequest  $request
     *
     * @param  Expense  $expense
     *
     * @return JsonResponse
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $this->expenseRepository->updateExpense($request->all(), $expense->id);

        return $this->sendSuccess('Expense update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Expense  $expense
     *
     * @return JsonResponse
     * @throws Exception
     *
     */
    public function destroy(Expense $expense)
    {
        $this->expenseRepository->deleteDocument($expense->id);

        return $this->sendSuccess('Expense delete successfully');
    }

    /**
     * @param  Expense  $expense
     *
     * @return ResponseFactory|\Illuminate\Http\Response
     * @throws FileNotFoundException
     *
     */
    public function downloadMedia(Expense $expense)
    {
        $documentMedia = $expense->media[0];
        $documentPath = $documentMedia->getPath();
        if (config('app.media_disc') === 'public') {
            $documentPath = (Str::after($documentMedia->getUrl(), '/uploads'));
        }

        $file = Storage::disk(config('app.media_disc'))->get($documentPath);

        $headers = [
            'Content-Type' => $expense->media[0]->mime_type,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={$expense->media[0]->file_name}",
            'filename' => $expense->media[0]->file_name,
        ];

        return response($file, 200, $headers);
    }

    /**
     * @return BinaryFileResponse
     */
    public function expenseExport()
    {
        return Excel::download(new ExpenseExport, 'expenses-'.time().'.xlsx');
    }
}
