# Laravel-EzThrottle
A simple Laravel Throttle extension


Installation
------------


Basic Usage
-----------

Start by creating an `Throttle` instance  

```php
use AcidF0x\EzThrottle\Throttle;  

$throttle = new Throttle($throttleKey, $maxAttempts //optional, $decayMinutes //optional);  

// increase hit count
$throttle->hit()

if ($agent->isBlock()) {
    echo $throttle->getErrorMsg(); // "Too Many Requests. Please try again in 1 minutes"
} else {
    //do something..
}
```
or use the `EzThrottle` Trait if you want  

```php
use AcidF0x\EzThrottle\Foundation\EzThrottle;

class SomeController extends Controller
{
    use EzThrottle;
    
    $protected $ThrottleKey = 'LoginThrottle';
    $protected $maxAttempts = '3';
    $protected $$decayMinutes = '1';
    
    public function doLogin()
    {
        //.....
        
        // increase hit count
        $this->hit()
        if ($this->isBlock()) {
            return $this->getErrorMsg(); // "Too Many Requests. Please try again in 1 minutes"
        } 
        
        //......
    }
}
```

Localization
-----------

Config
-----------


## Todos
- [x] Add Unit Test
- [ ] Add Source Comment 
- [ ] Add Useage on Readme File (30%)
- [ ] Add Packge on packagist
- [ ] Test on Variable Laravel Version (5.5 OK)
