<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   $types=["Appartement","Villa","Maison", "Ferme"];
        $faker= Factory::create('fr_FR');
        $image=['uploads/property/villa.jpg','uploads/property/villa1.jpg','uploads/property/villa2.jpg','uploads/property/villa3.jpg'];
        for ($i=0;$i<50;$i++){
            $bien = new Property();
            $bien->setCreatedAt($faker->dateTimeBetween( '-3 years','now', $timezone = null));
            $bien->setAddress($faker->address);
            $bien->setBedrooms($faker->numberBetween(0,8));
            $bien->setDescription($faker->text);
            $bien->setFloor($faker->numberBetween(0,10));
            $bien->setHeat($faker->numberBetween(1,2));
            $bien->setPostalCode($faker->numberBetween(1000,9999));
            $bien->setPrice($faker->randomFloat(NULL,10000));
            $bien->setRooms($faker->randomDigit());
            $bien->setTitle($faker->company);
            $bien->setSurface($faker->randomFloat(4,10,1999));
            $bien->setVille($faker->city);
            $bien->setSold($faker->boolean);
            $bien->setLocation($faker->boolean);
            $bien->setType($faker->randomElement($types));
            $bien->setPath($image[$i%4]);
            $manager->persist($bien);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
