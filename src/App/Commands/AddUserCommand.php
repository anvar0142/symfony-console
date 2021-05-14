<?php

namespace Console\App\Commands;
require_once 'config/bootstrap.php';

use Console\App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddUserCommand extends Command
{
    protected function configure()
    {
        $this->setName('add')
            ->setDescription('Add user')
            ->setHelp('Add user')
            ->addArgument('phone', InputArgument::REQUIRED, 'Enter the phone')
            ->addArgument('email', InputArgument::REQUIRED, 'Enter the email');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $entityManager;

        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setPhone($input->getArgument('phone'));
        $entityManager->persist($user);
        $entityManager->flush();
        $output->writeln('Added');
        return 0;
    }
}