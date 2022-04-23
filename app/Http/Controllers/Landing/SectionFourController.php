<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateSectionFourRequest;
use App\Models\SectionFour;
use App\Repositories\SectionFourRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class SectionFourController extends AppBaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $sectionFour = SectionFour::first();

        return view('landing.section_four.index', compact('sectionFour'));
    }

    /**
     * @param  UpdateSectionFourRequest  $request
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function update(UpdateSectionFourRequest $request)
    {
        /** @var SectionFourRepository $repo */
        $repo = App::make(SectionFourRepository::class);
        $repo->updateSectionFour($request->all());

        \Flash::success('Section Four updated successfully');

        return redirect(route('super.admin.section.four'));
    }
}
