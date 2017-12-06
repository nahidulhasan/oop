<?php
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
