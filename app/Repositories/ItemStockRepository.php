<?php

namespace App\Repositories;

use App\Models\ItemCategory;
use App\Models\ItemStock;
use Arr;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Storage;
use Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

/**
 * Class ItemStockRepository
 * @version August 26, 2020, 12:50 pm UTC
 */
class ItemStockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_category_id',
        'item_id',
        'supplier_name',
        'store_name',
        'quantity',
        'purchase_price',
        'description',
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
        return ItemStock::class;
    }

    /**
     * @return array
     */
    public function getItemCategories()
    {
        return ItemCategory::all()->pluck('name', 'id')->toArray();
    }

    /**
     * @param $input
     *
     * @throws Throwable
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $itemStockInputArray = Arr::except($input, ['attachment']);
            /** @var ItemStock $itemStock */
            $itemStock = $this->create($itemStockInputArray);
            $itemStock->item()->update(['available_quantity' => $itemStockInputArray['quantity']]);

            if (isset($input['attachment']) && ! empty($input['attachment'])) {
                $itemStock->addMedia($input['attachment'])->toMediaCollection(ItemStock::PATH,
                    config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  ItemStock  $itemStock
     * @param  array  $input
     *
     * @throws Throwable
     *
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($itemStock, $input)
    {
        try {
            DB::beginTransaction();

            $itemStockInputArray = Arr::except($input, ['attachment']);
            $newItemQty = abs($itemStock->quantity - $itemStockInputArray['quantity']);
            if ($itemStockInputArray['quantity'] !== $itemStock->quantity) {
                if ($itemStockInputArray['quantity'] < $itemStock->quantity) {
                    $newItemAvailableQty = $itemStock->item->available_quantity - $newItemQty;
                } else {
                    $newItemAvailableQty = $itemStock->item->available_quantity + $newItemQty;
                }

                $itemStock->item()->update(['available_quantity' => $newItemAvailableQty]);
            }
            $itemStock->update($itemStockInputArray);
            if (isset($input['attachment']) && !empty($input['attachment'])) {
                if ($itemStock->media->first() != null) {
                    $itemStock->deleteMedia($itemStock->media->first()->id);
                }
                $itemStock->addMedia($input['attachment'])->toMediaCollection(ItemStock::PATH,
                    config('app.media_disc'));
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($itemStock, ItemStock::PATH);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  ItemStock  $itemStock
     */
    public function destroyItemStock($itemStock)
    {
        try {
            $newItemAvailableQty = $itemStock->item->available_quantity - $itemStock->quantity;
            $itemStock->item()->update(['available_quantity' => $newItemAvailableQty]);
            /** @var ItemStock $itemStock */
            $attachment = $this->find($itemStock->id);
            if ($attachment->media->first() !== null) {
                $attachment->deleteMedia($attachment->media->first()->id);
            }
            $this->delete($itemStock->id);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $itemStock
     *
     * @return array
     */
    public function downloadMedia($itemStock)
    {
        try {
            $documentMedia = $itemStock->media()->first();
            $documentPath = $documentMedia->getPath();
            if (config('app.media_disc') === 'public') {
                $documentPath = (Str::after($documentMedia->getUrl(), '/uploads'));
            }
            $file = Storage::disk(config('app.media_disc'))->get($documentPath);

            $headers = [
                'Content-Type'        => $itemStock->media[0]->mime_type,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$itemStock->media[0]->file_name}",
                'filename'            => $itemStock->media[0]->file_name,
            ];

            return [$file, $headers];
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
