<?php

namespace App;

use Domain\Fleet;
use Domain\Vehicle;
use Infra\DataContainer;
use RuntimeException;

class AbstractDataContainerAccessor
{
    /** @var DataContainer $dataContainer */
    private DataContainer $dataContainer;

    public function __construct()
    {
        $this->dataContainer = DataContainer::getInstance();
    }

    /**
     * @param string $fleetId
     * @return Fleet
     */
    protected function getFleet(string $fleetId): Fleet
    {
        $fleet = $this->dataContainer->getFleetById($fleetId);
        if ($fleet === null) {
            throw new RunTimeException('Unknown fleet id');
        }
        return $fleet;
    }

    /**
     * @param string $vehiclePlate
     * @throws RuntimeException
     * @return Vehicle
     */
    protected function getVehicle(string $vehiclePlate): Vehicle
    {
        $vehicle = $this->dataContainer->getVehicleById($vehiclePlate);
        if ($vehicle === null) {
            throw new RunTimeException('Vehicle not registered');
        }
        return $vehicle;
    }

    /**
     * @param Fleet $fleet
     * @param Vehicle $vehicle
     * @return void
     */
    protected function updateDataContainer(Fleet $fleet, Vehicle $vehicle): void
    {
        $this->dataContainer->persistFleet($fleet);
        $this->dataContainer->persistVehicle($vehicle);
    }
}
