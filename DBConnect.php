<?php

require_once __DIR__ . '/config.php';

// Classe DBConnect
// Gère la connexion unique (Singleton) à la base de données via PDO

class DBConnect
{
    // Instance unique de la classe
    private static ?DBConnect $instance = null;

    // Objet de connexion PDO
    private PDO $pdo;

    /**
     * Constructeur privé pour empêcher l'instanciation directe (Singleton)
     * Initialise la connexion PDO avec gestion des erreurs et fetch associatif par défaut
     */
    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER,
                DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            // Arrête le script et affiche un message clair en cas d'échec de connexion
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    /**
     * Récupère l'instance unique de la classe (la crée si elle n'existe pas encore)
     *
     * @return DBConnect L'instance unique de DBConnect
     */
    public static function getInstance(): DBConnect
    {
        if (self::$instance === null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }

    /**
     * Retourne l'objet PDO pour exécuter des requêtes
     *
     * @return PDO L'objet de connexion PDO
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}