<?php

require_once __DIR__ . '/DBConnect.php';
require_once __DIR__ . '/Contact.php';
require_once __DIR__ . '/ContactManager.php';
require_once __DIR__ . '/Command.php';


$dbConnect = new DBConnect; //création objet issu de classe
$actualPdo = $dbConnect->getNewPDO(); // "dans l'objet $dbConnect, exécute getNewPDO() et stocke 
// ce qu'elle renvoie dans $actualPdo"


$contactManager = new ContactManager; //création instance 
$contactManager->connexion = $actualPdo; //"pour cet objet, 'connexion' vaut $actualPdo"
$contactExp = $contactManager->findAll();


while (true) {
    $line = readline("Entrez votre commande (list, detail, create, delete, help, quit) : ");
    echo "Vous avez saisi : $line\n";

        if ($line === 'list') {
            $instruction = new Command;
            $instruction->list($actualPdo);
        }

        elseif (preg_match('/^detail ([0-9]+)$/', $line, $matches)) { //ce qu'on cherche, le texte dans lequel on cherche, le tableau dans lequel on enregistre ce qu'on a trouvé
            $instruction = new Command;
            $instruction->detail($actualPdo, (int) $matches[1]); //$matches : tableau rempli par preg_match
        }

        elseif (preg_match('/^delete ([0-9]+)$/', $line, $matches)) {
            $instruction = new Command;
            $instruction->delete($actualPdo, (int) $matches[1]);
        }

        elseif (preg_match('/^create ([^,]+), ([^,]+), (.+)$/', $line, $matches)) {
            $instruction = new Command;
            $instruction->create($actualPdo, $matches[1], $matches[2], $matches[3]);
        }

        elseif ($line === 'help') {
            $instruction = new Command;
            $instruction->help();
        }

        elseif ($line === 'quit') {
            echo "À bientôt !\n";
            exit;
        }

        else {
            echo "Commande inconnue ou mal rédigée.\n";
        }
}
