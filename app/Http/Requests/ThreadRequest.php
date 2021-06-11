<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
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
            'title' => 'required|max:100|string',
            'message' => 'required|max:100|string',
            'name' => 'required|max:20|string',
            'image'=>'image|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'message' => 'メッセージ',
            'name' => 'お名前',
            'image'=>'画像',
        ];
    }
}
