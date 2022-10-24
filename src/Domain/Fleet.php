<?php

namespace Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Fleet
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @var string $fleetId
     */

    private string $fleetId;
    /**
     * @ORM\ManyToMany(targetEntity="Vehicle")
     * @ORM\JoinTable(
     *     joinColumns={@ORM\JoinColumn(name="fleetId", referencedColumnName="fleetId")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="vehiclePlate", referencedColumnName="plateNumber")}
     *     )
     * @var Vehicle[] $vehicles
     */
    private array $vehicles = [];

    /**
     * @param string $fleetId
     */
    public function __construct(string $fleetId)
    {
        $this->fleetId = $fleetId;
    }

    /**
     * @param Vehicle $vehicle
     * @return bool
     */
    public function isVehicleInFleet(Vehicle $vehicle): bool
    {
        $plateNumber = $vehicle->getPlateNumber();
        return !empty($this->vehicles[$plateNumber]);
    }

    /**
     * @return string
     */
    public function getFleetId(): string
    {
        return $this->fleetId;
    }

    /**
     * @param Vehicle $vehicle
     * @return void
     */
    public function addVehicle(Vehicle $vehicle): void
    {
        if (!$this->isVehicleInFleet($vehicle)) {
            $plateNumber = $vehicle->getPlateNumber();
            $this->vehicles[$plateNumber] = $vehicle;
        }
    }

    /**
     * @return Vehicle[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }
}
