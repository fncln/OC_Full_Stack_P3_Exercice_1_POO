<?php

// Point d'entrée principal de l'application en mode CLI.

// 1. Inclusion des dépendances du projet
require_once 'Command.php';
require_once 'config.php';
require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';

echo "=== Bienvenue dans votre carnet d'adresses ===\n";
echo "Commandes disponibles :\n";
echo "- list\n";
echo "- detail [id]\n";
echo "- create [nom], [email], [telephone]\n";
echo "- delete [id]\n";
echo "- exit\n\n";

// 2. Boucle interactive du terminal (CLI)
$command = new Command();

while (true) {

    $line = readline("Entrez votre commande : ");

    if ($line === 'list') {
        $command->list();
        continue;
    }

    if (preg_match("/^detail (.*)$/", $line, $matches)) {
        $command->detail((int)$matches[1]);
        continue;
    }

    if (preg_match("/^create (.*), (.*), (.*)$/", $line, $matches)) {
        $command->create(
            $matches[1],
            $matches[2],
            $matches[3]
        );
        continue;
    }

    if (preg_match("/^delete (.*)$/", $line, $matches)) {
        $command->delete((int)$matches[1]);
        continue;
    }

    if ($line === 'exit') {
        echo "Au revoir !\n";
        break;
    }

    echo "Commande inconnue\n";
}
