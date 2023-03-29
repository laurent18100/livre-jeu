<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $texte = null;

    #[ORM\OneToOne(mappedBy: 'premiereEtape', cascade: ['persist', 'remove'])]
    private ?Aventure $aventureDebutee = null;


    #[ORM\OneToMany(mappedBy: 'etapePrecedente', targetEntity: Alternative::class)]
    private Collection $Alternatives;

    #[ORM\OneToMany(mappedBy: 'etape', targetEntity: Partie::class)]
    private Collection $parties;

    #[ORM\ManyToOne(inversedBy: 'etapes')]
    private ?Aventure $aventure = null;

    #[ORM\ManyToOne(inversedBy: 'finsPossibles')]
    private ?Aventure $finAventure = null;

    public function __construct()
    {
        $this->Alternatives = new ArrayCollection();
        $this->parties = new ArrayCollection();
    }

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

    public function getAventureDebutee(): ?Aventure
    {
        return $this->aventureDebutee;
    }

    public function setAventureDebutee(?Aventure $aventureDebutee): self
    {
        // unset the owning side of the relation if necessary
        if ($aventureDebutee === null && $this->aventureDebutee !== null) {
            $this->aventureDebutee->setPremiereEtape(null);
        }

        // set the owning side of the relation if necessary
        if ($aventureDebutee !== null && $aventureDebutee->getPremiereEtape() !== $this) {
            $aventureDebutee->setPremiereEtape($this);
        }

        $this->aventureDebutee = $aventureDebutee;

        return $this;
    }

    /**
     * @return Collection<int, Alternative>
     */
    public function getAlternatives(): Collection
    {
        return $this->Alternatives;
    }

    public function addAlternative(Alternative $alternative): self
    {
        if (!$this->Alternatives->contains($alternative)) {
            $this->Alternatives->add($alternative);
            $alternative->setEtapePrecedente($this);
        }

        return $this;
    }

    public function removeAlternative(Alternative $alternative): self
    {
        if ($this->Alternatives->removeElement($alternative)) {
            // set the owning side to null (unless already changed)
            if ($alternative->getEtapePrecedente() === $this) {
                $alternative->setEtapePrecedente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Partie>
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties->add($party);
            $party->setEtape($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getEtape() === $this) {
                $party->setEtape(null);
            }
        }

        return $this;
    }

    public function getAventure(): ?Aventure
    {
        return $this->aventure;
    }

    public function setAventure(?Aventure $aventure): self
    {
        $this->aventure = $aventure;

        return $this;
    }

    public function getFinAventure(): ?Aventure
    {
        return $this->finAventure;
    }

    public function setFinAventure(?Aventure $finAventure): self
    {
        $this->finAventure = $finAventure;

        return $this;
    }

public function __toString()

{
    return $this-> texte;
}



}
