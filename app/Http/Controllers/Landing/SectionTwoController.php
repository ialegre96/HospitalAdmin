<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateSectionTwoRequest;
use App\Models\SectionTwo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SectionTwoController extends AppBaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $sectionTwo = SectionTwo::first();

        return view('landing.section_two.index', compact('sectionTwo'));
    }

    /**
     * @param  UpdateSectionTwoRequest  $request
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function update(UpdateSectionTwoRequest $request)
    {
        $input = $request->all();
        $sectionTwo = SectionTwo::first();
        $sectionTwo->update($input);

        if (isset($input['card_one_image']) && ! empty($input['card_one_image'])) {
            $sectionTwo->clearMediaCollection(SectionTwo::SECTION_TWO_CARD_ONE_PATH);
            $media = $sectionTwo->addMedia($input['card_one_image'])->toMediaCollection(SectionTwo::SECTION_TWO_CARD_ONE_PATH,
                config('app.media_disc'));
            $sectionTwo->update(['card_one_image' => $media->getUrl()]);
        }

        if (isset($input['card_two_image']) && ! empty($input['card_two_image'])) {
            $sectionTwo->clearMediaCollection(SectionTwo::SECTION_TWO_CARD_TWO_PATH);
            $media = $sectionTwo->addMedia($input['card_two_image'])->toMediaCollection(SectionTwo::SECTION_TWO_CARD_TWO_PATH,
                config('app.media_disc'));
            $sectionTwo->update(['card_two_image' => $media->getUrl()]);
        }

        if (isset($input['card_third_image']) && ! empty($input['card_third_image'])) {
            $sectionTwo->clearMediaCollection(SectionTwo::SECTION_TWO_CARD_THIRD_PATH);
            $media = $sectionTwo->addMedia($input['card_third_image'])->toMediaCollection(SectionTwo::SECTION_TWO_CARD_THIRD_PATH,
                config('app.media_disc'));
            $sectionTwo->update(['card_third_image' => $media->getUrl()]);
        }

        \Flash::success('Section Two updated successfully');

        return redirect(route('super.admin.section.two'));
    }
}
