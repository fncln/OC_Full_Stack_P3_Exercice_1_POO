<?php

// Point d'entrée principal de l'application en mode CLI.

// 1. Inclusion des dépendances du projet
require_once 'config.php';
require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';

// 2. Test de l'instance unique DBConnect
$dbInstance = DBConnect::getInstance();
echo "Test de l'instance DBConnect :\n";
var_dump($dbInstance);

// 3. Test de la récupération de l'objet PDO
$pdo = $dbInstance->getPDO();
echo "\nTest de l'objet PDO :\n";
var_dump($pdo);

// 4. Test du ContactManager et de la méthode findAll(
$contactManager = new ContactManager();
$contacts = $contactManager->findAll();
echo "--- Résultats de findAll() ---\n";
var_dump($contacts);

// 5. Boucle interactive du terminal (CLI)
while (true) {
    $line = readline("Entrez votre commande : ");

    if ($line === 'list') {
        echo "Affichage de la liste\n";
    } else {
        echo "Commande inconnue\n";
    }
}