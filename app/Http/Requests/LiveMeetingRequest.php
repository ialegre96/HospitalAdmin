<?php

namespace App\Http\Requests;

use App\Models\LiveMeeting;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LiveMeetingRequest
 */
class LiveMeetingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return LiveMeeting::$rules;
    }
}
