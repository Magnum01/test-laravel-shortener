<?php

namespace App\Entity\Link;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ShortenLink extends Model
{
    protected $table = 'shorten_links';

    protected $fillable = [
        'original_link',
        'short_link',
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

    public function addView(ViewMeta $meta): View
    {
        return $this->views()->create([
            'user_agent'    => $meta->getUserAgent(),
            'ip'            => $meta->getIp(),
            'referrer'      => $meta->getReferrer(),
        ]);
    }

    public static function createLink(OriginalUrl $originalUrl, ShortUrl $url, ExpiredDate $expiredDate): self
    {
        return self::create([
            'original_link' => $originalUrl->getUrl(),
            'short_link'    => $url->getValue(),
            'expired_at'    => $expiredDate->getValue(),
        ]);
    }
}
