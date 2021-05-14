<?php


namespace Console\App\Commands;
require_once 'config/bootstrap.php';

use Console\App\Entity\Cart;
use Console\App\Entity\User;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendMessageCommand extends Command
{
    protected function configure()
    {
        $this->setName('send')
            ->setDescription('Send message to user')
            ->setHelp('Send message to user')
            ->addArgument('id', InputArgument::REQUIRED, 'Enter the user id');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $entityManager;
        $id = $input->getArgument('id');

        $user = $entityManager->find(User::class, $id);
        if ($user == null) {
            $output->writeln("No user with this id");
        } else {
            $rsm = new ResultSetMappingBuilder($entityManager);
            $rsm->addEntityResult(Cart::class, 'd');
            $rsm->addFieldResult('d', 'id', 'id');
            $rsm->addFieldResult('d', 'title', 'title');
            $rsm->addFieldResult('d', 'price', 'price');
            $rsm->addFieldResult('d', 'email', 'email');
            $rsm->addFieldResult('d', 'sended', 'sended');
            $rsm->addFieldResult('d', 'user_id', 'user_id');
            $sql = "SELECT * FROM cart WHERE sended=0 AND user_id={$id}";
            $cart = $entityManager->createNativeQuery($sql,$rsm)->getResult();
            if (empty($cart)) {
                $output->writeln('No orders');
            }
            $text = '';
            $price = 0;
            foreach ($cart as $item) {
                $text .= "{$item->getTitle()} = {$item->getPrice()} <br>";
                $price += $item->getPrice();
                $item->setSended(1);
                $entityManager->persist($item);
                $entityManager->flush();
            }

            /*
             * Sending method
             */
            $message = $text.'<br>Total: '.$price;
            if (mail('anvar0142@gmail.com', 'Checklist', $message)) {
                $output->writeln("Sended, {$text}, {$price}");
            } else {
                $output->writeln("Something is wrong here ");
            }
            /******************************/

        }
        return 0;
    }
}