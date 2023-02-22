<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class A2UsersFixtures extends Fixture {
    public function __construct( 
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger,
    ) {}

    public function load(ObjectManager $manager): void {
        $faker = Faker\Factory::create('fr_FR');

        $userAdmin = new User();
        $userAdmin->setFirstName( $faker->firstName );
        $userAdmin->setLastName( $faker->lastName );
        $userAdmin->setEmail( 'kodikof@outlook.com' );
        $userAdmin->setAddress( $faker->streetAddress );
        $userAdmin->setCity( $faker->country );
        $userAdmin->setZipCode( $faker->postcode );
        $userAdmin->setRoles([
            'ROLE_ADMIN'
        ]);
        $userAdmin->setPassword(
            $this->passwordEncoder->hashPassword( $userAdmin, 'password'),
        );
        $manager->persist($userAdmin);


        // using faker to generate randome users
        for( $i=1; $i<=10; $i++) {
            $user = new User();
            $user->setFirstName( $faker->firstName );
            $user->setLastName( $faker->lastName );
            $user->setEmail( $faker->email );
            $user->setAddress( $faker->streetAddress );
            $user->setCity( $faker->country );
            $user->setZipCode( $faker->postcode );
            $user->setPassword(
                $this->passwordEncoder->hashPassword( $user, 'password'),
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}
