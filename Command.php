<?php 

class Command
{
    public function list ($actualPdo) {
        $contactManager = new ContactManager;
        $contactManager->connexion = $actualPdo;
        $contactExp = $contactManager->findAll();
        foreach ($contactExp as $contact) {
            echo $contact->getId() . " - " .
            $contact->toString() . "\n";
        }
    }

    public function detail ($actualPdo, $id) {
        $contactManager = new ContactManager;
        $contactManager->connexion = $actualPdo;
        $contact = $contactManager->findbyId($id);

        if ($contact === null) {
            echo "Contact introuvable.\n";
            return;
        }

        echo $contact->getId() . " - " .
        $contact->toString() . "\n";
    }

    public function delete($actualPdo, $id) {
        $contactManager = new ContactManager;
        $contactManager->connexion = $actualPdo;
        $resultat = $contactManager->deleteById($id);

        if ($resultat === 1) {
            echo "Contact supprimé.\n";
        } else {
            echo "Contact introuvable.\n";
        }
    }

    public function create($actualPdo, $name, $email, $phone) {
        $contactManager = new ContactManager;
        $contactManager->connexion = $actualPdo;
        $resultat = $contactManager->create($name, $email, $phone);
        
        if ($resultat === 1) {
            echo "Contact enregistré.\n";
        } else {
            echo "Erreur.\n";
        }
    }

    public function help(): void 
    {
        echo "command list :\n
        list : make a list of all contacts\n
        detail [id] : shows details of the selected contact\n
        create [name], [email], [phone number] : create a new contact\n
        delete [id] : delete a contact\n
        quit : exit the program\n";
    }
}