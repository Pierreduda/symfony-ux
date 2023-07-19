<?php

namespace App\Service\Command;

use App\Entity\City;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCitiesService
{
    public function __construct(
        private readonly CityRepository         $cityRepo,
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    public function importCities(SymfonyStyle $io): void
    {
        $io->title('Import Cities');
        $cities = $this->readCsvFile();
        $io->progressStart(\count($cities));
        foreach ($cities as $arrayCity) {
            $io->progressAdvance();
            $city = $this->createOrUpdateCity($arrayCity);
            $this->entityManager->persist($city);
        }
        $this->entityManager->flush();
        $io->progressFinish();
        $io->success('Import success');
    }

    private function readCsvFile(): Reader
    {
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/cities.csv', 'r');
        $csv->setHeaderOffset(0);

        return $csv;
    }

    private function createOrUpdateCity(array $city): City
    {
        $entityCity = $this->cityRepo->findOneBy(['inseeCode' => $city['insee_code']]);
        if (!$entityCity) {
            $entityCity = new City();
        }

        $entityCity->setInseeCode($city['insee_code'])
            ->setLabel($city['label'])
            ->setCityCode($city['city_code'])
            ->setLatitude($city['latitude'])
            ->setDepartmentName($city['department_name'])
            ->setLongitude($city['longitude'])
            ->setDepartmentNumber($city['department_number'])
            ->setRegionGeoJsonName($city['region_geojson_name'])
            ->setRegionName($city['region_name'])
            ->setZipCode($city['zip_code']);

        return $entityCity;
    }
}