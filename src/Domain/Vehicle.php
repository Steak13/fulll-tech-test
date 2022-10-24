<?php

namespace Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Vehicle
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @var string $plateNumber
     */
    private string $plateNumber;

    /**
     * @ORM\OneToOne(targetEntity="Location")
     * @var Location|null $location
     */
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
