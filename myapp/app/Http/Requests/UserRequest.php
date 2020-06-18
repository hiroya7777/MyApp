<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserRequest extends FormRequest
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
    public function rules(User $user)
    {
        $user = Auth::user();
        return [
            'name'  => 'required|max:255',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
        ];
    }

    /**
    * 定義済みバリデーションルールのエラーメッセージ取得
    *
    * @return array
    */
    public function messages()
    {
        return [
            'name.required' => '名前は入力必須です',
            'name.max' => '名前は255文字以内です',
            'email.required'  => 'メールアドレスは入力必須です',
            'email.unique'  => '既に存在するメールアドレスです',
        ];
    }
}
