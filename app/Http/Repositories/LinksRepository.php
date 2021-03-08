<?php

namespace App\Http\Repositories;

use App\Entity\Link\ShortenLink;

class LinksRepository
{
    public function findByShortCode(string $code): ?ShortenLink
    {
        return ShortenLink::where(['short_code' => $code])->limit(1)->first();
    }
}
