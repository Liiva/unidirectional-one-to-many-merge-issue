<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$user = new User();

    	$user
			->setName('John')
			->addPost((new Post())->setName('Post 1'))
			->addPost((new Post())->setName('Post 2'));

        $manager->persist($user);

        $manager->flush();
    }
}
