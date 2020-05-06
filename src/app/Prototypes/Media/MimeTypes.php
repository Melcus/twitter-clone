<?php

namespace App\Prototypes\Media;

/**
 * Class MimeTypes
 * @package App\Prototypes\Media
 */
class MimeTypes
{
    public static array $image = [
        'image/png',
        'image/jpg',
        'image/jpeg',
    ];

    public static array $video = [
        'video/mp4'
    ];

    public static function type($mime)
    {
        if (in_array($mime, self::$image)) {
            return 'image';
        }

        if (in_array($mime, self::$video)) {
            return 'video';
        }

        return null;
    }

    public static function all()
    {
        return array_merge(self::$image, self::$video);
    }
}
