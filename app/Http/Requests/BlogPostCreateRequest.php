<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title' => 'required|min:5|max:200|unique:blog_posts',
            'slug' => 'max:200',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'content_raw' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Введите заголовок, по хорошему',
            'content_raw.min' => 'Текст должен быть не менее [:min] символов!',
        ];
    }
}
