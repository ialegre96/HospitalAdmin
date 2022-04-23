<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateIssuedItemRequest;
use App\Http\Requests\UpdateIssuedItemRequest;
use App\Models\IssuedItem;
use App\Queries\IssuedItemDataTable;
use App\Repositories\IssuedItemRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Throwable;

class IssuedItemController extends AppBaseController
{
    /** @var IssuedItemRepository */
    private $issuedItemRepository;

    public function __construct(IssuedItemRepository $issuedItemRepo)
    {
        $this->middleware('check_menu_access');
        $this->issuedItemRepository = $issuedItemRepo;
    }

    /**
     * Display a listing of the IssuedItem.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new IssuedItemDataTable())->get($request->only(['status'])))->make(true);
        }
        $data['statusArr'] = IssuedItem::STATUS_ARR;

        return view('issued_items.index')->with($data);
    }

    /**
     * Show the form for creating a new IssuedItem.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->issuedItemRepository->getAssociatedData();

        return view('issued_items.create', compact('data'));
    }

    /**
     * Store a newly created IssuedItem in storage.
     *
     * @param  CreateIssuedItemRequest  $request
     *
     * @throws Throwable
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateIssuedItemRequest $request)
    {
        $input = $request->all();
        $input['return_date'] = ! empty($input['return_date']) ? $input['return_date'] : null;
        $this->issuedItemRepository->store($input);
        Flash::success('Issued Item saved successfully.');

        return redirect(route('issued.item.index'));
    }

    /**
     * Display the specified IssuedItem.
     *
     * @param  IssuedItem  $issuedItem
     *
     * @return Factory|View
     */
    public function show(IssuedItem $issuedItem)
    {
        return view('issued_items.show', compact('issuedItem'));
    }

    /**
     * Remove the specified IssuedItem from storage.
     *
     * @param  IssuedItem  $issuedItem
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(IssuedItem $issuedItem)
    {
        $this->issuedItemRepository->destroyIssuedItemStock($issuedItem);

        return $this->sendSuccess('Issued Item deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function returnIssuedItem(Request $request)
    {
        $this->issuedItemRepository->returnIssuedItem($request->id);

        return $this->sendSuccess('Item returned successfully.');
    }
}
