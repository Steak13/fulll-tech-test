<?php

namespace Backend\Domain;

include_once dirname(__DIR__). '/Domain/Location.php';

class Vehicle
{
    /** @var string $plateNumber */
    private string $plateNumber;
    /** @var Location|null $location */
    private ?Location $location = null;

    /**
     * @param string $plateNumber
     */
    public function __construct(string $plateNumber)
    {
        $this->plateNumber = $plateNumber;
    }

    /**
     * @return string
     */
    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param Location|null $location
     */
    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }
}
