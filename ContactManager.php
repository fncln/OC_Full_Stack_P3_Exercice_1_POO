<?php

require_once __DIR__ . '/DBConnect.php';
require_once __DIR__ . '/Contact.php';

// Classe ContactManager
// Gère les requêtes et la persistance des données pour l'entité Contact
class ContactManager
{
    private PDO $db;

    // Le constructeur récupère la connexion PDO via le Singleton DBConnect
    public function __construct()
    {
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Récupère un contact à partir de son identifiant
     *
     * @param int $id L'identifiant du contact recherché
     * @return Contact|null Le contact trouvé ou null si aucun contact n'existe
     */
    public function findById(int $id): ?Contact
    {
        $query = $this->db->prepare(
            "SELECT * FROM contacts WHERE id = :id"
        );

        $query->execute([
            'id' => $id,
        ]);

        // Hydratation : fetchObject() transforme directement la ligne SQL en objet Contact
        // PDO associe chaque nom de colonne (id, name, email, phone_number)
        // à la propriété du même nom dans la classe Contact
        // (Contact::class donne le nom de la classe, ici "Contact")
        // Il renvoie false si aucune ligne n'a été trouvée
        $contact = $query->fetchObject(Contact::class);

        if ($contact === false) {
            return null;
        }

        return $contact;
    }

    /**
     * Récupère tous les contacts
     *
     * @return Contact[] Un tableau d'objets Contact
     */
    public function findAll(): array
    {
        // Requête préparée pour récupérer tous les enregistrements de la table contacts
        $query = $this->db->prepare("SELECT * FROM contacts");
        $query->execute();

        // Hydratation : fetchAll() avec PDO::FETCH_CLASS renvoie directement
        // un tableau d'objets Contact (un par ligne SQL)
        return $query->fetchAll(PDO::FETCH_CLASS, Contact::class);
    }

    /**
     * Crée un nouveau contact dans la base de données
     *
     * @param string $name        Nom du contact
     * @param string $email       Adresse email du contact
     * @param string $phoneNumber Numéro de téléphone du contact
     */
    public function create(string $name, string $email, string $phoneNumber): void
    {
        $query = $this->db->prepare(
            "INSERT INTO contacts (name, email, phone_number)
            VALUES (:name, :email, :phone_number)"
        );

        $query->execute([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phoneNumber,
        ]);
    }

    /**
     * Supprime un contact à partir de son identifiant
     *
     * @param int $id Identifiant du contact à supprimer
     */
    public function delete(int $id): void
    {
        $query = $this->db->prepare(
            "DELETE FROM contacts WHERE id = :id"
        );

        $query->execute([
            'id' => $id,
        ]);
    }
}