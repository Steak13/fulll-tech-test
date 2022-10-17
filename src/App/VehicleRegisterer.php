<?php

namespace App;

use Domain\Vehicle;
use LogicException;
use RuntimeException;

class VehicleRegisterer extends AbstractDataContainerAccessor
{
    /**
     * @param string $fleetId
     * @param string $vehiclePlate
     * @return void
     */
    public function register(string $fleetId, string $vehiclePlate): void
    {
        $fleet = $this->getFleet($fleetId);
        $vehicle = $this->getVehicle($vehiclePlate);

        if ($fleet->isVehicleInFleet($vehicle)) {
            throw new LogicException('Vehicle already in corresponding Fleet');
        }
        $fleet->addVehicle($vehicle);
        $this->updateDataContainer($fleet, $vehicle);
    }

    /**
     * @param string $vehiclePlate
     * @return Vehicle
     */
    protected function getVehicle(string $vehiclePlate): Vehicle
    {
        try {
            $vehicle = parent::getVehicle($vehiclePlate);
        } catch (RuntimeException $exception) {
            $vehicle = new Vehicle($vehiclePlate);
        }
        return $vehicle;
    }
}
