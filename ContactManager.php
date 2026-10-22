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

        $data = $query->fetch();

        if ($data === false) {
            return null;
        }

        // Hydratation : transformation du résultat SQL en objet Contact
        $contact = new Contact();

        $contact
            ->setId($data['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPhone($data['phone_number']);

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
        $results = $query->fetchAll();

        $contacts = [];

        // Hydratation : transformation de chaque ligne de résultat en instance de l'entité Contact
        foreach ($results as $data) {
            $contact = new Contact();

            $contact
                ->setId($data['id'])
                ->setName($data['name'])
                ->setEmail($data['email'])
                ->setPhone($data['phone_number']);

            $contacts[] = $contact;
        }

        return $contacts;
    }

    /**
     * Crée un nouveau contact dans la base de données
     *
     * @param string $name  Nom du contact
     * @param string $email Adresse email du contact
     * @param string $phone Numéro de téléphone du contact
     */
    public function create(string $name, string $email, string $phone): void
    {
        $query = $this->db->prepare(
            "INSERT INTO contacts (name, email, phone_number)
            VALUES (:name, :email, :phone)"
        );

        $query->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
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