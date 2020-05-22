<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class EntityResource
 * @package App\Http\Resources
 */
class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'  => $this->type,
            'body'  => $this->body,
            'start' => $this->start,
            'end'   => $this->end
        ];
    }
}
