<?php

namespace App\Http\Actions\Link;

use App\Entity\Link\ExpireDate;
use App\Entity\Link\OriginalUrl;
use App\Http\Actions\ApiResponsesTrait;
use App\Http\Resources\Link\LinkResource;
use App\UseCase\Link\ShortenUrlService;
use Illuminate\Http\Request;

class Shorten
{
    use ApiResponsesTrait;

    /**
     * @var ShortenUrlService
     */
    private $shortenUrlService;

    public function __construct(ShortenUrlService $shortenUrlService)
    {
        $this->shortenUrlService = $shortenUrlService;
    }

    public function execute(Request $request)
    {
        try {
            $link = $this->shortenUrlService->shorten(
                new OriginalUrl($request->input('url')),
                new ExpireDate($request->input('expired_at')),
            );

            if ($request->ajax()) {
                return $this->success(new LinkResource($link));
            }

            return redirect()->route('link.details', $link)->with('success', 'Link successful shortened.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return $this->error($e->getMessage());
            }

            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }
}
