<?php

abstract class Fruit{
	function __construct() {
       print "Using Fruit\n";
   }

   abstract public function getColor();
}

//Apple is not implementing the abstract function getColor
//An error will be thrown since extending an abstract class does require to implement all the methods existing in that class
class Apple extends Fruit{
	function __construct() {
       print "I'm an Apple\n";
   }
}

$app = new Apple();