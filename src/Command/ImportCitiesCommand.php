<?php

namespace App\Command;

use App\Service\Command\ImportCitiesService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Importe un fichier csv contenant toutes les communes de France et les enregistre
 */
#[AsCommand(name: 'app:import-cities')]
class ImportCitiesCommand extends Command
{
    public function __construct(private readonly ImportCitiesService $importCitiesService)
    {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->importCitiesService->importCities($io);

        return Command::SUCCESS;
    }

}