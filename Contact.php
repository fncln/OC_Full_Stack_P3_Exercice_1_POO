<?php

// Classe Contact
// Entité représentant un contact du carnet d'adresses
class Contact
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    // Même nom que la colonne de la base de données (nécessaire pour l'hydratation avec PDO)
    private ?string $phone_number = null;

    // Récupère l'identifiant du contact
    public function getId(): ?int
    {
        return $this->id;
    }

    // Définit l'identifiant du contact
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    // Récupère le nom du contact
    public function getName(): ?string
    {
        return $this->name;
    }

    // Définit le nom du contact
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    // Récupère l'adresse email du contact
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Définit l'adresse email du contact
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    // Récupère le numéro de téléphone du contact
    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    // Définit le numéro de téléphone du contact
    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phone_number = $phoneNumber;

        return $this;
    }

    // Représentation textuelle de l'objet
    public function __toString(): string
    {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phone_number}";
    }
}