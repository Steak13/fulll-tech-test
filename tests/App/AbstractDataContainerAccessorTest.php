<?php

namespace App;

use Domain\Fleet;
use Domain\Vehicle;
use Infra\DataContainer;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class AbstractDataContainerAccessorTest extends TestCase
{
    private const FLEETID = 'fleetId';
    private const PLATEID = 'vehiclePlate';

    public function tearDown(): void
    {
        $database = DataContainer::getInstance();
        $database->removeFleetFromId(self::FLEETID);
        $database->removeVehicleFromId(self::PLATEID);
    }

    public function testUnknownFleetThrowsException()
    {
        $dummy = new Dummy();
        $this->expectException(RuntimeException::class);
        $dummy->getFleet(self::FLEETID);
    }

    public function testUnknownVehicleThrowsException()
    {
        $dummy = new Dummy();
        $this->expectException(RuntimeException::class);
        $dummy->getVehicle(self::PLATEID);
    }

    public function testFleetAndVehicleArePersisted()
    {
        $fleet = new Fleet(self::FLEETID);
        $vehicle = new Vehicle(self::PLATEID);
        $dummy = new Dummy();
        $dummy->updateDataContainer($fleet, $vehicle);
        $database = DataContainer::getInstance();
        $this->assertNotNull($database->getFleetById(self::FLEETID));
        $this->assertNotNull($database->getVehicleById(self::PLATEID));
    }
}

class Dummy extends AbstractDataContainerAccessor {
    public function getFleet(string $fleetId): Fleet
    {
        return parent::getFleet($fleetId);
    }

    public function getVehicle(string $vehiclePlate): Vehicle
    {
        return parent::getVehicle($vehiclePlate);
    }

    public function updateDataContainer(Fleet $fleet, Vehicle $vehicle): void
    {
        parent::updateDataContainer($fleet, $vehicle);
    }
}
