<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Création de nouvel utilisateur admin'
)]
class CreateAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Créér un nouvel utilisateur admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $io->ask('email de l\'admin?', 'admin@exemple.com');
        $password = $io->askHidden('Mot de passe Admin?');


        $user = new User();
        $user->setEmail($email);
        $user->setRoles(['ROLE_ADMIN']);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $io->success(sprintf('L\'utilisateur admin "%s" a été créé avec succès !', $email));
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('Ne peut pas créer l\'utilisateur admin: ' . $e->getMessage());
            
            return Command::FAILURE;
        }
    }
}

