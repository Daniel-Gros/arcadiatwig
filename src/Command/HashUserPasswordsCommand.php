<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

#[AsCommand(
    name: 'hash:user-passwords',
    description: 'Hash user passwords in the database',
)]
class HashUserPasswordsCommand extends Command
{
    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            $io->note('Option1 was passed');
        }

        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        foreach ($users as $user) {
            if (!$user->isPasswordHashed()) {
                $hashedPassword = $this->passwordHasher->hashPassword($user, $user->getPassword());
                $user->setPassword($hashedPassword);
                $user->setPasswordHashed(true);
            }
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->entityManager->clear();


        $io->success('Le mot de passe utilisateur a été hash avec succès.');


        $user = $userRepository->findOneBy(['email' => 'josearcadiapersonnefictive@gmail.com']);

        if ($user) {
            $io->writeln("L'utilisateur admin a été trouvé.");

            if (!$user->isPasswordHashed()) {
                $hashedPassword = $this->passwordHasher->hashPassword($user, $user->getPassword());
                $user->setPassword($hashedPassword);
                $user->setPasswordHashed(true);

                $io->success("Mot de passe de l'utilisateur admin haché avec succès.");
            } else {
                $io->writeln("Mot de passe déjà haché pour l'utilisateur admin.");
            }
        } else {
            $io->error("L'utilisateur admin n'a pas été trouvé.");
        }
        $this->entityManager->persist($user);
        try {
            $this->entityManager->flush();
            $io->success('Modifications enregistrées en base de données.');
        } catch (\Exception $e) {
            $io->error("Erreur lors de la sauvegarde : " . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
