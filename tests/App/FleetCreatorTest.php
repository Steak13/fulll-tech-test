<?php

namespace App;

use Infra\DataContainer;
use LogicException;
use PHPUnit\Framework\TestCase;

class FleetCreatorTest extends TestCase
{
    public function testFleetIsCreated()
    {
        $creator = new FleetCreator();
        $fleetId = $creator->create('userId');
        $database = DataContainer::getInstance();
        $fleet = $database->getFleetById($fleetId);
        $this->assertNotNull($fleet);
        DataContainer::getInstance()->removeFleetFromId($fleetId);
    }

    public function testFleetAlreadyExistsForUser()
    {
        $creator = new FleetCreator();
        $fleetId = $creator->create('userId');
        $this->expectException(LogicException::class);
        $creator->create('userId');
        DataContainer::getInstance()->removeFleetFromId($fleetId);
    }
}
