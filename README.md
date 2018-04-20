Welcome to OOP
===================



Interface
-------------

We know that an interface is defined by the interface keyword and all methods are abstract. All methods declared in an interface must be public; this is simply the nature of an interface. Here is the example :

```php
<?php
interface Logger
{
    public function execute();
}
```

In an interface the method body is not defined, just the name and the parameters.
If we do not use an interface what problems will happen? Why we should use interface? Herein you will get these answers. Please see the code in below:

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

In the above example I do not use interface. I write to the log using the LogToFile class. But now if I want to write a log using LogToDatabase I have to change hard coded class referance in the above code on line number 23. That line code in below :

```php
public function __construct(LogToFile $logger)
```

This code will be

```php
public function __construct(LogToDatabase $logger)
```

In a large project, if I have multiple classes and a need to change, then I have to change all the classes manually. But If we use an interface this problem is solved; and we will not need to change code manually.


Now see the following code and try to realize what happened if I use interface:

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

Now If I change from LogToDatabase to LogToFile I do not have to change the constructor method manually. In the constructor method I have Injected an interface; not any arbitrary class. So If you have multiple classes and swap from one class to another class you will get the same result without changing any class referances.

In the above example I write a log using LogToDatabase and now I want to write log using LogToFile, I can call it in this way

```php
$controller = new UsersController(new LogToFile);
$controller->show();
```

I get the result without changing other classes. Because the interface class handles the swapping issue.


Abstract class
-------------

An abstract class is a class that is only partially implemented by the programmer. It contains at least one abstract method, which is a method without any actual code in it, just the name and the parameters, and that has been marked as “abstract”.

An abstract method is simply a function definition that serves to tell the programmer that the method must be implemented in a child class. Here is the example :

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

Now the question is when will the situation that a method will be needed and must be implemented? Here I will try to explain. Please see the Tea class.

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

Now we look at the coffee class.

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

In the above two classes the three methods addHotWater(), addSuger(), and addMilk() are same. So we should remove duplicated code. We can do it in the following way :

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

I make an abstract class and name it Template. Here I define addHotWater(), addSuger() and addMilk(); and make an abstract method named addPrimaryToppings.

Now If I make the Tea class extend the Template class then I will get the three defined methods and must define the addPrimaryToppings() method. In a similar way the coffee class will as well.

Thanks for reading.
