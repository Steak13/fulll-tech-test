<?php

namespace Backend\App;

include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/App/VehicleRegisterer.php';
include_once dirname(__DIR__). '/../../Backend/PHP/Boilerplate/src/Infra/DataContainer.php';

use Backend\Domain\Fleet;
use Backend\Infra\DataContainer;
use LogicException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class VehicleRegistererTest extends TestCase
{
    /** @var DataContainer $dataContainer */
    private DataContainer $dataContainer;
    private const FLEETID = 'fleetId';
    private const PLATEID = 'testPlate';

    protected function setUp(): void
    {
        $this->dataContainer = DataContainer::getInstance();
        $fleet = new Fleet(self::FLEETID);
        $this->dataContainer->persistFleet($fleet);
    }

    protected function tearDown(): void
    {
        $this->dataContainer->removeFleetFromId(self::FLEETID);
        $this->dataContainer->removeVehicleFromId(self::PLATEID);
    }

    public function testFleetDoesNotExists()
    {
        $registerer = new VehicleRegisterer();
        $this->expectException(RuntimeException::class);
        $registerer->register('nonExistantFleetId', self::PLATEID);
    }

    public function testVehicleIsRegistered()
    {
        $registerer = new VehicleRegisterer();
        $registerer->register(self::FLEETID, self::PLATEID);
        $this->assertNotNull($this->dataContainer->getVehicleById(self::PLATEID));
        $fleet = $this->dataContainer->getFleetById(self::FLEETID);
        $this->assertNotEmpty($fleet->getVehicles()[self::PLATEID]);
    }

    public function testVehicleIsAlreadyRegistered()
    {
        $registerer = new VehicleRegisterer();
        $registerer->register(self::FLEETID, self::PLATEID);
        $this->expectException(LogicException::class);
        $registerer->register(self::FLEETID, self::PLATEID);
    }

    public function testVehicleIsRegisteredInTwoFleets()
    {
        $registerer = new VehicleRegisterer();
        $registerer->register(self::FLEETID, self::PLATEID);
        $secondFleet = new Fleet('secondFleetId');
        $this->dataContainer->persistFleet($secondFleet);
        $registerer->register('secondFleetId', self::PLATEID);

        $firstFleetVehicles = $this->dataContainer->getFleetById(self::FLEETID)->getVehicles();
        $this->assertNotEmpty($firstFleetVehicles[self::PLATEID]);

        $secondFleetVehicles = $this->dataContainer->getFleetById('secondFleetId')->getVehicles();
        $this->assertNotEmpty($secondFleetVehicles[self::PLATEID]);
    }
}
