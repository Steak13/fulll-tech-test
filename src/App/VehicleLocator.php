<?php

namespace App;

use Domain\Fleet;
use Domain\Location;
use Domain\Vehicle;
use LogicException;
use RuntimeException;

class VehicleLocator extends AbstractDataContainerAccessor
{
    /**
     * @param string $fleetId
     * @param string $vehiclePlate
     * @param float $lat
     * @param float $lng
     * @return void
     */
    public function register(string $fleetId, string $vehiclePlate, float $lat, float $lng): void
    {
        $fleet = $this->getFleet($fleetId);
        $vehicle = $this->getVehicleFromFleet($fleet, $vehiclePlate);
        $location = new Location($lat, $lng);
        $this->checkVehicleHasNewLocation($vehicle, $location);
        $vehicle->setLocation($location);
        $this->updateDataContainer($fleet, $vehicle);
    }

    /**
     * @param Fleet $fleet
     * @param string $vehiclePlate
     * @return Vehicle
     */
    private function getVehicleFromFleet(Fleet $fleet, string $vehiclePlate): Vehicle
    {
        $vehicle = $fleet->getVehicles()[$vehiclePlate] ?? null;
        if ($vehicle === null) {
            throw new RunTimeException('Vehicle not registered in fleet');
        }
        return $vehicle;
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
