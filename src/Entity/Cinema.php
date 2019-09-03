<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CinemaRepository")
 */
class Cinema
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $code_cinema;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $chaine_cinema;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom_cinema;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCinema(): ?string
    {
        return $this->code_cinema;
    }

    public function setCodeCinema(?string $code_cinema): self
    {
        $this->code_cinema = $code_cinema;

        return $this;
    }

    public function getChaineCinema(): ?string
    {
        return $this->chaine_cinema;
    }

    public function setChaineCinema(?string $chaine_cinema): self
    {
        $this->chaine_cinema = $chaine_cinema;

        return $this;
    }

    public function getNomCinema(): ?string
    {
        return $this->nom_cinema;
    }

    public function setNomCinema(string $nom_cinema): self
    {
        $this->nom_cinema = $nom_cinema;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
