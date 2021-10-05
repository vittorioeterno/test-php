<?php

namespace App\Command;

use App\Service\CityWeatherService;
use App\Utils\NumberUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CityWeatherCommand extends Command {

    protected static $defaultName = 'app:city-weather';

    private CityWeatherService $city_weather_service;

    /** 
     * CityWeatherCommand constructor
     * 
     * @param CityWeatherService $city_weather_service
     */
    public function __construct(CityWeatherService $city_weather_service) {

        $this->city_weather_service = $city_weather_service;

        parent::__construct();
    }

    protected function configure() : void 
    {

        $this
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, 'Input to set the desired limit', 10)
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, 'Input to set the desired offset', 0)
            ->addOption('sort-by', null, InputOption::VALUE_OPTIONAL, 'Input to set the desired sort by of cities', 'weigth')
            ->addOption('forecast-days', null, InputOption::VALUE_OPTIONAL, 'Input to set the desired forecast value ranges between 1 and 10', 2)
            ->setHelp('i.e.: php bin/console app:city-weather --limit=15 --offset=15 --forecast-days=3')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output) {

        $limit          = $input->getOption('limit');
        $offset         = $input->getOption('offset');
        $sort_by        = $input->getOption('sort-by');
        $forecast_days  = $input->getOption('forecast-days');

        if (!NumberUtils::isPositiveNumber($limit) || !NumberUtils::isPositiveNumber($offset) || !NumberUtils::isPositiveNumber($forecast_days)) {
            $output->writeln("\n\nError with input options\n");
            return 0;
        }

        if ($forecast_days > 10) {
            $output->writeln("\n\nError: out of forecast range\n");
            return 0;
        }

        $result = $this->city_weather_service->getCitiesWeathers($limit,$offset,$sort_by,$forecast_days);

        if (!empty($result) && count($result)>0) {
            
            $output->writeln("");
            foreach ($result as $r) {
                $output->writeln("Processed city ".$r[0]." | ".$r[1]." - ".$r[1]);
            }
            $output->writeln("");
        }

        return 0;
    }
}