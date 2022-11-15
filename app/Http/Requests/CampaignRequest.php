<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:70',
            'description' => 'required',
            'status' => 'in:UNVERIFIED,VERIFIED,CLOSED',
            'target' => 'required|integer',
            'total_donation' => 'integer',
            'count_donation' => 'integer',
            'deadline' => 'date',
        ];
    }
}
