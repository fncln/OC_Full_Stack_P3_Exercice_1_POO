<?php

// Point d'entrée principal de l'application en mode CLI.

// 1. Inclusion de la classe Command
require_once __DIR__ . '/Command.php';

// 2. Message d'accueil et liste des commandes disponibles
echo "=== Bienvenue dans votre carnet d'adresses ===\n";
echo "Commandes disponibles :\n";
echo "- help\n";
echo "- list\n";
echo "- detail [id]\n";
echo "- create [nom], [email], [telephone]\n";
echo "- delete [id]\n";
echo "- exit\n\n";

// 3. Boucle interactive du terminal (CLI)
// Légende des expressions régulières (preg_match) utilisées plus bas :
//     ^            début de la saisie
//     $            fin de la saisie
//     [0-9]{1,3}   entre 1 et 3 chiffres (donc un identifiant valide)
//     .+           un ou plusieurs caractères quelconques (donc un champ non vide)
//     ( )          parenthèses : la valeur trouvée est conservée dans $matches
//     ($matches[0] = saisie complète, $matches[1] = 1er groupe, etc.)
$command = new Command();

// Motif d'un identifiant, partagé par "detail" et "delete" (évite de le répéter)
$idPattern = '([0-9]{1,3})';

while (true) {
    // Lecture de la commande saisie par l'utilisateur
    $line = readline("Entrez votre commande (help, list, detail, create, delete, exit) : ");

    // Supprime les espaces parasites avant/après la commande
    $line = trim($line);

    // Commande "help" : affiche l'aide
    if ($line === 'help') {
        $command->help();
        continue;
    }

    // Commande "list" : affiche tous les contacts
    if ($line === 'list') {
        $command->list();
        continue;
    }

    // Commande "detail [id]" : exemple "detail 2"
    // Le motif attend le mot "detail", un espace, puis un identifiant ($idPattern)
    // $matches[1] contient l'identifiant, converti en entier avec (int)
    if (preg_match('/^detail ' . $idPattern . '$/', $line, $matches)) {
        $command->detail((int) $matches[1]);
        continue;
    }

    // Commande "create [nom], [email], [telephone]" : exemple "create Frodo, frodo@shire.com, 0102030405"
    // Le motif attend le mot "create", un espace, puis trois champs non vides séparés par ", "
    // $matches[1] = nom, $matches[2] = email, $matches[3] = téléphone
    if (preg_match('/^create (.+), (.+), (.+)$/', $line, $matches)) {
        $command->create(
            trim($matches[1]),
            trim($matches[2]),
            trim($matches[3])
        );
        continue;
    }

    // Commande "delete [id]" : exemple "delete 2"
    // Même principe que "detail" : le mot "delete", un espace, puis un identifiant ($idPattern)
    if (preg_match('/^delete ' . $idPattern . '$/', $line, $matches)) {
        $command->delete((int) $matches[1]);
        continue;
    }

    // Commande "exit" : quitte le programme
    if ($line === 'exit') {
        echo "\nAu revoir !\n";
        break;
    }

    // Aucune commande ne correspond (commande inconnue)
    echo "\nCommande inconnue. Tapez help pour afficher l'aide.\n\n";
}