<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRAND_NAMES = [
        "Apple",
        "Samsung",
        "Google",
        "OnePlus",
        "Xiaomi",
        "Huawei",
        "Sony",
        "LG",
        "Motorola",
        "Nokia",
        "Oppo",
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        foreach (self::BRAND_NAMES as $key => $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $manager->persist($brand);
            $this->addReference('brand_' . strtoupper($brandName), $brand);
        }

        $manager->flush();
    }
}
