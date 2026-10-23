<?php

class ContactManager // s'occupe de récupérer les contacts depuis MySQL
{
    public $connexion;
    public function findAll()
    {
        $mysqlQuery = $this->connexion->query('SELECT * FROM contact');
        $contacts = $mysqlQuery->fetchAll();

        $contactObjects = [];

        foreach ($contacts as $contact) {
            $newContact = new Contact();
            $newContact->setId($contact['id']);
            $newContact->setName($contact['name']);
            $newContact->setEmail($contact['email']);
            $newContact->setPhone($contact['phone_number']);
            $contactObjects[] = $newContact;        
        }
        return $contactObjects;
    }

    public function findById($id)
    {
        $mysqlQuery = $this->connexion->prepare('SELECT * FROM contact WHERE id=:id');
        $mysqlQuery->execute(['id' => $id]);
        $contact = $mysqlQuery->fetch(PDO::FETCH_ASSOC);

        if ($contact === false) {
            return null;
        }

        $newContact = new Contact();
        $newContact->setId($contact['id']);
        $newContact->setName($contact['name']);
        $newContact->setEmail($contact['email']);
        $newContact->setPhone($contact['phone_number']);

        return $newContact;
    }

    public function deleteById($id)
    {
        $mysqlQuery = $this->connexion->prepare('DELETE FROM contact WHERE id = :id'); //rqt suppression
        $mysqlQuery->execute(['id' => $id]);
        return $mysqlQuery->rowCount(); // renvoie le nb de lignes suppr (1 si contact existait, 0 sinon)
    }

    public function create($name, $email, $phone)
    {
        $mysqlQuery = $this->connexion->prepare('INSERT INTO contact (name, email, phone_number) 
        VALUES (:name, :email, :phone_number)');
        $mysqlQuery->execute([
        'name' => $name,
        'email' => $email,
        'phone_number' => $phone,
        ]);
        return $mysqlQuery->rowCount();
    }
}