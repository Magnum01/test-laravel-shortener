<?php

namespace App\Entity\Link;

use Carbon\Carbon;

class ExpireDate
{
    /**
     * @var Carbon|null
     */
    private $value;

    public function __construct(?Carbon $value = null)
    {
        if ($value && $value->lt(Carbon::now())) {
            throw new \DomainException('Date must be greater than current.');
        }

        $this->value = $value;
    }

    /**
     * @return Carbon|null
     */
    public function getValue(): ?Carbon
    {
        return $this->value;
    }
}
