<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
/*
	    for ($i=1 ; $i<5 ; $i++){
			$user = new Users();
		    $user->setName('Noom');
		    $manager->persist( $user );
	    }
*/

        $manager->flush();
    }
}
