<?php

namespace Infra;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Fleet;
use Domain\Vehicle;

class DataContainer
{
    /** @var DataContainer|null $instance */
    private static ?DataContainer $instance = null;

    private function __construct() {}

    /**
     * @return DataContainer
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new DataContainer();
        }
        return self::$instance;
    }

    /**
     * @param Fleet $fleet
     * @return void
     */
    public function persistFleet(Fleet $fleet): void
    {
        $this->getEntityManager()->persist($fleet);
    }

    /**
     * @param string $id
     * @return Fleet|null
     */
    public function getFleetById(string $id): object
    {
        return $this->getEntityManager()->find(Fleet::class, $id);
    }

    /**
     * @param string $id
     * @return void
     */
    public function removeFleetFromId(string $id): void
    {
        $fleet = $this->getEntityManager()->find(Fleet::class, $id);
        $this->getEntityManager()->remove($fleet);
    }

    /**
     * @param Vehicle $vehicle
     * @return void
     */
    public function persistVehicle(Vehicle $vehicle): void
    {
        $this->getEntityManager()->persist($vehicle);
    }

    /**
     * @param string $id
     * @return Vehicle|null
     */
    public function getVehicleById(string $id): object
    {
        return $this->getEntityManager()->find(Vehicle::class, $id);
    }

    /**
     * @param string $id
     * @return void
     */
    public function removeVehicleFromId(string $id): void
    {
        $vehicle = $this->getEntityManager()->find(Vehicle::class, $id);
        $this->getEntityManager()->remove($vehicle);
    }

    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager(): EntityManagerInterface
    {
        return $GLOBALS['APP']['ENTITY_MANAGER'];
    }
}
