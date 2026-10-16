<?php

// Point d'entrée principal de l'application en mode CLI.

// 1. Inclusion des dépendances du projet
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
        // Instanciation du manager pour récupérer les contacts de la base de données
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();

        if (empty($contacts)) {
            echo "Aucun contact trouvé dans le carnet d'adresses.\n";
        } else {
            echo "--- Liste des contacts ---\n";
            // Affichage de chaque contact grâce à la méthode __toString()
            foreach ($contacts as $contact) {
                echo $contact . "\n";
            }
        }
    } elseif ($line === 'exit') {
        echo "Au revoir !\n";
        break;
    } else {
        echo "Commande inconnue\n";
    }
}