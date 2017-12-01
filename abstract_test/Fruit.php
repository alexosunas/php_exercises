<?php

abstract class Fruit{
	function __construct() {
       print "Using Fruit\n";
   }

   abstract public getColor();
}