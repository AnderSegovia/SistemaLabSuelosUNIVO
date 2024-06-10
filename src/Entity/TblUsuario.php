<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblUsuario
 *
 * @ORM\Table(name="tbl_usuario", indexes={@ORM\Index(name="fk_rol", columns={"fk_rol"})})
 * @ORM\Entity
 */
class TblUsuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario", type="string", length=30, nullable=false)
     * @ORM\Id
     */
    private $codigoUsuario;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre_usuario", type="string", length=60, nullable=true, options={"default"="'NULL'"})
     */
    private $nombreUsuario = '\'NULL\'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_dui", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $numeroDui = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="edad", type="string", length=2, nullable=true, options={"default"="NULL"})
     */
    private $edad = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefono", type="string", length=9, nullable=true, options={"default"="NULL"})
     */
    private $telefono = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_creado", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fechaCreado = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="contra_usuario", type="string", length=25, nullable=true, options={"default"="NULL"})
     */
    private $contraUsuario = 'NULL';

    /**
     * @var \TblRol
     *
     * @ORM\ManyToOne(targetEntity="TblRol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_rol", referencedColumnName="id_rol")
     * })
     */
    private $fkRol;

    public function getCodigoUsuario(): ?string
    {
        return $this->codigoUsuario;
    }
    public function setCodigoUsuario(?string $codigoUsuario): static
    {
        $this->codigoUsuario = $codigoUsuario;

        return $this;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(?string $nombreUsuario): static
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getNumeroDui(): ?string
    {
        return $this->numeroDui;
    }

    public function setNumeroDui(?string $numeroDui): static
    {
        $this->numeroDui = $numeroDui;

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->edad;
    }

    public function setEdad(?string $edad): static
    {
        $this->edad = $edad;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getFechaCreado(): ?\DateTimeInterface
    {
        return $this->fechaCreado;
    }

    public function setFechaCreado(?\DateTimeInterface $fechaCreado): static
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    public function getContraUsuario(): ?string
    {
        return $this->contraUsuario;
    }

    public function setContraUsuario(?string $contraUsuario): static
    {
        $this->contraUsuario = $contraUsuario;

        return $this;
    }

    public function getFkRol(): ?TblRol
    {
        return $this->fkRol;
    }

    public function setFkRol(?TblRol $fkRol): static
    {
        $this->fkRol = $fkRol;

        return $this;
    }


}
