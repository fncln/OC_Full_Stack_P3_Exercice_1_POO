<?php

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

    /** Récupère tous les contacts et retourne un tableau d'objets Contact
    * @return Contact[] Un tableau d'objets Contact
    */
    public function findAll(): array
    {
        // Utilisation d'une requête préparée pour récupérer tous les enregistrements de la table contacts
        $query = $this->db->prepare("SELECT * FROM contacts");
        $query->execute();
        $results = $query->fetchAll();

        $contacts = [];
        
        // Hydratation : transformation de chaque ligne de résultat en instance de l'entité Contact
        foreach ($results as $data) {
            $contacts[] = new Contact(
                $data['id'],
                $data['name'],
                $data['email'],
                $data['phone_number']
            );
        }

        return $contacts;
    }
}