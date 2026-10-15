<?php

//Classe Contact
// Entité représentant un contact du carnet d'adresses
class Contact
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $phone;

    // Constructeur de l'entité Contact
    public function __construct(?int $id = null, ?string $name = null, ?string $email = null, ?string $phone = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    // Récupère l'identifiant du contact
    public function getId(): ?int
    {
        return $this->id;
    }

    // Récupère le nom du contact
    public function getName(): ?string
    {
        return $this->name;
    }


    // Récupère l'adresse email du contact
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Récupère le numéro de téléphone du contact
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    // Représentation textuelle de l'objet (pour le debug ou l'affichage rapide)
    public function __toString(): string
    {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phone}";
    }
}