<?php

class Contact // représente un contact individuel/définit l'accès aux infos/comment les modifier
{
    private $id;
    private $name;
    private $email;
    private $phone_number;

    public function setId(?int $newId) : void
    {
        $this->id = $newId;
    }

    public function setName(?string $newName) : void
    {
        $this->name = $newName;
    }

    public function setEmail(?string $newEmail) : void
    {
        $this->email = $newEmail;
    }

    public function setPhone(?string $newPhone) : void
    {
        $this->phone_number = $newPhone;
    }

    public function getId () : ?int
    {
        return $this->id;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function getPhone() : ?string //note: le ? autorise le renvoi de 'null'
    {
        return $this->phone_number;
    }   

    public function toString() : string //note: ici le null est impossible dc ? inutile
    {
        return $this->getName() . " - " . $this->getEmail() . " - " . $this->getPhone();
    }
}
