<?php

class Coffee {

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