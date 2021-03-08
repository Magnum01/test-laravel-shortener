<?php

namespace App\Http\Actions\Link;

use App\Http\Repositories\LinksRepository;

class Details
{
    /**
     * @var LinksRepository
     */
    private $links;

    public function __construct(LinksRepository $links)
    {
        $this->links = $links;
    }

    public function execute(string $code)
    {
        $link = $this->links->findByShortCode($code);

        if (!$link) {
            abort(404);
        }

        $views = $this->links->getLinkViews($link);

        return view('app.site.details', compact('link', 'views'));
    }
}
