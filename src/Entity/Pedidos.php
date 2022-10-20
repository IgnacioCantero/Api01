<?php

namespace App\Entity;

use App\Repository\PedidosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidosRepository::class)
 */
class Pedidos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaEntrega;

    /**
     * @ORM\ManyToOne(targetEntity=Clientes::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clientes;

    /**
     * @ORM\OneToOne(targetEntity=Direcciones::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $direccion;

    /**
     * @ORM\OneToOne(targetEntity=Estados::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurantes::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurante;

    /**
     * @ORM\OneToMany(targetEntity=CantidadesPlatosPedidos::class, mappedBy="pedido", orphanRemoval=true)
     */
    private $cantidadesPlatosPedidos;

    public function __construct()
    {
        $this->cantidadesPlatosPedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    public function getClientes(): ?Clientes
    {
        return $this->clientes;
    }

    public function setClientes(?Clientes $clientes): self
    {
        $this->clientes = $clientes;

        return $this;
    }

    public function getDireccion(): ?Direcciones
    {
        return $this->direccion;
    }

    public function setDireccion(Direcciones $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getEstado(): ?Estados
    {
        return $this->estado;
    }

    public function setEstado(Estados $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getRestaurante(): ?Restaurantes
    {
        return $this->restaurante;
    }

    public function setRestaurante(?Restaurantes $restaurante): self
    {
        $this->restaurante = $restaurante;

        return $this;
    }

    /**
     * @return Collection<int, CantidadesPlatosPedidos>
     */
    public function getCantidadesPlatosPedidos(): Collection
    {
        return $this->cantidadesPlatosPedidos;
    }

    public function addCantidadesPlatosPedido(CantidadesPlatosPedidos $cantidadesPlatosPedido): self
    {
        if (!$this->cantidadesPlatosPedidos->contains($cantidadesPlatosPedido)) {
            $this->cantidadesPlatosPedidos[] = $cantidadesPlatosPedido;
            $cantidadesPlatosPedido->setPedido($this);
        }

        return $this;
    }

    public function removeCantidadesPlatosPedido(CantidadesPlatosPedidos $cantidadesPlatosPedido): self
    {
        if ($this->cantidadesPlatosPedidos->removeElement($cantidadesPlatosPedido)) {
            // set the owning side to null (unless already changed)
            if ($cantidadesPlatosPedido->getPedido() === $this) {
                $cantidadesPlatosPedido->setPedido(null);
            }
        }

        return $this;
    }
}
