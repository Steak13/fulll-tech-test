<?php

namespace Algo;


use RuntimeException;

class FizzBuzzNumberDivider
{
    /**
     * Provide a number to display the magic FizzBuzz, or not
     * @param int $number
     * @return void
     */
    public function displayFizzBuzzFromNumber(int $number): void
    {
        $fizzbuzz = $this->estimateFizzBuzzFromNumber($number);

        echo empty($fizzbuzz) ? (string) $number : $fizzbuzz;
    }

    /**
     * @param int $number
     * @return string
     */
    private function estimateFizzBuzzFromNumber(int $number): string
    {
        if ($number < 1) {
            throw new RuntimeException('Invalid number provided please use number > 1.');
        }
        $fizz = $this->isDivisibleBy($number, 3) ? 'Fizz' : '';
        $buzz = $this->isDivisibleBy($number, 5) ? 'Buzz' : '';

        return $fizz . $buzz;
    }

    /**
     * @param int $number
     * @param int $divisibleBy
     * @return bool
     */
    private function isDivisibleBy(int $number, int $divisibleBy): bool
    {
        return is_int($number / $divisibleBy);
    }
}
