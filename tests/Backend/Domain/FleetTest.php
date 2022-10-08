<?php

namespace Backend\Domain;

include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Domain/Fleet.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Domain/Vehicle.php';

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
