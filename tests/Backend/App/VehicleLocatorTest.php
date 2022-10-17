<?php

namespace Backend\App;

include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/App/VehicleLocator.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Infra/DataContainer.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Domain/Location.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Domain/Fleet.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Domain/Vehicle.php';

use Backend\Domain\Fleet;
use Backend\Domain\Location;
use Backend\Domain\Vehicle;
use Backend\Infra\DataContainer;
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

    public function testVehicleNotInFleet()
    {
        $locator = new VehicleLocator();
        $this->expectException(RuntimeException::class);
        $locator->register(self::FLEETID, self::PLATEID, self::FLOAT, self::FLOAT);
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
        $locator->register(self::FLEETID, self::PLATEID, self::FLOAT, self::FLOAT);
    }

    public function testRegisterNewVehicleLocation()
    {
        $vehicle = new Vehicle(self::PLATEID);
        $this->database->persistVehicle($vehicle);

        $fleet = $this->database->getFleetById(self::FLEETID);
        $fleet->addVehicle($vehicle);
        $this->database->persistFleet($fleet);

        $locator = new VehicleLocator();
        $locator->register(self::FLEETID, self::PLATEID, self::FLOAT, self::FLOAT);
        $location = $this->database->getVehicleById(self::PLATEID)->getLocation();
        $this->assertNotNull($location);
    }
}
