<?php

namespace App\DataFixtures;

use App\Entity\ImeiDevice;
use App\Service\CalculatePriceService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImeiDeviceFixtures extends Fixture implements DependentFixtureInterface
{
    public const IMEI_NUMBERS = [
        '793526374825419',
        '62849103759873562',
        '91827364509182734',
        '463829175019283746',
        '2019384750293847',
        '5739402819273648',
        '8374920157293456',
        '102938475610293847',
        '29384756012938475',
        '48572639481726394',
    ];
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        foreach (self::IMEI_NUMBERS as $imeiNumner) {
            $imeiDevice = new ImeiDevice();
            $imeiDevice->setImeiNumber($imeiNumner);

            $randomModel = $faker->randomElement(ModelFixtures::MODELS);
            $model = $this->getReference('Model_' . $randomModel['numero']);
            $imeiDevice->setModel($model);

            $randRamItem = $faker->randomElement(CalculatePriceService::PARAM_RAM);
            $imeiDevice->setRamNumber($randRamItem['value']);

            $randStockageItem = $faker->randomElement(CalculatePriceService::PARAM_STOCKAGE);
            $imeiDevice->setStockageNumber($randStockageItem['value']);

            $imeiDevice->setScreenSize($faker->randomElement([5, 6, 3, 7, 8]));
            $imeiDevice->setYearManufacture($faker->numberBetween(2010, 2023));

            $imeiDevice->setNetworkSpeed($faker->randomElement(['3G', '4G', '5G']));

            $manager->persist($imeiDevice);
            $this->addReference('ImeiDevice_' . $imeiNumner, $imeiDevice);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ModelFixtures::class,
        ];
    }
}
