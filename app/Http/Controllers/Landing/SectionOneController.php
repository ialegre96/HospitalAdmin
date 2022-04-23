<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateSectionOneRequest;
use App\Http\Requests\UpdateSectionTwoRequest;
use App\Models\SectionOne;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SectionOneController extends AppBaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $sectionOne = SectionOne::first();

        return view('landing.section_one.index', compact('sectionOne'));
    }

    /**
     * @param  UpdateSectionOneRequest  $request
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function update(UpdateSectionOneRequest $request)
    {
        $input = $request->all();
        $sectionOne = SectionOne::first();
        $sectionOne->update($input);

        if (isset($input['img_url']) && ! empty($input['img_url'])) {
            $sectionOne->clearMediaCollection(SectionOne::SECTION_ONE_PATH);
            $media = $sectionOne->addMedia($input['img_url'])->toMediaCollection(SectionOne::SECTION_ONE_PATH,
                config('app.media_disc'));
            $sectionOne->update(['img_url' => $media->getUrl()]);
        }

        \Flash::success('Section One updated successfully');

        return redirect(route('super.admin.section.one'));
    }
}
