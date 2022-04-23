<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateSectionThreeRequest;
use App\Models\SectionThree;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SectionThreeController extends AppBaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {

        $sectionThree = SectionThree::first();

        return view('landing.section_three.index', compact('sectionThree'));
    }

    /**
     * @param  UpdateSectionThreeRequest  $request
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function update(UpdateSectionThreeRequest $request)
    {
        $input = $request->all();
        $sectionThree = SectionThree::first();
        $sectionThree->update($input);

        if (isset($input['img_url']) && ! empty($input['img_url'])) {
            $sectionThree->clearMediaCollection(SectionThree::SECTION_THREE_PATH);
            $media = $sectionThree->addMedia($input['img_url'])->toMediaCollection(SectionThree::SECTION_THREE_PATH,
                config('app.media_disc'));
            $sectionThree->update(['img_url' => $media->getUrl()]);
        }

        \Flash::success('Section Three updated successfully');

        return redirect(route('super.admin.section.three'));
    }
}
