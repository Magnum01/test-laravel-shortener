<?php

namespace App\Entity\Link;

use Webmozart\Assert\Assert;

class OriginalUrl
{
    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        Assert::true((bool)filter_var($url, FILTER_VALIDATE_URL), 'The link must be valid URL.');
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
