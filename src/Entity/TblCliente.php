<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblCliente
 *
 * @ORM\Table(name="tbl_cliente")
 * @ORM\Entity
 */
class TblCliente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_cliente", type="string", length=60, nullable=false)
     */
    private $nombreCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_cliente", type="string", length=60, nullable=false)
     */
    private $correoCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="municipio_cliente", type="string", length=40, nullable=false)
     */
    private $municipioCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento_cliente", type="string", length=50, nullable=false)
     */
    private $departamentoCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="dui_cliente", type="string", length=10, nullable=false)
     */
    private $duiCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_cliente", type="string", length=200, nullable=false)
     */
    private $direccionCliente;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono_cliente", type="integer", nullable=false)
     */
    private $telefonoCliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creado", type="datetime", nullable=false)
     */
    private $fechaCreado;

    public function getIdCliente(): ?int
    {
        return $this->idCliente;
    }

    public function getNombreCliente(): ?string
    {
        return $this->nombreCliente;
    }

    public function setNombreCliente(string $nombreCliente): static
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    public function getCorreoCliente(): ?string
    {
        return $this->correoCliente;
    }

    public function setCorreoCliente(string $correoCliente): static
    {
        $this->correoCliente = $correoCliente;

        return $this;
    }

    public function getMunicipioCliente(): ?string
    {
        return $this->municipioCliente;
    }

    public function setMunicipioCliente(string $municipioCliente): static
    {
        $this->municipioCliente = $municipioCliente;

        return $this;
    }

    public function getDepartamentoCliente(): ?string
    {
        return $this->departamentoCliente;
    }

    public function setDepartamentoCliente(string $departamentoCliente): static
    {
        $this->departamentoCliente = $departamentoCliente;

        return $this;
    }

    public function getDuiCliente(): ?string
    {
        return $this->duiCliente;
    }

    public function setDuiCliente(string $duiCliente): static
    {
        $this->duiCliente = $duiCliente;

        return $this;
    }

    public function getDireccionCliente(): ?string
    {
        return $this->direccionCliente;
    }

    public function setDireccionCliente(string $direccionCliente): static
    {
        $this->direccionCliente = $direccionCliente;

        return $this;
    }

    public function getTelefonoCliente(): ?int
    {
        return $this->telefonoCliente;
    }

    public function setTelefonoCliente(int $telefonoCliente): static
    {
        $this->telefonoCliente = $telefonoCliente;

        return $this;
    }

    public function getFechaCreado(): ?\DateTimeInterface
    {
        return $this->fechaCreado;
    }

    public function setFechaCreado(\DateTimeInterface $fechaCreado): static
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }


}
