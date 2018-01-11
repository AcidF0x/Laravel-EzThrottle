# Laravel-EzThrottle
A simple Laravel Throttle extension

Installation
------------
install using composer:
 
```bash
 composer require acidf0x/laravel-ez-throttle
```

Basic Usage
-----------

Start by creating an `Throttle` instance  
```php
use AcidF0x\EzThrottle\Throttle;  

$throttle = new Throttle();
// or
$throttle = new Throttle($throttleKey , $maxAttempts, $decayMinutes);


// increase hit count
$throttle->hit()

if ($agent->isBlock()) {
    echo $throttle->getErrorMsg(); // "Too Many Requests. Please try again in 1 minutes"
} else {
    // ...
    
    if ( ... ) {
        $throttle->clear();   
    }
    
}
```
or use the `EzThrottle` trait if you want  

```php
use AcidF0x\EzThrottle\Foundation\EzThrottle;

class SomeController extends Controller
{
    use EzThrottle;
    
    $protected $ThrottleKey = 'LoginThrottle';
    $protected $maxAttempts = '3';
    $protected $decayMinutes = '1';
    
    public function doLogin()
    {
        //.....
        
        // increase hit count
        $this->hit()
        if ($this->isBlock()) {
            return $this->getErrorMsg(); // "Too Many Requests. Please try again in 1 minutes"
        } else {
            // ...
            if ( ... ) {
                $this->clear();
            }
        }
        
        //......
    }
}
```

Customize
-----------
```bash
php artisan vendor:publish --provider=AcixF0x\Ezthrrotle\EzthrottleServiceProvider
```

Localization
-----------
```php
# resources/lang/vendor/ezthrottle/en/error.php

<?php

return [
        'sec'=> 'Too Many Requests. Please try again in :sec seconds',
        'min'=> 'Too Many Requests. Please try again in :min minutes',
        'hour'=> 'Too Many Requests. Please try again in :hour hours',
        'days'=> 'Too Many Requests. Please try again in :day days',
];
```

Config
-----------
```php
# config/ezthrott.ephp

<?php
return [
    'defaultThrottleKey' => 'throttle',
    'defaultDecayMinutes' => '1',
    'defaultMaxAttempts' => '3'
];
```