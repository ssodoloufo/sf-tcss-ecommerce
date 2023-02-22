<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class A3ProductsFixtures extends Fixture {
    public function __construct( private SluggerInterface $slugger ) {}

    public function load(ObjectManager $manager): void {
        $faker = Faker\Factory::create('fr_FR');
        
        // using faker to generate randome users
        for( $i=1; $i<=50; $i++) {
            $product = new Product();

            $product->setName( $faker->text(20) );
            $product->setSlug( $this->slugger->slug( $product->getName() )->lower() );
            $product->setDescription( $faker->text() );
            $product->setPrice( $faker->numberBetween( 5000, 5000000) ); // FCFA
            $product->setStock( $faker->numberBetween( 0, 20) );

            // access the reference that we added in CategoriesFixtures
            $category = $this->getReference( 'cat-'. rand(1,31) );
            $product->setCategory( $category );

            // save current product in memory as reference name "prod-$i"
            $this->addReference( 'prod-'. $i, $product );

            $manager->persist($product);
        }

        $manager->flush();
    }
}
