<?php

require_once __DIR__ . '/ContactManager.php';

// Classe Command
// Contient la logique des commandes de l'application
class Command
{
    // Message affiché quand aucun contact ne correspond à l'identifiant demandé
    private const CONTACT_NOT_FOUND = "\nContact non trouvé\n\n";

    private ContactManager $contactManager;

    // Initialise le gestionnaire de contacts
    public function __construct()
    {
        $this->contactManager = new ContactManager();
    }

    // Affiche l'aide de l'application
    public function help(): void
    {
        echo "\nhelp : affiche cette aide\n";
        echo "list : liste les contacts\n";
        echo "detail [id] : affiche un contact\n";
        echo "create [name], [email], [phone] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "exit : quitte le programme\n";
        echo "\n";
        echo "Attention à la syntaxe des commandes. Les espaces et les virgules sont à respecter.\n\n";
    }

    /**
     * Affiche le détail d'un contact
     *
     * @param int $id Identifiant du contact à afficher
     */
    public function detail(int $id): void
    {
        $contact = $this->contactManager->findById($id);

        if ($contact === null) {
            echo self::CONTACT_NOT_FOUND;
            return;
        }

        echo "\n" . $contact . "\n\n";
    }

    /**
     * Crée un nouveau contact
     *
     * @param string $name        Nom du contact
     * @param string $email       Email du contact
     * @param string $phoneNumber Numéro de téléphone du contact
     */
    public function create(string $name, string $email, string $phoneNumber): void
    {
        $this->contactManager->create($name, $email, $phoneNumber);

        echo "\nContact créé avec succès\n\n";
    }

    /**
     * Supprime un contact
     *
     * @param int $id Identifiant du contact à supprimer
     */
    public function delete(int $id): void
    {
        // Vérifie que le contact existe avant de le supprimer
        $contact = $this->contactManager->findById($id);

        if ($contact === null) {
            echo self::CONTACT_NOT_FOUND;
            return;
        }

        // Suppression du contact
        $this->contactManager->delete($id);

        echo "\nContact supprimé avec succès\n\n";
    }

    // Commande list : affiche tous les contacts
    public function list(): void
    {
        $contacts = $this->contactManager->findAll();

        if (empty($contacts)) {
            echo "\nAucun contact trouvé dans le carnet d'adresses.\n\n";
            return;
        }

        echo "\n--- Liste des contacts ---\n";

        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }

        echo "\n";
    }
}