<?php

namespace Infra;

use Domain\Fleet;
use Domain\Vehicle;
use PHPUnit\Framework\TestCase;

class DataContainerTest extends TestCase
{
    private const FLEETID = 'fleetId';
    private const PLATEID = 'vehiclePlate';

    protected function tearDown(): void
    {
        $database = DataContainer::getInstance();
        $database->removeFleetFromId(self::FLEETID);
        $database->removeVehicleFromId(self::PLATEID);
    }

    public function testDatabaseIsUnique()
    {
        $database = DataContainer::getInstance();
        $database2 = DataContainer::getInstance();
        $this->assertEquals($database, $database2);
    }

    public function testFleetIsInDatabase()
    {
        $fleet = new Fleet(self::FLEETID);
        $database = DataContainer::getInstance();
        $database->persistFleet($fleet);
        $this->assertNotNull($database->getFleetById(self::FLEETID));
    }

    public function testVehicleIsInDatabase()
    {
        $fleet = new Vehicle(self::PLATEID);
        $database = DataContainer::getInstance();
        $database->persistVehicle($fleet);
        $this->assertNotNull($database->getVehicleById(self::PLATEID));
    }

    public function testFleetIsRemovedFromDatabase()
    {
        $fleet = new Fleet(self::FLEETID);
        $database = DataContainer::getInstance();
        $database->persistFleet($fleet);
        $database->removeFleetFromId(self::FLEETID);
        $this->assertNull($database->getFleetById(self::FLEETID));
    }

    public function testVehicleIsRemovedFromDatabase()
    {
        $fleet = new Vehicle(self::PLATEID);
        $database = DataContainer::getInstance();
        $database->persistVehicle($fleet);
        $database->removeVehicleFromId(self::PLATEID);
        $this->assertNull($database->getVehicleById(self::PLATEID));
    }
}
