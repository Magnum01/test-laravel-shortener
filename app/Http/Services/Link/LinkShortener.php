<?php

namespace App\Http\Services\Link;

use App\Entity\Link\OriginalUrl;
use App\Entity\Link\ShortUrl;

interface LinkShortener
{
    public function process(OriginalUrl $url): ShortUrl;
}
