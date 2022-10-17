<?php

namespace App;

use Domain\Location;
use Domain\Vehicle;
use LogicException;
use RuntimeException;

class VehicleLocator extends AbstractDataContainerAccessor
{
    /**
     * @param string $vehiclePlate
     * @param float $lat
     * @param float $lng
     * @throws LogicException
     * @throws RuntimeException
     * @return void
     */
    public function register(string $vehiclePlate, float $lat, float $lng): void
    {
        $vehicle = $this->getVehicle($vehiclePlate);
        $location = new Location($lat, $lng);
        $this->checkVehicleHasNewLocation($vehicle, $location);
        $vehicle->setLocation($location);
        $this->updateVehicle($vehicle);
    }

    /**
     * @param Vehicle $vehicle
     * @param Location $location
     * @return void
     */
    private function checkVehicleHasNewLocation(Vehicle $vehicle, Location $location): void
    {
        $oldLocation = $vehicle->getLocation();
        if ($oldLocation === null) {
            return;
        }
        $sameLat = $location->getLat() === $oldLocation->getLat();
        $sameLng = $location->getLong() === $oldLocation->getLong();
        if ($sameLat && $sameLng) {
            throw new LogicException('Vehicle already registered to this location');
        }
    }
}
