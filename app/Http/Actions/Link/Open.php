<?php

namespace App\Http\Actions\Link;

use App\Entity\Link\ViewMeta;
use App\Http\Repositories\LinksRepository;
use App\UseCase\Link\ShortenUrlService;
use Illuminate\Http\Request;

class Open
{
    /**
     * @var LinksRepository
     */
    private $links;
    /**
     * @var ShortenUrlService
     */
    private $shortenUrlService;

    public function __construct(ShortenUrlService $shortenUrlService, LinksRepository $links)
    {
        $this->shortenUrlService = $shortenUrlService;
        $this->links = $links;
    }

    public function execute(Request $request, string $code)
    {
        $link = $this->links->findByShortCode($code);

        if (!$link || $link->isExpired()) {
            abort(404);
        }

        $this->links->addView(
            $link,
            ViewMeta::make($request->ip(), $request->userAgent(), $request->header('referer'))
        );

        return redirect($link->getOriginalUrl());
    }
}
