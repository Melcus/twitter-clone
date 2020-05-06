<?php

namespace App\Models;

use App\Prototypes\Media\MimeTypes;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

/**
 * Class Media
 * @package App\Models
 */
class Media extends BaseMedia
{
    public function type()
    {
        return MimeTypes::type($this->mime_type);
    }
}
