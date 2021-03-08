<?php

namespace App\Http\Services\Link;

use App\Entity\Link\OriginalUrl;
use App\Entity\Link\ShortUrl;

class RandomLinkShortener implements LinkShortener
{
    public function process(OriginalUrl $url): ShortUrl
    {
        $number = random_int(0, PHP_INT_MAX);

        return new ShortUrl(strtr(rtrim(base64_encode(pack('i', $number)), '='), '+/', '-_'));
    }
}
