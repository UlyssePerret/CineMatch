<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lien_film;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $genre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $directeurs;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $restriction;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Seance", mappedBy="film")
     */
    private $seance;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fresh;

    public function __construct()
    {
        $this->seance = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(?\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }
    
    public function getLienFilm(): ?string
    {
        return $this->lien_film;
    }

    public function setLienFilm(string $lien_film): self
    {
        $this->lien_film = $lien_film;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDirecteurs(): ?string
    {
        return $this->directeurs;
    }

    public function setDirecteurs(?string $directeurs): self
    {
        $this->directeurs = $directeurs;

        return $this;
    }

    public function getRestriction(): ?string
    {
        return $this->restriction;
    }

    public function setRestriction(?string $restriction): self
    {
        $this->restriction = $restriction;

        return $this;
    }

    /**
     * @return Collection|Seance[]
     */
    public function getSeance(): Collection
    {
        return $this->seance;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seance->contains($seance)) {
            $this->seance[] = $seance;
            $seance->setFilm($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seance->contains($seance)) {
            $this->seance->removeElement($seance);
            // set the owning side to null (unless already changed)
            if ($seance->getFilm() === $this) {
                $seance->setFilm(null);
            }
        }

        return $this;
    }

    public function getFresh(): ?bool
    {
        return $this->fresh;
    }

    public function setFresh(bool $fresh): self
    {
        $this->fresh = $fresh;

        return $this;
    }


}
