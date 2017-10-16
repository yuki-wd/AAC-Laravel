<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // todo: 認証実装
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // contentというフィールドの値が、
        // (1) nullまたは空文字列の場合 (2) 文字列ではない場合 (3) 255文字異常の長さの場合
        // にエラーが返るように設定
        return [
            'content' => 'required|string|max:255',
        ];
    }
}
