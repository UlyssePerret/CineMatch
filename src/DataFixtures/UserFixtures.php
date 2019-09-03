<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('Admin@fake.com');
        $admin->setPseudo('root');
        $admin->setPassword($this->encoder->encodePassword($admin, 'Admin'));
        $admin->setStatut(0);// 0=> Admin
        $admin->setNom('admin');
        $admin->setPrenom('admin');
        $admin->setDescription('description');
        $admin->setPhoto('url://image');

        $this->addReference('Admin', $admin);
        $manager->persist($admin);


        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@fake.com');
            $user->setPseudo('user' . $i);
            $user->setPassword($this->encoder->encodePassword($user, 'user' . $i));
            $user->setStatut(1);
            $this->addReference('user' . $i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
