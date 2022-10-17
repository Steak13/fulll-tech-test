<?php

namespace App\Command;

use App\VehicleLocator;
use LogicException;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LocalizeVehicleCommand extends Command
{
    private const ARG_VEHICLEPLATE = 'plate';
    private const ARG_LAT = 'lat';
    private const ARG_LNG = 'lng';
    protected static $defaultName = 'app:vehicle:localize';
    protected static $defaultDescription = "Positionnement géographique d'un véhicule";
    /** @var VehicleLocator $vehicleLocator */
    private VehicleLocator $vehicleLocator;

    public function __construct()
    {
        parent::__construct();
        $this->vehicleLocator = new VehicleLocator();
    }

    protected function configure()
    {
        $this->addArgument(self::ARG_VEHICLEPLATE, InputArgument::REQUIRED, "Immatriculation du véhicule");
        $this->addArgument(self::ARG_LAT, InputArgument::REQUIRED, "Latitude du véhicule");
        $this->addArgument(self::ARG_LNG, InputArgument::REQUIRED, "Longitude du véhicule");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vehiclePlate = $input->getArgument(self::ARG_VEHICLEPLATE);
        $lat = $input->getArgument(self::ARG_VEHICLEPLATE);
        $lng = $input->getArgument(self::ARG_VEHICLEPLATE);
        try {
            $this->vehicleLocator->register($vehiclePlate, $lat, $lng);
        } catch (LogicException | RuntimeException $exception) {
            $output->writeln('XXXXX -------------------------- XXXXX');
            $output->writeln("Echec de localisation du véhicule pour la raison suivante :");
            $output->writeln($exception->getMessage());
            $output->writeln('XXXXX -------------------------- XXXXX');
            return self::FAILURE;
        }
        $output->writeln('VVVVV -------------------------- VVVVV');
        $output->writeln("Votre véhicule à bien été localisé");
        $output->writeln('VVVVV -------------------------- VVVVV');
        return self::SUCCESS;
    }
}
