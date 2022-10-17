<?php

namespace App;

use Domain\Fleet;
use LogicException;
use RuntimeException;

class FleetCreator extends AbstractDataContainerAccessor
{
    private const CREATION_HASH = 'ripemd128';

    /**
     * @param string $userId
     * @throws RuntimeException
     * @return string
     */
    public function create(string $userId): string
    {
        $fleetId = hash(self::CREATION_HASH, $userId);
        $this->checkFleetDoesNotExists($fleetId);
        $fleet = new Fleet($fleetId);
        $this->updateFleet($fleet);

        return $fleetId;
    }

    /**
     * @param string $fleetId
     * @throws RuntimeException
     * @return void
     */
    private function checkFleetDoesNotExists(string $fleetId): void
    {
        try {
            $this->getFleet($fleetId);
        } catch (RunTimeException $exception) {
            return;
        }
        throw new LogicException("Fleet already exists for this user, id : $fleetId");
    }
}
