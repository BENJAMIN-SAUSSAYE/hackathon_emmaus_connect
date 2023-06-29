<?php

namespace App\DataFixtures;

use App\Entity\Model;
use App\DataFixtures\BrandFixtures;
use App\DataFixtures\DeviceStateFixtures;
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
            $smartphone->setRamNumber($faker->randomElement(CalculatePriceService::PARAM_RAM));
            $smartphone->setStockageNumber($faker->randomElement(CalculatePriceService::PARAM_STOCKAGE));
            $smartphone->setScreenSize($faker->randomElement([5, 6, 3, 7, 8]));
            $smartphone->setYearManufacture($faker->numberBetween(2010, 2023));
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
            UserFixtures::class,
            BrandFixtures::class,
            ModelFixtures::class,
            DeviceStateFixtures::class,
        ];
    }
}
