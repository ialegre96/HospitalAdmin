<?php

namespace App\Repositories;

use App\Mail\MarkdownMail;
use App\Models\Mail;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Support\Facades\Mail as Email;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class DoctorRepository
 * @version February 13, 2020, 8:55 am UTC
 */
class MailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'to',
        'subject',
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
        return Mail::class;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            if (isset($input['attachments']) && ! empty($input['attachments'])) {
                /** @var Media $media */
                $media = storeAttachments($user, $input['attachments']);
                $input['attachments'] = $media->getFullUrl();
            }
            $input['attachments'] = (isset($input['attachments'])) ? $input['attachments'] : null;

            /** @var Mail $mail */
            $mail = Mail::create([
                'to'          => $input['to'],
                'subject'     => $input['subject'],
                'message'     => $input['message'],
                'attachments' => $input['attachments'],
                'user_id'     => $user->id,
            ]);

            Email::to($input['to'])
                ->send(new MarkdownMail('emails.email',
                    $mail->subject,
                    $input));
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }
}
