<?php

namespace Backend\Domain;

include_once dirname(__DIR__). '/Domain/Vehicle.php';

class Fleet
{
    /** @var string $fleetId */
    private string $fleetId;
    /** @var Vehicle[] $vehicles */
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
