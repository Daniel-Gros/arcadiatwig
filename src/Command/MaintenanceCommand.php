<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:maintenance',
    description: 'Switch la page d\'accueil en mode maintenance ou inversement',
)]
class MaintenanceCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('action', InputArgument::REQUIRED, 'L\action à effectuer (activer ou désactiver la maintenance => enable , disable)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = $input->getArgument('action');
        $filesystem = new Filesystem();
        $webDir = __DIR__ . '/../../public';
        $homepage = $webDir . '/index.php';
        $maintenancePage = $webDir . '/maintenance.php';
        $backupPage = $webDir . '/index_backup.php';

        if ($action === 'enable') {
            if ($filesystem->exists($homepage) && !$filesystem->exists($backupPage)) {
                $filesystem->rename($homepage, $backupPage);
                $filesystem->copy($maintenancePage, $homepage);
                $output->writeln('Mode Maintenance Activé.');
            } else {
                $output->writeln('Le mode maintenance est déjà activé ou un fichier de backup existe déjà.');
            }
        } elseif ($action === 'disable') {
            if ($filesystem->exists($backupPage)) {
                $filesystem->rename($backupPage, $homepage);
                $output->writeln('Mode Maintenance Désactivé.');
            } else {
                $output->writeln('Le mode maintenance n\'est pas activé.');
            }
        } else {
            $output->writeln('Action non validée, utiliser "enable" ou "disable".');
            return Command::INVALID;
        }

        return Command::SUCCESS;
    }
}