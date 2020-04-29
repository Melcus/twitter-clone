<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Prototypes\Media\MimeTypes;

/**
 * Class MediaTypesController
 * @package App\Http\Controllers\Api\Media
 */
class MediaTypesController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'image' => MimeTypes::$images,
                'video' => MimeTypes::$video
            ]
        ]);
    }
}
