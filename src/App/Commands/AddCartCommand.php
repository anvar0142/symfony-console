<?php

namespace Console\App\Commands;
require_once 'config/bootstrap.php';

use Console\App\Entity\Cart;
use Console\App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCartCommand extends Command
{
    protected function configure()
    {
        $this->setName('add_order')
            ->setDescription('Add order')
            ->setHelp('Add order')
            ->addArgument('user_id', InputArgument::REQUIRED, 'Enter the user_id')
            ->addArgument('title', InputArgument::REQUIRED, 'Enter the title')
            ->addArgument('price', InputArgument::REQUIRED, 'Enter the price');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $entityManager;
        $user = $entityManager->find(User::class, $input->getArgument('user_id'));
        if ($user == null) {
            $output->writeln("No user with this id");
        } else {
            $cart = new Cart();
            $cart->setTitle($input->getArgument('title'));
            $cart->setPrice($input->getArgument('price'));
            $cart->setUserId($input->getArgument('user_id'));
            $cart->setSended(false);
            $entityManager->persist($cart);
            $entityManager->flush();
            $output->writeln(print_r($user, true));
        }

        return 0;
    }
}