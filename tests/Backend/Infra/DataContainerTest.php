<?php

namespace Backend\Infra;

include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Domain/Fleet.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Domain/Vehicle.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Infra/DataContainer.php';

use Backend\Domain\Fleet;
use Backend\Domain\Vehicle;
use PHPUnit\Framework\TestCase;

class DataContainerTest extends TestCase
{
    public function testFleetIsInDatabase()
    {
        $fleet = new Fleet('fleetId');
        $database = DataContainer::getInstance();
        $database->persistFleet($fleet);
        $this->assertNotNull($database->getFleetById('fleetId'));
    }

    public function testVehicleIsInDatabase()
    {
        $fleet = new Vehicle('testPlate');
        $database = DataContainer::getInstance();
        $database->persistVehicle($fleet);
        $this->assertNotNull($database->getVehicleById('testPlate'));
    }
}
