<?php

namespace App\Command;

use App\FleetCreator;
use LogicException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterFleetCommand extends Command
{
    private const ARG_USERID = 'userId';
    protected static $defaultName = 'app:fleet:register';
    protected static $defaultDescription = "Création d'une flotte de véhicule pour un usager";
    /** @var FleetCreator $fleetCreator */
    private FleetCreator $fleetCreator;

    public function __construct()
    {
        parent::__construct();
        $this->fleetCreator = new FleetCreator();
    }

    protected function configure()
    {
        $this->addArgument(self::ARG_USERID, InputArgument::REQUIRED, 'Identifiant usager lié à cette flotte');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userId = $input->getArgument(self::ARG_USERID);
        try {
            $fleetId = $this->fleetCreator->create($userId);
        } catch (LogicException $exception) {
            $output->writeln('XXXXX -------------------------- XXXXX');
            $output->writeln('Echec de la création de la flotte pour le motif suivant :');
            $output->writeln($exception->getMessage());
            $output->writeln('XXXXX -------------------------- XXXXX');
            return self::FAILURE;
        }
        $output->writeln('VVVVV -------------------------- VVVVV');
        $output->writeln("Votre flotte a bien été crée sour l'identifiant suivant :");
        $output->writeln($fleetId);
        $output->writeln('VVVVV -------------------------- VVVVV');
        return self::SUCCESS;
    }
}
