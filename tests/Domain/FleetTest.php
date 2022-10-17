<?php

namespace Domain;

use PHPUnit\Framework\TestCase;

class FleetTest extends TestCase
{
    public function testVehiculeIsInFleet()
    {
        $vehicle = new Vehicle('testPlate');
        $fleet = new Fleet('fleetId');
        $fleet->addVehicle($vehicle);
        $this->assertTrue($fleet->isVehicleInFleet($vehicle));
        $this->assertNotEmpty($fleet->getVehicles()['testPlate']);
    }

    public function testVehicleIsNotAddedTwice()
    {
        $vehicle = new Vehicle('testPlate');
        $vehicleDouble = new Vehicle('testPlate');
        $fleet = new Fleet('fleetId');
        $fleet->addVehicle($vehicle);
        $fleet->addVehicle($vehicleDouble);
        $this->assertCount(1, $fleet->getVehicles());
    }
}
