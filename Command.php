<?php

// Classe Command
// Contient la logique des commandes de l'application
class Command
{
    // Commande list : affiche tous les contacts
    public function list(): void
    {
        $contactManager = new ContactManager();

        $contacts = $contactManager->findAll();

        if (empty($contacts)) {
            echo "Aucun contact trouvé dans le carnet d'adresses.\n";
        } else {
            echo "--- Liste des contacts ---\n";

            foreach ($contacts as $contact) {
                echo $contact . "\n";
            }
        }
    }
}