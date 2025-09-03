<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Delete the specified image from storage (DB) and physical storage.
     */
    public function destroy(Image $image): void
    {
        if ($image->path) {
            Storage::delete($image->path);

            $image->delete();
        }
    }
}
