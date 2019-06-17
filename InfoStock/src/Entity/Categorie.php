<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255 , unique = true)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Souscategory", 
     * mappedBy="category", orphanRemoval=true)
     */
    private $souscategories;

    public function __construct()
    {
        $this->souscategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * @return Collection|Souscategory[]
     */
    public function getSouscategories(): Collection
    {
        return $this->souscategories;
    }

    public function addSouscategory(Souscategory $souscategory): self
    {
        if (!$this->souscategories->contains($souscategory)) {
            $this->souscategories[] = $souscategory;
            $souscategory->setCategory($this);
        }

        return $this;
    }

    public function removeSouscategory(Souscategory $souscategory): self
    {
        if ($this->souscategories->contains($souscategory)) {
            $this->souscategories->removeElement($souscategory);
            // set the owning side to null (unless already changed)
            if ($souscategory->getCategory() === $this) {
                $souscategory->setCategory(null);
            }
        }

        return $this;
    }
}
