<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Role;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{   
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $role1 = new Role();
        $role2 = new Role();
        $role1->setLibelle("ROLE_ADMIN");
        $role2->setLibelle("ROLE_CAISSIER");
        $manager->persist($role1);
        $manager->persist($role2);
        
        $user = new User("admin");
        $user->setPassword($this->encoder->encodePassword($user, "admin"));
        $user->setRoles(array("ROLE_SUPADMIN"));
        $user->setUsername("admin");
        $user->setIsActif(true);
        $user->setNomComplete("admin");
        $manager->persist($user);

        $manager->flush();
    }
}
