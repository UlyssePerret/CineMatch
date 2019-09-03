<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventTestRepository")
 */
class EventTest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $film;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nbparticipant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $organisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFilm(): ?string
    {
        return $this->film;
    }

    public function setFilm(string $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getNbparticipant(): ?string
    {
        return $this->nbparticipant;
    }

    public function setNbparticipant(?string $nbparticipant): self
    {
        $this->nbparticipant = $nbparticipant;

        return $this;
    }

    public function getOrganisateur(): ?string
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?string $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }


}
