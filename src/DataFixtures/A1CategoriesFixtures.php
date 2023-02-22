<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class A1CategoriesFixtures extends Fixture {
    private $myCounter = 1;

    public function __construct( private SluggerInterface $slugger ) {}

    public function load(ObjectManager $manager): void {
        ## parent 1
        $catParent = $this->createCategory('Console de jeux vidéos', NULL, $manager);
        // his children
        $this->createCategory('Sony PlayStation', $catParent, $manager);
        $this->createCategory('Microsoft Xbox', $catParent, $manager);
        $this->createCategory('Nintendo Switch', $catParent, $manager);
        $this->createCategory('Atari Flashback', $catParent, $manager);

        ## parent 2
        $catParent = $this->createCategory('Informatiques et réseaux', NULL, $manager);
        // his children
        $this->createCategory('Ordinateurs', $catParent, $manager);
        $this->createCategory('Routeurs', $catParent, $manager);
        $this->createCategory('Téléphones IP', $catParent, $manager);
        $this->createCategory('Caméras IP', $catParent, $manager);
        $this->createCategory('Switchs', $catParent, $manager);

        ## parent 3
        $catParent = $this->createCategory('Vêtements et accessoires', NULL, $manager);
        // his children
        $this->createCategory('Pour hommes', $catParent, $manager);
        $this->createCategory('Pour enfants', $catParent, $manager);
        $this->createCategory('Pour femmes', $catParent, $manager);
        $this->createCategory('Pour tous', $catParent, $manager);

        ## parent 4
        $catParent = $this->createCategory('Appareils électroménagés ', NULL, $manager);
        // his children
        $this->createCategory('Fers à repasser', $catParent, $manager);
        $this->createCategory('Télévisions', $catParent, $manager);
        $this->createCategory('ventilateurs', $catParent, $manager);
        $this->createCategory('Micro-ondes', $catParent, $manager);
        $this->createCategory('Réfrigérateurs', $catParent, $manager);

        ## parent 5
        $catParent = $this->createCategory('Moyens de transports', NULL, $manager);
        // his children
        $this->createCategory('Voitures', $catParent, $manager);
        $this->createCategory('Motos', $catParent, $manager);
        $this->createCategory('Vélos', $catParent, $manager);
        $this->createCategory('Mini bus', $catParent, $manager);

        ## parent 6
        $catParent = $this->createCategory('La littérature', NULL, $manager);
        // his children
        $this->createCategory('Romans', $catParent, $manager);
        $this->createCategory('Encyclopédies', $catParent, $manager);
        $this->createCategory('Mangas', $catParent, $manager);

        $manager->flush();
    }

    public function createCategory(String $name, Category $catParent = NULL, ObjectManager $manager) {
        $catChild = new Category();

        $catChild->setName( $name );
        $catChild->setSlug( $this->slugger->slug( $catChild->getName() )->lower() );
        $catChild->setParent($catParent);

        $manager->persist($catChild);

        // save current category in memory as reference name "cat-$myCounter"
        $this->addReference( 'cat-'. $this->myCounter, $catChild );
        $this->myCounter++;

        return $catChild;
    }
}
