<?php

namespace Algo;

require dirname(__DIR__).'/../Algo/FizzBuzzNumberDivider.php';

use PHPUnit\Framework\TestCase;

class FizzBuzzNumberDividerTest extends TestCase
{
    public function testDivisionByNegativeNumber()
    {
        $divider = new FizzBuzzNumberDivider();
        $this->expectException(\RuntimeException::class);
        $divider->displayFizzBuzzFromNumber(-14);
    }
    public function testDivisionByThree()
    {
        $divider = new FizzBuzzNumberDivider();
        $this->expectOutputString('Fizz');
        $divider->displayFizzBuzzFromNumber(3);
    }

    public function testDivisionByFive()
    {
        $divider = new FizzBuzzNumberDivider();
        $this->expectOutputString('Buzz');
        $divider->displayFizzBuzzFromNumber(5);
    }

    public function testDivisionByTwenty()
    {
        $divider = new FizzBuzzNumberDivider();
        $this->expectOutputString('FizzBuzz');
        $divider->displayFizzBuzzFromNumber(15);
    }

    public function testDivisionBySeven()
    {
        $divider = new FizzBuzzNumberDivider();
        $this->expectOutputString('7');
        $divider->displayFizzBuzzFromNumber(7);
    }
}
