<?php
/**
 * Created by PhpStorm.
 * User: joduhui
 * Date: 2018. 1. 8.
 * Time: PM 7:58
 */

namespace AcidF0x\EzThrottle\Foundation;

use Carbon\Carbon;
use Illuminate\Cache\RateLimiter;

trait EzThrottle
{
    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Returns the block status.
     *
     * @return bool
     */
    public function isBlock()
    {
        return $this->limiter()->tooManyAttempts($this->throttleKey(), $this->maxAttempts(), $this->decayMinutes());
    }

    /**
     * Delete the cache of throttle key
     *
     * @return void
     */
    public function hit()
    {
        $this->limiter()->hit($this->throttleKey(), $this->decayMinutes());
    }

    /**
     * Delete the cache of throttle key
     *
     * @return void
     */
    public function clear()
    {
        $this->limiter()->clear($this->throttleKey());
    }

    /**
     * Returns the scheduled unblock time.
     *
     * @return null|Carbon\Carbon
     */
    
    public function getUnblockTime()
    {
        if (!$this->isBlock()) {
            return null;
        }
        return Carbon::now($this->timezone())->addSeconds(
            $this->limiter()->availableIn($this->throttleKey())
        );
    }

    /**
     * Returns the time remaining until unblocking.
     *
     * @return \DateInterval||null
     */
    public function leftUnblockTime()
    {
        if (!$this->isBlock()) {
            return null;
        }
        return date_diff(Carbon::now($this->timezone()), $this->getUnblockTime());
    }

    /**
     * When throttling return error msg
     *
     * @return null|string
     */
    public function getErrorMsg()
    {
        if (!$this->isBlock()) {
            return null;
        }

        $timeLeft = $this->leftUnblockTime();
        if ($timeLeft->days > 0) {
            return trans('ezthrottle::error.days', ['day' => $timeLeft->days]);
        } elseif ($timeLeft->h > 0) {
            return trans('ezthrottle::error.hour', ['hour' => $timeLeft->h]);
        } elseif ($timeLeft->i > 0) {
            return trans('ezthrottle::error.min', ['min' => $timeLeft->i]);
        } elseif ($timeLeft->s > 0) {
            return trans('ezthrottle::error.sec', ['sec' => $timeLeft->s]);
        }
    }


    /**
     * Get Current Time zone
     *
     * @return string
     */
    
    protected function timezone()
    {
        return config('app.timezone');
    }


    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : config('ezthrottle.defaultMaxAttempts');
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : config('ezthrottle.defaultDecayMinutes');
    }

    /**
     * Get the Cache Key Name
     *
     * @return int
     */
    public function throttleKey()
    {
        return property_exists($this, 'throttleKey') ? $this->throttleKey : config('ezthrottle.defaultThrottleKey');
    }
    
}