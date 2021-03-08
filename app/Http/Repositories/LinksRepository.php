<?php

namespace App\Http\Repositories;

use App\Entity\Link\ShortenLink;
use App\Entity\Link\ViewMeta;
use Illuminate\Database\Eloquent\Collection;

class LinksRepository
{
    public function findByShortCode(string $code): ?ShortenLink
    {
        return ShortenLink::where(['short_code' => $code])->limit(1)->first();
    }

    public function getLinkViews(ShortenLink $link): Collection
    {
        return $link->views()->orderBy('id', 'DESC')->get();
    }

    public function addView(ShortenLink $link, ViewMeta $meta): void
    {
        $link->addView($meta);
    }
}
