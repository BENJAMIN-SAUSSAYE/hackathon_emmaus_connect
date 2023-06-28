<?php

namespace App\DataFixtures;

use App\Entity\DeviceState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DeviceStateFixtures extends Fixture
{
    public const DEVICE_STATES = [
        ['code' => 'DEEE', 'libelle' => 'A recycler pour pièce'],
        ['code' => 'REPARABLE', 'libelle' => 'Nécéssite une réparation'],
        ['code' => 'BLOQUE', 'libelle' => 'Inutilisable bloqué'],
        ['code' => 'RECONDITIONABLE', 'libelle' => 'Utilisable en l\'état'],
        ['code' => 'RECONDITIONNE', 'libelle' => 'Très bon état']
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DEVICE_STATES as $key => $itemState) {
            $deviceState = new DeviceState();
            $deviceState->setState($itemState['libelle']);
            $deviceState->setStateCode($itemState['code']);
            $this->addReference('DeviceState_' . $itemState['code'], $deviceState);
            $manager->persist($deviceState);
        }
        $manager->flush();
    }
}
