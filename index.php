<?php

use Console\App\Entity\User;

require_once 'config/bootstrap.php';
$user = new User();
$user->setEmail('anvar0142@gmail.com');
$user->setPhone('+998937858104');
$entityManager->persist($user);
$entityManager->flush();