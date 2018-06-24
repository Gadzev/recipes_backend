<?php

namespace App\Constants;

class Ingredients 
{
    const FLOUR = 'FLOUR';
    const MILK = 'MILK';
    const OIL = 'OIL';
    const SALT = 'SALT';
    const SUGAR = 'SUGAR';
    const EGGS = 'EGGS';
    const TOMATOES = 'TOMATOES';
    const PEPPERS = 'PEPPERS';
    const CHEESE = 'CHEESE';
    const POTATOES = 'POTATOES';
    const MEAT = 'MEAT';

    static function getConstants()
    {
        $class = new \ReflectionClass(static::class);
        return $class->getConstants();
    }
}