<?php

namespace App\Http\Requests;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Like::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'bail|required|string|in:post,comment',
            'id' => ['required', 'exists:' . Str($this->input('type'))->plural() . ',id'],
        ];
    }

    public function likeable(): Post|Comment
    {
        $likeableType = $this->input('type');
        $likeableId = $this->input('id');

        return match ($likeableType) {
            'post' => Post::findOrFail($likeableId),
            'comment' => Comment::findOrFail($likeableId),
        };
    }
}
