<?php

namespace App\Entity;

use App\Repository\CantidadesPlatosPedidosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CantidadesPlatosPedidosRepository::class)
 */
class CantidadesPlatosPedidos
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
    private $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity=Platos::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $plato;

    /**
     * @ORM\ManyToOne(targetEntity=Pedidos::class, inversedBy="cantidadesPlatosPedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pedido;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPlato(): ?Platos
    {
        return $this->plato;
    }

    public function setPlato(?Platos $plato): self
    {
        $this->plato = $plato;

        return $this;
    }

    public function getPedido(): ?Pedidos
    {
        return $this->pedido;
    }

    public function setPedido(?Pedidos $pedido): self
    {
        $this->pedido = $pedido;

        return $this;
    }
}
