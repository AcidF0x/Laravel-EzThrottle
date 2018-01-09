# Laravel-EzThrottle
A simple Laravel Throttle extension

<<<<<<< Updated upstream
##Todos

=======

Installation
------------
I'll add..

Basic Usage
-----------

Start by creating an `Throttle` instance 

```php
use AcidF0x\EzThrottle\Throttle;

$agent = new Agent($throttleKey, $maxAttempts //optional, $decayMinutes//optional);

// increase hit count
$agent->hit()

if ($agent->isBlock()) {
    echo $agent->getErrorMsg();
    //
}

```
or use the `EzThrottle` Trait if you want:


## Todos
>>>>>>> Stashed changes
- [x] Add Unit Test
- [ ] Add Source Comment 
- [ ] Add Useage on Readme File
- [ ] Add Packge on packagist
- [ ] Test on Variable Laravel Version
