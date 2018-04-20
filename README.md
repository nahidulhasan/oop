Welcome to OOP
===================



Interface
-------------

we know that interface is defined by interface keyword and all methods are abstract. All methods declared in an interface must be public; this is the nature of an interface. Here is the example :

```php
<?php
interface Logger
{
    public function execute();
}
```

In interface, method body is not defined, just the name and the parameters.
If we do not use interface what problem will be happened and why we should use interface, Here you will get these answers. Please see the code in below:

```php
<?php
class LogToDatabase 
{
    public function execute($message)
    {
        var_dump('log the message to a database :'.$message);
    }
}

class LogToFile 
{
    public function execute($message)
    {
        var_dump('log the message to a file :'.$message);
    }
}

class UsersController 
{ 
    protected $logger;
    
    public function __construct(LogToFile $logger)
    {
        $this->logger = $logger;
    }
    
    public function show()
    { 
        $user = 'nahid';
        $this->logger->execute($user);
    }
}

$controller = new UsersController(new LogToFile);
$controller->show();
```

In the above example I do not use interface. I write log using LogToFile class. But now if I want to write log using LogToDatabase I have to change hard coded class in the above code line number 23. That line code in below :

```php
public function __construct(LogToFile $logger)
```

This code will be

```php
public function __construct(LogToDatabase $logger)
```

In a large project if I have multiple classes and need any change then I have to change all the classes manually. But If we use interface this problem will be solved and it will be no need to change code manually.


Now see the following code and try to realize what happened if I use interface

```php
<?php
interface Logger 
{
    public function execute($message);
}

class LogToDatabase implements Logger 
{
    public function execute($message){
        var_dump('log the message to a database :'.$message);
    }
}

class LogToFile implements Logger 
{
    public function execute($message) 
    {
        var_dump('log the message to a file :'.$message);
    }
}

class UsersController 
{
    protected $logger;
    
    public function __construct(Logger $logger) 
    {
        $this->logger = $logger;
    }
    
    public function show() 
    {
        $user = 'nahid';
        $this->logger->execute($user);
    }
}

$controller = new UsersController(new LogToDatabase);
$controller->show();
```

Now If I change from LogToDatabase to LogToFile I have not to change the constructor method manually. In constructor method I have Injected interface not any class . So If you have multiple classes and swap from one class to another class you will get result without changing any class.


In the above example I write log using LogToDatabase and now I want to write log using LogToFile, I can call in this way

```php
$controller = new UsersController(new LogToFile);
$controller->show();
```

I get result without changing other classes.Because Interface handle this swapping issue.


Abstract class
-------------

An abstract class is a class that is only partially implemented by the programmer. It may contain at least one abstract method, which is a method without any actual code in it, just the name and the parameters, and that has been marked as “abstract”.

An abstract method is simply a function definition that serves to tell the programmer that the method must be implemented in a child class.Here is the example :

```php
<?php
abstract class AbstractClass
{
    // Force Extending class to define this method
    abstract protected function getValue();
    
    public function printOut() 
    {
        print $this->getValue() . "\n";
    }
}
```

Now question when will be this situation that a method will be need and must be implemented. Here I will try to explain. Please see the Tea class.

```php
<?php
class Tea 
{
    public function addTea()
    {
        var_dump('Add proper amount of tea');
        return $this;
    }
    protected  function  addHotWater()
    {
        var_dump('Pour Hot water into cup');
        return $this;
    }
    
    protected  function addSuger()
    {
        var_dump('Add proper amount of suger');
        return $this;
    }
    
    protected function addMilk()
    {
        var_dump('Add proper amount of Milk');
        return $this;
    }
    
    public function make()
    {
        return $this
            ->addHotWater()
            ->addSuger()
            ->addTea()
            ->addMilk();
    }
}

$tea = new Tea();
$tea->make();
```

Now see the coffee class

```php
<?php
class Coffee 
{
    public function addCoffee()
    {
        var_dump('Add proper amount of tea');
        return $this;
    }
    
    protected  function  addHotWater()
    {
        var_dump('Pour Hot water into cup');
        return $this;
    }
    
    protected  function addSuger()
    {
        var_dump('Add proper amount of suger');
        return $this;
    }
    
    protected function addMilk()
    {
        var_dump('Add proper amount of Milk');
        return $this;
    }
    
    public function make()
    {
        return $this
            ->addHotWater()
            ->addSuger()
            ->addCoffee()
            ->addMilk();
    }
}

$tea = new Coffee();
$tea->make();
```

In the above two classes, three methods : addHotWater(), addSuger() and addMilk() are same. So we should remove duplicated code. We can do it in the following way :

```php
abstract class Template
{
    public function make()
    {
        return $this
            ->addHotWater()
            ->addSuger()
            ->addPrimaryToppings()
            ->addMilk();
    }
    
    protected  function  addHotWater()
    {
        var_dump('Pour Hot water into cup');
        return $this;
    }
    
    protected  function addSuger()
    {
        var_dump('Add proper amount of suger');
        return $this;
    }
    
    protected function addMilk()
    {
        var_dump('Add proper amount of Milk');
        return $this;
    }
    
    protected abstract function addPrimaryToppings();
}

class Tea extends Template
{
    public function addPrimaryToppings()
    {
        var_dump('Add proper amount of tea');
        return $this;
    }
}

$tea = new Tea();
$tea->make();

class Coffee extends Template
{
    public function addPrimaryToppings()
    {
        var_dump('Add proper amount of Coffee');
        return $this;
    }
}

$coffee = new Coffee();
$coffee->make();
```

I make an abstract class name Template. Here I define addHotWater(), addSuger() and addMilk() these three methods and make an abstract method named addPrimaryToppings.

Now If I want to make Tea class extending Template class then I will get defined three methods and must have to define addPrimaryToppings. In similar way for coffee class.

Thanks for reading.





