<?php

namespace App\Repositories;

use App\Models\Package;
use App\Models\PackageService;
use Exception;

/**
 * Class PackageServiceItemsRepository
 * @version February 13, 2020, 9:51 am UTC
 */
class PackageServiceItemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'service_id',
        'package_id',
        'quantity',
        'rate',
        'amount',
    ];

    /**
     * Return searchable fields
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
        return PackageService::class;
    }

    /**
     * @param  array  $packageServiceItemInput
     * @param  int  $packageId
     *
     * @throws Exception
     */
    public function updatePackageServiceItem($packageServiceItemInput, $packageId)
    {
        /** @var Package $package */
        $package = Package::find($packageId);
        $packageServiceItemIds = [];
        foreach ($packageServiceItemInput as $key => $data) {
            if (isset($data['id']) && ! empty($data['id'])) {
                $packageServiceItemIds[] = $data['id'];
                $this->update($data, $data['id']);
            } else {
                /** @var PackageService $packageServiceItem */
                $packageServiceItem = new PackageService($data);
                $packageServiceItem = $package->packageServicesItems()->save($packageServiceItem);
                $packageServiceItemIds[] = $packageServiceItem->id;
            }
        }

        if (! (isset($packageServiceItemIds) && count($packageServiceItemIds))) {
            return;
        }
        PackageService::whereNotIn('id', $packageServiceItemIds)->wherePackageId($package->id)->delete();
    }
}
