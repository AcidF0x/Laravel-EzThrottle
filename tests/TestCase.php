<?php

use Illuminate\Support\Facades\Cache;

class TestCase extends Orchestra\Testbench\TestCase
{
    /**
     * ThrottleKey
     *
     * @var string
     */
    protected $throttleKey = "UNITTEST";
    
    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Get application ServiceProvider
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['AcidF0x\EzThrottle\EzThrottleServiceProvider'];
    }
    
    /**
     * Get application timezone.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return string|null
     */
    protected function getApplicationTimezone($app)
    {
        return 'UTC';
    }

    /** @test */
    function it_can_hit_in_cache()
    {
        $throttle = new AcidF0x\EzThrottle\Throttle($this->throttleKey);
        $throttle->hit();
        $this->assertEquals(1, Cache::get($this->throttleKey));
    }

    /** @test */
    function it_can_not_block_on_few_attempts()
    {
        $throttle = new AcidF0x\EzThrottle\Throttle($this->throttleKey);
        $throttle->hit();
        $this->assertFalse($throttle->isBlock());
    }

    /** @test */
    function it_can_block_on_many_attempts()
    {
        $throttle = new AcidF0x\EzThrottle\Throttle($this->throttleKey, 1, 1);
        $throttle->hit();
        $throttle->hit();
        $this->assertTrue($throttle->isBlock());
    }
    
    /** @test */
    function it_can_not_return_error_on_few_attempts()
    {
        $throttle = new AcidF0x\EzThrottle\Throttle($this->throttleKey, 5, 1);
        $throttle->hit();
        $this->assertNull($throttle->getErrorMsg());
        
    }

    /** @test */
    function it_can_return_error_on_many_attempts()
    {
        $throttle = new AcidF0x\EzThrottle\Throttle($this->throttleKey, 1, 1);
        $throttle->hit();
        $throttle->hit();
        $error = $throttle->getErrorMsg();
        $this->assertNotEmpty($error);
    }

    /** @test */
    function it_can_clear()
    {
        $throttle = new AcidF0x\EzThrottle\Throttle($this->throttleKey, 1, 1);
        $throttle->hit();
        $throttle->hit();
        $throttle->clear();
        $this->assertFalse($throttle->isBlock());
    }


}