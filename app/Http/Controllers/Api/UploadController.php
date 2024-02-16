<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function image(): \Illuminate\Http\JsonResponse
    {
        if (!request()?->hasFile('image')) {
            return response()->json([
                'error' => 'No image uploaded',
            ], 400);
        }

        $uploadedFile = request()->file('image');
        $path = $uploadedFile
            ->storePublicly('images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
