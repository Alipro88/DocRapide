<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Reservation
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
    private $start_from;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_to;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ad", inversedBy="reservations", cascade={"persist", "remove"})
     */
    private $ad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="reservations", fetch="EAGER")
     */
    private $patient;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $online;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $join_url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $confirmed;

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartFrom(): ?\DateTimeInterface
    {
        return $this->start_from;
    }

    public function setStartFrom(?\DateTimeInterface $start_from): self
    {
        $this->start_from = $start_from;

        return $this;
    }

    public function getEndTo(): ?\DateTimeInterface
    {
        return $this->end_to;
    }

    public function setEndTo(?\DateTimeInterface $end_to): self
    {
        $this->end_to = $end_to;

        return $this;
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

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(?Ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(?bool $online): self
    {
        $this->online = $online;

        return $this;
    }

    public function getJoinUrl(): ?string
    {
        return $this->join_url;
    }

    public function setJoinUrl(?string $join_url): self
    {
        $this->join_url = $join_url;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(?bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    
}