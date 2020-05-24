<?php


namespace App\Http\Requests\Memo;


use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
        ];
    }
}