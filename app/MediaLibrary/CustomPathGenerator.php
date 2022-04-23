<?php

namespace App\MediaLibrary;

use App\Models\AdminTestimonial;
use App\Models\Document;
use App\Models\Expense;
use App\Models\FrontService;
use App\Models\FrontSetting;
use App\Models\Income;
use App\Models\InvestigationReport;
use App\Models\IpdDiagnosis;
use App\Models\IpdPayment;
use App\Models\IpdTimeline;
use App\Models\ItemStock;
use App\Models\OpdDiagnosis;
use App\Models\OpdTimeline;
use App\Models\Postal;
use App\Models\ServiceSlider;
use App\Models\Setting;
use App\Models\SuperAdminSetting;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Visitor;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

/**
 * Class CustomPathGenerator
 */
class CustomPathGenerator implements PathGenerator
{
    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        $path = '{PARENT_DIR}'.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;

        switch ($media->collection_name) {
            case User::COLLECTION_PROFILE_PICTURES:
                return str_replace('{PARENT_DIR}', 'profile-photos', $path);
            case User::COLLECTION_MAIL_ATTACHMENTS:
                return str_replace('{PARENT_DIR}', 'mail-attachments', $path);
            case Document::PATH:
                return str_replace('{PARENT_DIR}', Document::PATH, $path);
            case Setting::PATH:
                return str_replace('{PARENT_DIR}', Setting::PATH, $path);
            case SuperAdminSetting::PATH:
                return str_replace('{PARENT_DIR}', SuperAdminSetting::PATH, $path);
            case InvestigationReport::COLLECTION_REPORTS:
                return str_replace('{PARENT_DIR}', InvestigationReport::COLLECTION_REPORTS, $path);
            case Expense::PATH:
                return str_replace('{PARENT_DIR}', Expense::PATH, $path);
            case Income::PATH:
                return str_replace('{PARENT_DIR}', Income::PATH, $path);
            case ItemStock::PATH:
                return str_replace('{PARENT_DIR}', ItemStock::PATH, $path);
            case IpdDiagnosis::IPD_DIAGNOSIS_PATH:
                return str_replace('{PARENT_DIR}', IpdDiagnosis::IPD_DIAGNOSIS_PATH, $path);
            case IpdTimeline::IPD_TIMELINE_PATH:
                return str_replace('{PARENT_DIR}', IpdTimeline::IPD_TIMELINE_PATH, $path);
            case IpdPayment::IPD_PAYMENT_PATH:
                return str_replace('{PARENT_DIR}', IpdPayment::IPD_PAYMENT_PATH, $path);
            case OpdDiagnosis::OPD_DIAGNOSIS_PATH:
                return str_replace('{PARENT_DIR}', OpdDiagnosis::OPD_DIAGNOSIS_PATH, $path);
            case OpdTimeline::OPD_TIMELINE_PATH:
                return str_replace('{PARENT_DIR}', OpdTimeline::OPD_TIMELINE_PATH, $path);
//            case OpdPayment::OPD_PAYMENT_PATH;
//                return str_replace('{PARENT_DIR}', OpdPayment::OPD_PAYMENT_PATH, $path);
            case Visitor::PATH:
                return str_replace('{PARENT_DIR}', Visitor::PATH, $path);
            case Postal::PATH:
                return str_replace('{PARENT_DIR}', Postal::PATH, $path);
            case Testimonial::PATH:
                return str_replace('{PARENT_DIR}', Testimonial::PATH, $path);
            case FrontSetting::PATH:
                return str_replace('{PARENT_DIR}', FrontSetting::PATH, $path);
            case FrontSetting::HOME_IMAGE_PATH:
                return str_replace('{PARENT_DIR}', FrontSetting::HOME_IMAGE_PATH, $path);
            case FrontService::PATH:
                return str_replace('{PARENT_DIR}', FrontService::PATH, $path);
            case ServiceSlider::SERVICE_SLIDER:
                return str_replace('{PARENT_DIR}', ServiceSlider::SERVICE_SLIDER, $path);
            case AdminTestimonial::PATH:
                return str_replace('{PARENT_DIR}', AdminTestimonial::PATH, $path);
            case 'default':
                return '';
        }
    }

    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'thumbnails/';
    }

    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'rs-images/';
    }
}
