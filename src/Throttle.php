<?php

namespace AcidF0x\EzThrottle;

use AcidF0x\EzThrottle\Foundation\EzThrottle;

class Throttle
{
    use EzThrottle;
    
    protected $throttleKey;

    protected $maxAttempts;

    protected $decayMinutes;

    public function __construct(string $throttleKey, $maxAttempts = 3, $decayMinutes = 1)
    {
        $this->throttleKey = $throttleKey;
        $this->maxAttempts = $maxAttempts;
        $this->decayMinutes = $decayMinutes;
    }

    public function setMaxAttempts(int $maxAttempts)
    {
        $this->maxAttempts = $maxAttempts;
        return $this;
    }

    public function setDecayMinutes(int $decayMinutes)
    {
        $this->decayMinutes = $decayMinutes;
        return $this;
    }
}