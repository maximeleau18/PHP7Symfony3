<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    protected $manager;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * (non-PHPdoc)
     * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 25; $i++) {
            // Make User
            $user = $this->makeUser($faker->userName, $faker->password, $faker->email);

            $this->manager->persist($user);
            $this->manager->flush();
        }
    }

    /*
     * Create a user
     *
         * @return \AppBundle\Entity\User
     */
    protected function makeUser($username, $password, $email)
    {
        $user = New User();
        $factory = $this->container->get('security.encoder_factory');
        $user->setUsername($username);
        $user->setEmail($email);
        $encoder = $factory->getEncoder($user);
        $passwordEncoded = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($passwordEncoded);
        $user->setEnabled(true);

        return $user;
    }

    /**
     * (non-PHPdoc)
     * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
     */
    public function getOrder()
    {
        return 1;
    }
}