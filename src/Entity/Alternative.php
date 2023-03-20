<?php

namespace App\Entity;

use App\Repository\AlternativeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlternativeRepository::class)]
class Alternative
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $texte = null;

    #[ORM\ManyToOne(inversedBy: 'Alternatives')]
    private ?Etape $etapePrecedente = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etape $etapeSuivante = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getEtapePrecedente(): ?Etape
    {
        return $this->etapePrecedente;
    }

    public function setEtapePrecedente(?Etape $etapePrecedente): self
    {
        $this->etapePrecedente = $etapePrecedente;

        return $this;
    }

    public function getEtapeSuivante(): ?Etape
    {
        return $this->etapeSuivante;
    }

    public function setEtapeSuivante(?Etape $etapeSuivante): self
    {
        $this->etapeSuivante = $etapeSuivante;

        return $this;
    }
}
