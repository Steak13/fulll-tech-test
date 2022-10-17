<?php

namespace App\Command;

use App\VehicleRegisterer;
use LogicException;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterVehicleCommand extends Command
{
    private const ARG_FLEETID = 'fleetId';
    private const ARG_VEHICLEPLATE = 'plate';
    protected static $defaultName = 'app:vehicle:register';
    protected static $defaultDescription = "Ajout d'un véhicule à une flotte";
    /** @var VehicleRegisterer $vehicleRegisterer */
    private VehicleRegisterer $vehicleRegisterer;

    public function __construct()
    {
        parent::__construct();
        $this->vehicleRegisterer = new VehicleRegisterer();
    }

    protected function configure()
    {
        $this->addArgument(self::ARG_FLEETID, InputArgument::REQUIRED, "Identifiant unique de la flotte");
        $this->addArgument(self::ARG_VEHICLEPLATE, InputArgument::REQUIRED, "Immatriculation du véhicule");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fleetId = $input->getArgument(self::ARG_FLEETID);
        $vehiclePlate = $input->getArgument(self::ARG_VEHICLEPLATE);
        try {
            $this->vehicleRegisterer->register($fleetId, $vehiclePlate);
        } catch (LogicException | RuntimeException $exception) {
            $output->writeln('XXXXX -------------------------- XXXXX');
            $output->writeln("Echec de l'enregistrement du véhicule à la flotte pour la raison suivante :");
            $output->writeln($exception->getMessage());
            $output->writeln('XXXXX -------------------------- XXXXX');
            return self::FAILURE;
        }
        $output->writeln('VVVVV -------------------------- VVVVV');
        $output->writeln("Votre véhicule à bien été rattaché à la flotte");
        $output->writeln('VVVVV -------------------------- VVVVV');
        return self::SUCCESS;
    }
}
