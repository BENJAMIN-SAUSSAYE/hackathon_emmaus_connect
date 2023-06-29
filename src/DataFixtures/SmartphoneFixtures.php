<?php

namespace App\DataFixtures;

use App\DataFixtures\BrandFixtures;
use App\DataFixtures\ModelFixtures;
use App\DataFixtures\UserFixtures;
use App\Entity\Smartphone;
use App\Service\CalculatePriceService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class SmartphoneFixtures extends Fixture implements DependentFixtureInterface
{
    public const SMARTPHONE_COUNT = 50;

    public function __construct()
    {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //SMARTPHONE WITH ASSOCIATED MODEL !!
        for ($i = 0; $i < self::SMARTPHONE_COUNT; $i++) {
            $smartphone = new Smartphone();
            $randomModel = $faker->randomElement(ModelFixtures::MODELS);

            //MODEL INFO
            $model = $this->getReference('Model_' . $randomModel['numero']);
            $smartphone->setBasePrice($model->GetBasePrice());
            $smartphone->setModel($model);

            //OPERATOR INFO
            $operator = $this->getReference('User_OPERATOR');
            $smartphone->setOperator($operator);

            //OTHER INFO
            $smartphone->setImeiNumber('');
            $smartphone->setNetworkSpeed($faker->randomElement(['3G', '4G', '5G']));

            $randRamItem = $faker->randomElement(CalculatePriceService::PARAM_RAM);
            $smartphone->setRamNumber($randRamItem['value']);

            $randStockageItem = $faker->randomElement(CalculatePriceService::PARAM_STOCKAGE);
            $smartphone->setStockageNumber($randStockageItem['value']);

            $smartphone->setScreenSize($faker->randomElement([5, 6, 3, 7, 8]));
            $smartphone->setYearManufacture($faker->numberBetween(2010, 2023));
            $smartphone->setComment($faker->sentence($nbWords = 25));
            $smartphone->setPonderation($faker->randomElement([-100, -50, -20, 0, +10]));
            $smartphone->setDevicePicturePath("/images/placeholder/iphonePlaceHolder.svg");
            $smartphone->setRateCo2($faker->numberBetween(10, 30));
            $calculatePriceService = new CalculatePriceService($smartphone);
            $smartphone->setCalculatePrice($calculatePriceService->getFinalPrice());
            $manager->persist($smartphone);
        }

        //CREATE SMARTPHONE ASSOCIATED TO IMEI NUMBER
        foreach (ImeiDeviceFixtures::IMEI_NUMBERS as $imeiNumber) {
            $smartphone = new Smartphone();
            $itemDevice = $this->getReference('ImeiDevice_' . $imeiNumber);
            $smartphone->setBasePrice($itemDevice->getModel()->getBasePrice());
            $smartphone->setModel($itemDevice->getModel());

            //OPERATOR INFO
            $operator = $this->getReference('User_OPERATOR');
            $smartphone->setOperator($operator);

            //OTHER INFO
            $smartphone->setImeiNumber($imeiNumber);
            $smartphone->setNetworkSpeed($itemDevice->getNetworkSpeed());
            $smartphone->setRamNumber($itemDevice->getRamNumber());
            $smartphone->setStockageNumber($itemDevice->getStockageNumber());
            $smartphone->setScreenSize($itemDevice->getScreenSize());
            $smartphone->setYearManufacture($itemDevice->getYearManufacture());

            $smartphone->setComment($faker->sentence($nbWords = 25));
            $smartphone->setPonderation($faker->randomElement([-100, -50, -20, 0, +10]));
            $smartphone->setDevicePicturePath("/images/placeholder/iphonePlaceHolder.svg");
            $smartphone->setRateCo2($faker->numberBetween(10, 30));
            $smartphone->setCalculatePrice($faker->numberBetween(1, 100));
            $manager->persist($smartphone);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ImeiDeviceFixtures::class,
            UserFixtures::class,
            BrandFixtures::class,
            ModelFixtures::class,
        ];
    }
}
