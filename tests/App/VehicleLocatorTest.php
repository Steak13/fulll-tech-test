<?php

namespace App;

use Domain\Fleet;
use Domain\Location;
use Domain\Vehicle;
use Infra\DataContainer;
use LogicException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class VehicleLocatorTest extends TestCase
{
    /** @var DataContainer $database */
    private DataContainer $database;
    private const FLEETID = 'fleetId';
    private const PLATEID = 'testPlate';
    private const FLOAT = 1.00;

    protected function setUp(): void
    {
        $this->database = DataContainer::getInstance();
        $this->database->persistFleet(new Fleet(self::FLEETID));
    }

    protected function tearDown(): void
    {
        $this->database->removeFleetFromId(self::FLEETID);
    }

    public function testVehicleHasNoNewLocation()
    {
        $vehicle = new Vehicle(self::PLATEID);
        $vehicle->setLocation(new Location(self::FLOAT, self::FLOAT));
        $this->database->persistVehicle($vehicle);

        $fleet = $this->database->getFleetById(self::FLEETID);
        $fleet->addVehicle($vehicle);
        $this->database->persistFleet($fleet);

        $locator = new VehicleLocator();
        $this->expectException(LogicException::class);
        $locator->register(self::PLATEID, self::FLOAT, self::FLOAT);
    }

    public function testRegisterNewVehicleLocation()
    {
        $vehicle = new Vehicle(self::PLATEID);
        $this->database->persistVehicle($vehicle);

        $fleet = $this->database->getFleetById(self::FLEETID);
        $fleet->addVehicle($vehicle);
        $this->database->persistFleet($fleet);

        $locator = new VehicleLocator();
        $locator->register(self::PLATEID, self::FLOAT, self::FLOAT);
        $location = $this->database->getVehicleById(self::PLATEID)->getLocation();
        $this->assertNotNull($location);
    }
}
