<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemStockRequest;
use App\Http\Requests\UpdateItemStockRequest;
use App\Models\ItemStock;
use App\Queries\ItemStockDataTable;
use App\Repositories\ItemStockRepository;
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

class ItemStockController extends AppBaseController
{
    /** @var ItemStockRepository */
    private $itemStockRepository;

    public function __construct(ItemStockRepository $itemStockRepo)
    {
        $this->middleware('check_menu_access');
        $this->itemStockRepository = $itemStockRepo;
    }

    /**
     * Display a listing of the ItemStock.
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
            return Datatables::of((new ItemStockDataTable())->get())->make(true);
        }

        return view('item_stocks.index');
    }

    /**
     * Show the form for creating a new ItemStock.
     *
     * @return Factory|View
     */
    public function create()
    {
        $itemCategories = $this->itemStockRepository->getItemCategories();
        natcasesort($itemCategories);

        return view('item_stocks.create', compact('itemCategories'));
    }

    /**
     * Store a newly created ItemStock in storage.
     *
     * @param  CreateItemStockRequest  $request
     *
     * @throws Throwable
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateItemStockRequest $request)
    {
        $input = $request->all();
        $input['purchase_price'] = removeCommaFromNumbers($input['purchase_price']);
        $this->itemStockRepository->store($input);
        Flash::success('Item Stock saved successfully.');

        return redirect(route('item.stock.index'));
    }

    /**
     * Display the specified ItemStock.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $itemStock = ItemStock::findOrFail($id);

        return view('item_stocks.show', compact('itemStock'));
    }

    /**
     * Show the form for editing the specified ItemStock.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $itemStock = ItemStock::findOrFail($id);
        $itemCategories = $this->itemStockRepository->getItemCategories();
        natcasesort($itemCategories);

        return view('item_stocks.edit', compact('itemCategories', 'itemStock'));
    }

    /**
     * Update the specified ItemStock in storage.
     *
     * @param  ItemStock  $itemStock
     * @param  UpdateItemStockRequest  $request
     *
     * @throws Throwable
     *
     * @return RedirectResponse|Redirector
     */
    public function update(ItemStock $itemStock, UpdateItemStockRequest $request)
    {
        $input = $request->all();
        $input['purchase_price'] = removeCommaFromNumbers($input['purchase_price']);
        $this->itemStockRepository->update($itemStock, $input);
        Flash::success('Item Stock updated successfully.');

        return redirect(route('item.stock.index'));
    }

    /**
     * Remove the specified ItemStock from storage.
     *
     * @param  ItemStock  $itemStock
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(ItemStock $itemStock)
    {
        $this->itemStockRepository->destroyItemStock($itemStock);

        return $this->sendSuccess('Item Stock deleted successfully.');
    }

    /**
     * @param  ItemStock  $itemStock
     *
     * @return string
     */
    public function downloadMedia(ItemStock $itemStock)
    {
        list($file, $headers) = $this->itemStockRepository->downloadMedia($itemStock);

        return response($file, 200, $headers);
    }
}
