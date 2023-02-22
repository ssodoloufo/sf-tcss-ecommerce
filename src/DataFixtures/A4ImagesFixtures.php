<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class A4ImagesFixtures extends Fixture {
    public function load(ObjectManager $manager): void {
        $faker = Faker\Factory::create('fr_FR');
        
        // using faker to generate randome users
        for( $i=1; $i<=100; $i++) {
            $img = new Image();

            $img->setName( $faker->image(null, 640, 480) );

            // access the reference that we added in ProductsFixtures
            $product = $this->getReference( 'prod-'. rand(1,50) );
            $img->setProduct( $product );

            $manager->persist($img);
        }

        $manager->flush();
    }
}
