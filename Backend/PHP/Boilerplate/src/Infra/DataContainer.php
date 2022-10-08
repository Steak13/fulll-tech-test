<?php

namespace Backend\Infra;

include_once dirname(__DIR__). '/Domain/Fleet.php';
include_once dirname(__DIR__). '/Domain/Vehicle.php';

use Backend\Domain\Fleet;
use Backend\Domain\Vehicle;

class DataContainer
{
    /** @var DataContainer|null $instance */
    private static ?DataContainer $instance = null;
    /** @var Fleet[] $fleets */
    private array $fleets = [];
    /** @var Vehicle[] $vehicles */
    private array $vehicles = [];

    private function __construct() {}

    /**
     * @return DataContainer
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new DataContainer();
        }
        return self::$instance;
    }

    /**
     * @param Fleet $fleet
     * @return void
     */
    public function persistFleet(Fleet $fleet): void
    {
        $fleetId = $fleet->getFleetId();
        $this->fleets[$fleetId] = $fleet;
    }

    /**
     * @param string $id
     * @return Fleet|null
     */
    public function getFleetById(string $id): ?Fleet
    {
        return $this->fleets[$id] ?? null;
    }

    /**
     * @param string $id
     * @return void
     */
    public function removeFleetFromId(string $id): void
    {
        unset($this->fleets[$id]);
    }

    /**
     * @param Vehicle $vehicle
     * @return void
     */
    public function persistVehicle(Vehicle $vehicle): void
    {
        $vehicleId = $vehicle->getPlateNumber();
        $this->vehicles[$vehicleId] = $vehicle;
    }

    /**
     * @param string $id
     * @return Vehicle|null
     */
    public function getVehicleById(string $id): ?Vehicle
    {
        return $this->vehicles[$id] ?? null;
    }

    public function removeVehicleFromId(string $id): void
    {
        unset($this->vehicles[$id]);
    }
}
