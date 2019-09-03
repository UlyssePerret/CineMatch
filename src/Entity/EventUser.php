<?php

namespace App\Entity;
use App\Repository\EventUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventUserRepository")
 */
class EventUser
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
    private $seance_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $cinema;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**+
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info_comp;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $user_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeanceId(): ?int
    {
        return $this->seance_id;
    }

    public function setSeanceId(int $seance_id): self
    {
        $this->seance_id = $seance_id;

        return $this;
    }

    public function getCinema(): ?string
    {
        return $this->cinema;
    }

    public function setCinema(string $cinema): self
    {
        $this->cinema = $cinema;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getInfoComp(): ?string
    {
        return $this->info_comp;
    }

    public function setInfoComp(?string $info_comp): self
    {
        $this->info_comp = $info_comp;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(user $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
        }

        return $this;
    }

    public function removeUserId(user $userId): self
    {
        if ($this->user_id->contains($userId)) {
            $this->user_id->removeElement($userId);
        }

        return $this;
    }


}
