<?php

namespace App\Entity\Link;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ShortenLink extends Model
{
    protected $table = 'shorten_links';

    protected $fillable = [
        'original_link',
        'short_code',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function views()
    {
        return $this->hasMany(View::class, 'link_id', 'id');
    }

    public function isExpired(): bool
    {
        return $this->expired_at && $this->expired_at->lt(Carbon::now());
    }

    public function isActive(): bool
    {
        return !$this->expired_at || !$this->isExpired();
    }

    public function getOriginalUrl(): string
    {
        return $this->original_link;
    }

    public function getShortCode(): string
    {
        return $this->short_code;
    }

    public function hasExpirationDate(): bool
    {
        return !empty($this->expired_at);
    }

    public function addView(ViewMeta $meta): View
    {
        return $this->views()->create([
            'user_agent'    => $meta->getUserAgent(),
            'ip'            => $meta->getIp(),
            'referrer'      => $meta->getReferrer(),
        ]);
    }

    public static function createLink(OriginalUrl $originalUrl, ShortUrl $url, ExpireDate $expiredDate): self
    {
        return self::create([
            'original_link' => $originalUrl->getUrl(),
            'short_code'    => $url->getValue(),
            'expired_at'    => $expiredDate->getValue(),
        ]);
    }
}
