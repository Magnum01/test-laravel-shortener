<?php

namespace App\UseCase\Link;

use App\Entity\Link\ExpireDate;
use App\Entity\Link\OriginalUrl;
use App\Entity\Link\ShortenLink;
use App\Http\Repositories\LinksRepository;
use App\Http\Services\Link\LinkShortener;

class ShortenUrlService
{
    /**
     * @var LinkShortener
     */
    private $shortener;
    /**
     * @var LinksRepository
     */
    private $links;

    public function __construct(LinkShortener $shortener, LinksRepository $links)
    {
        $this->shortener = $shortener;
        $this->links = $links;
    }

    public function shorten(OriginalUrl $original, ExpireDate $expireDate): ShortenLink
    {
        do {
            $shortLink = $this->shortener->process($original);
        } while($this->links->findByShortCode($shortLink->getValue()) !== null);

        return ShortenLink::createLink(
            $original,
            $shortLink,
            $expireDate
        );
    }
}
