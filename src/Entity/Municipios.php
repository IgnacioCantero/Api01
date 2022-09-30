<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MunicipiosRepository;

/**
 * Municipios
 *
 * @ORM\Table(name="municipios", indexes={@ORM\Index(name="IDX_BBFAB58653AF4E34", columns={"id_provincia"})})
 * @ORM\Entity(repositoryClass=MunicipiosRepository::class)
 */
class Municipios
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="municipio", type="string", length=255, nullable=true)
     */
    private $municipio;

    /**
     * @var \Provincias
     *
     * @ORM\ManyToOne(targetEntity="Provincias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_provincia", referencedColumnName="id")
     * })
     */
    private $idProvincia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMunicipio(): ?string
    {
        return $this->municipio;
    }

    public function setMunicipio(?string $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    public function getIdProvincia(): ?Provincias
    {
        return $this->idProvincia;
    }

    public function setIdProvincia(?Provincias $idProvincia): self
    {
        $this->idProvincia = $idProvincia;

        return $this;
    }


}
