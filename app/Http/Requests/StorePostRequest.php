<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:150',
            'url' => 'nullable|string|url',
            'intro' => 'nullable|string|max:300',
            'content' => 'nullable|json',
            'tags' => 'array',
            'tags.*' => 'string|max:50',
            'topic_id' => 'required|integer|exists:topics,id',
        ];
    }
}
