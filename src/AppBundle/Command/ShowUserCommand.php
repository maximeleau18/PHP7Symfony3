<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('show_users')
        ->setDescription('Lists all user in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $users = $this->getContainer()->get('schema_user')->findAllUsers();
        $usersStr = '';

        foreach($users as $user){
            $usersStr = $usersStr . $user->getUsername() . ' ' . $user->getEmail() . "\n";
        }
        print($usersStr);
    }
}