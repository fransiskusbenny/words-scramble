<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'channel' => 'required|exists:channels,id',
            'mode' => 'required|exists:modes,id',
            'words' => 'required',
            'words.*.text' => 'required|distinct|unique:words,text|max:255'
        ];
    }
}
