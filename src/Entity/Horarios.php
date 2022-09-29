<?php

namespace App\Entity;

use App\Repository\HorariosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorariosRepository::class)
 */
class Horarios
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dia;

    /**
     * @ORM\Column(type="time")
     */
    private $apertura;

    /**
     * @ORM\Column(type="time")
     */
    private $cierre;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurantes::class, inversedBy="horarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurantes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDia(): ?int
    {
        return $this->dia;
    }

    public function setDia(int $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getApertura(): ?\DateTimeInterface
    {
        return $this->apertura;
    }

    public function setApertura(\DateTimeInterface $apertura): self
    {
        $this->apertura = $apertura;

        return $this;
    }

    public function getCierre(): ?\DateTimeInterface
    {
        return $this->cierre;
    }

    public function setCierre(\DateTimeInterface $cierre): self
    {
        $this->cierre = $cierre;

        return $this;
    }

    public function getRestaurantes(): ?Restaurantes
    {
        return $this->restaurantes;
    }

    public function setRestaurantes(?Restaurantes $restaurantes): self
    {
        $this->restaurantes = $restaurantes;

        return $this;
    }
}
