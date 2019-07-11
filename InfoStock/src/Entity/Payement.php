<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PayementRepository")
 */
class Payement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numcarte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateexpiration;

    /**
     * @ORM\Column(type="integer")
     */
    private $codesecurite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcarte(): ?int
    {
        return $this->numcarte;
    }

    public function setNumcarte(int $numcarte): self
    {
        $this->numcarte = $numcarte;

        return $this;
    }

    public function getDateexpiration(): ?\DateTimeInterface
    {
        return $this->dateexpiration;
    }

    public function setDateexpiration(\DateTimeInterface $dateexpiration): self
    {
        $this->dateexpiration = $dateexpiration;

        return $this;
    }

    public function getCodesecurite(): ?int
    {
        return $this->codesecurite;
    }

    public function setCodesecurite(int $codesecurite): self
    {
        $this->codesecurite = $codesecurite;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
}
