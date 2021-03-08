<?php

namespace App\Entity\Link;

class ViewMeta
{
    /**
     * @var string
     */
    private $ip;
    /**
     * @var string|null
     */
    private $userAgent;
    /**
     * @var string|null
     */
    private $referrer;

    public function __construct(string $ip, ?string $userAgent = null, ?string $referrer = null)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->referrer = $referrer;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string|null
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @return string|null
     */
    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    public static function make(string $ip, ?string $userAgent = null, ?string $referrer = null): self
    {
        return new self($ip, $userAgent, $referrer);
    }
}
