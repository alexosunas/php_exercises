<?php

abstract class Fruit{
	function __construct() {
       print "Using Fruit\n";
   }

   abstract public function getColor();
}

class Apple extends Fruit{
	function __construct() {
       print "I'm an Apple\n";
   }
}

$app = new Apple();