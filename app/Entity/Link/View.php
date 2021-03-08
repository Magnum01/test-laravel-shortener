<?php

namespace App\Entity\Link;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'shorten_link_views';

    protected $fillable = [
        'link_id',
        'user_agent',
        'ip',
        'referrer',
    ];

    public function link()
    {
        return $this->belongsTo(ShortenLink::class, 'id', 'link_id');
    }
}
