<?php

// Classe Command
// Contient la logique des commandes de l'application
class Command

{
    private ContactManager $manager;

    //Initialise le gestionnaire de contacts
    public function __construct()
    {
        $this->manager = new ContactManager();
    }

    // Affiche le détail d'un contact
    // @param int $id Identifiant du contact à afficher
    public function detail(int $id): void
    {
        $contact = $this->manager->findById($id);

        if ($contact === null) {
            echo "Contact non trouvé\n";
            return;
        }

        echo $contact . "\n";
    }

    // Crée un nouveau contact
    // @param string $name Nom du contact
    // @param string $email Email du contact
    // @param string $phone Téléphone du contact
    public function create(
        string $name,
        string $email,
        string $phone
    ): void {

        $this->manager->create(
            $name,
            $email,
            $phone
        );

        echo "Contact créé avec succès\n";
    }

    // Supprime un contact
    // @param int $id Identifiant du contact à supprimer
    public function delete(int $id): void
    {
    // Vérifie que le contact existe avant de le supprimer
    $contact = $this->manager->findById($id);

    if ($contact === null) {
        echo "Contact non trouvé\n";
        return;
    }

    // Suppression du contact
    $this->manager->delete($id);

    echo "Contact supprimé avec succès\n";
    }

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