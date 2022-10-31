<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MusicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'music.song_title' => 'required|string|max:100',
            'music.singer' => 'required|string|max:100',
            'hashtag.name' => 'required|string|max:100',
        ];
    }
}
