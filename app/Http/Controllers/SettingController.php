<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\UpdateSuperAdminFooterSettingRequest;
use App\Http\Requests\UpdateSuperAdminSettingRequest;
use App\Models\Module;
use App\Models\SuperAdminSetting;
use App\Queries\ModuleDataTable;
use App\Repositories\SettingRepository;
use Flash;
use http\Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Spatie\MediaLibrary\Exceptions\MediaCannotBeDeleted;
use Yajra\DataTables\DataTables;

class SettingController extends AppBaseController
{
    /** @var SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Show the form for editing the specified Setting.
     *
     * @param  Request  $request
     *
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $settings = $this->settingRepository->getSyncList();
        $currencies = getCurrencies();
        $statusArr = Module::STATUS_ARR;
        $sectionName = ($request->section === null) ? 'general' : $request->section;

        return view("settings.$sectionName", compact('currencies', 'settings', 'statusArr', 'sectionName'));
    }

    /**
     * Update the specified Setting in storage.
     *
     * @param  UpdateSettingRequest  $request
     *
     * @throws DiskDoesNotExist
     *
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     *
     * @throws MediaCannotBeDeleted
     *
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->settingRepository->updateSetting($request->all());

        Flash::success('Setting updated successfully.');

        return redirect(route('settings.edit'));
    }

    /**
     * Display a listing of the Module.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function getModule(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new ModuleDataTable())->get($request->only(['status'])))->make(true);
        }
    }

    /**
     * @param  Module  $module
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus(Module $module)
    {
        $is_active = ! $module->is_active;
        $module->update(['is_active' => $is_active]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * Show the form for editing the specified Setting.
     *
     * @param  Request  $request
     *
     * @return Factory|View
     */
    public function editSuperAdminSettings(Request $request)
    {
        $settings = $this->settingRepository->getSyncListForSuperAdmin();
        $sectionName = ($request->section === null) ? 'general' : $request->section;

        return view("super_admin_settings.$sectionName", compact('settings', 'sectionName'));
    }

    /**
     * Update the specified Setting in storage.
     *
     * @param  UpdateSuperAdminSettingRequest  $request
     *
     * @throws DiskDoesNotExist
     *
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     *
     * @throws MediaCannotBeDeleted
     *
     * @return RedirectResponse|Redirector
     */
    public function updateSuperAdminSettings(UpdateSuperAdminSettingRequest $request)
    {
        $this->settingRepository->updateSuperAdminSetting($request->all());

        Flash::success('Setting updated successfully.');

        return redirect(route('super.admin.settings.edit'));
    }

    /**
     * @return Factory|View
     */
    public function editSuperAdminFooterSettings()
    {
        $settings = SuperAdminSetting::pluck('value', 'key')->toArray();

        return view("super_admin_footer_settings.index", compact('settings'));
    }

    /**
     * @param  UpdateSuperAdminFooterSettingRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function updateSuperAdminFooterSettings(UpdateSuperAdminFooterSettingRequest $request)
    {
        $this->settingRepository->updateSuperFooterAdminSetting($request->all());

        Flash::success('Setting updated successfully.');

        return redirect(route('super.admin.footer.settings.edit'));
    }
}
