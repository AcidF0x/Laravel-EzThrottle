<?php

namespace AcidF0x\EzThrottle;

use AcidF0x\EzThrottle\Foundation\EzThrottle;

class Throttle
{
    use EzThrottle;
    
    protected $throttleKey;

    protected $maxAttempts;

    protected $decayMinutes;

    public function __construct(string $throttleKey = null, $maxAttempts = null, $decayMinutes = null)
    {
        $this->throttleKey  = is_null($throttleKey)  ? config('ezthrottle.defaultThrottleKey') : $throttleKey;
        $this->maxAttempts  = is_null($maxAttempts)  ? config('ezthrottle.defaultMaxAttempts') : $maxAttempts;
        $this->decayMinutes = is_null($decayMinutes) ? config('ezthrottle.defaultDecayMinutes') : $decayMinutes;
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