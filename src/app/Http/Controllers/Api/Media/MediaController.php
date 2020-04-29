<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaStoreRequest;
use App\Http\Resources\TweetMediaCollection;
use App\Models\TweetMedia;
use Illuminate\Http\UploadedFile;

/**
 * Class MediaController
 * @package App\Http\Controllers\Api\Media
 */
class MediaController extends Controller
{
    /**
     * @param MediaStoreRequest $request
     * @return TweetMediaCollection
     */
    public function store(MediaStoreRequest $request)
    {
        $result = collect($request->media)->map(function (UploadedFile $media) {
            return $this->addMedia($media);
        });

        return new TweetMediaCollection($result);
    }

    /**
     * @param UploadedFile $media
     * @return TweetMedia
     */
    protected function addMedia(UploadedFile $media): TweetMedia
    {
        $tweetMedia = TweetMedia::create([]);

        $tweetMedia->baseMedia()
            ->associate($tweetMedia->addMedia($media)->toMediaCollection())
            ->save();

        return $tweetMedia;
    }
}
