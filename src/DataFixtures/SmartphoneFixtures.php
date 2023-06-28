<?php

namespace App\DataFixtures;

use App\Entity\Model;
use App\DataFixtures\BrandFixtures;
use App\DataFixtures\DeviceStateFixtures;
use App\DataFixtures\ModelFixtures;
use App\DataFixtures\UserFixtures;
use App\Entity\Smartphone;
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
            $randomDeviceState = $faker->randomElement(DeviceStateFixtures::DEVICE_STATES);

            //DEVICE STATE INFO
            $deviceState = $this->getReference('DeviceState_' . $randomDeviceState['code']);
            $smartphone->setDeviceState($deviceState);

            //MODEL INFO
            $model = $this->getReference('Model_' . $randomModel['numero']);
            $smartphone->setBasePrice($model->GetBasePrice());
            $smartphone->setModel($model);
            $smartphone->setNetworkSpeed($model->getNetworkSpeed());
            $smartphone->setRamNumber($model->getRamNumber());
            $smartphone->setStockageNumber($model->getStockageNumber());
            $smartphone->setScreenSize($model->getScreenSize());
            $smartphone->setYearManufacture($model->getYearManufacture());

            //OPERATOR INFO
            $operator = $this->getReference('User_OPERATOR');
            $smartphone->setOperator($operator);

            //OTHER INFO
            $smartphone->setImeiNumber('');
            $smartphone->setDevicePicturePath('');
            $smartphone->setRateCo2($faker->numberBetween(10, 30));

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
