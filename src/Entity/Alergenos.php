<?php

namespace App\Entity;

use App\Repository\AlergenosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlergenosRepository::class)
 */
class Alergenos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alergeno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlergeno(): ?string
    {
        return $this->alergeno;
    }

    public function setAlergeno(string $alergeno): self
    {
        $this->alergeno = $alergeno;

        return $this;
    }
}
