<?php

namespace App\Http\Actions\Link;

use App\Entity\Link\ExpireDate;
use App\Entity\Link\OriginalUrl;
use App\Http\Actions\ApiResponsesTrait;
use App\Http\Requests\Link\CreateRequest;
use App\Http\Resources\Link\LinkResource;
use App\UseCase\Link\ShortenUrlService;
use Carbon\Carbon;
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

    public function execute(CreateRequest $request)
    {
        try {
            $dateStr = $request->input('expired_at');

            $link = $this->shortenUrlService->shorten(
                new OriginalUrl($request->input('link')),
                new ExpireDate($dateStr ? Carbon::parse($dateStr) : null),
            );

            if ($request->ajax()) {
                return $this->success(new LinkResource($link));
            }

            return redirect()->route('link.details', $link->getShortCode())->with('success', 'Link successful shortened.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return $this->error($e->getMessage());
            }

            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }
    }
}
