<?php

// Point d'entrée principal de l'application en mode CLI.

// 1. Inclusion des dépendances du projet
require_once 'Command.php';
require_once 'config.php';
require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';

echo "=== Bienvenue dans votre carnet d'adresses ===\n";
echo "Tapez 'list' pour afficher les contacts ou 'exit' pour quitter.\n\n";

// 2. Boucle interactive du terminal (CLI)
while (true) {
    $line = readline("Entrez votre commande : ");

    if ($line === 'list') {
            $command = new Command();

            $command->list();
            
    } elseif ($line === 'exit') {
        echo "Au revoir !\n";
        break;
    } else {
        echo "Commande inconnue\n";
    }
}