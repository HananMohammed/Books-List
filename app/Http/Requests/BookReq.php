<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookReq extends FormRequest
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
        return [
            'title'=>'required|string|max:100',
            'subtitle'=>'required|string',
            'author'=>'required|string',
            'published_at'=>'required|date',
            'publisher'=>'required|string',
            'pages'=>'required|numeric',
             'description'=>'required|string',
            'website'=>'nullable|url',
             'file'=>'required|mimes:jpeg,jpg,png,gif,svg|required|max:10000'
        ];
    }
}
