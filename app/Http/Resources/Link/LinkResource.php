<?php

namespace App\Http\Resources\Link;

use App\Entity\Link\ShortenLink;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ShortenLink */
class LinkResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'original_link' => $this->original_link,
            'short_code' => $this->short_code,
            'expired_at' => $this->expired_at ? $this->expired_at->format('d.m.Y G:i:s') : null,
            'is_expired' => $this->isExpired()
        ];
    }
}
