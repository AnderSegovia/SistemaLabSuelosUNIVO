<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblEquipo
 *
 * @ORM\Table(name="tbl_equipo", indexes={@ORM\Index(name="fk_tecnico_recibe", columns={"fk_tecnico_recibe"}), @ORM\Index(name="fk_proyecto_equipo", columns={"fk_proyecto_equipo"}), @ORM\Index(name="fk_tecnico_entrega", columns={"fk_tecnico_entrega"})})
 * @ORM\Entity
 */
class TblEquipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_equipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEquipo;

    /**
     * @var string
     *
     * @ORM\Column(name="atencion", type="string", length=150, nullable=false)
     */
    private $atencion;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=60, nullable=false)
     */
    private $cargo;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_elaboracion", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fechaElaboracion = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=10, nullable=false)
     */
    private $contacto;

    /**
     * @var int
     *
     * @ORM\Column(name="dias_alquiler", type="integer", nullable=false)
     */
    private $diasAlquiler;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="datetime", nullable=false)
     */
    private $fechaSalida;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_recepcion", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fechaRecepcion = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $observaciones = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $estado = 'NULL';

    /**
     * @var \TblUsuario
     *
     * @ORM\ManyToOne(targetEntity="TblUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_tecnico_entrega", referencedColumnName="codigo_usuario")
     * })
     */
    private $fkTecnicoEntrega;

    /**
     * @var \TblUsuario
     *
     * @ORM\ManyToOne(targetEntity="TblUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_tecnico_recibe", referencedColumnName="codigo_usuario")
     * })
     */
    private $fkTecnicoRecibe;

    /**
     * @var \TblProyectos
     *
     * @ORM\ManyToOne(targetEntity="TblProyectos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_proyecto_equipo", referencedColumnName="id_proyecto")
     * })
     */
    private $fkProyectoEquipo;

    public function getIdEquipo(): ?int
    {
        return $this->idEquipo;
    }

    public function getAtencion(): ?string
    {
        return $this->atencion;
    }

    public function setAtencion(string $atencion): static
    {
        $this->atencion = $atencion;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): static
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getFechaElaboracion(): ?\DateTimeInterface
    {
        return $this->fechaElaboracion;
    }

    public function setFechaElaboracion(?\DateTimeInterface $fechaElaboracion): static
    {
        $this->fechaElaboracion = $fechaElaboracion;

        return $this;
    }

    public function getContacto(): ?string
    {
        return $this->contacto;
    }

    public function setContacto(string $contacto): static
    {
        $this->contacto = $contacto;

        return $this;
    }

    public function getDiasAlquiler(): ?int
    {
        return $this->diasAlquiler;
    }

    public function setDiasAlquiler(int $diasAlquiler): static
    {
        $this->diasAlquiler = $diasAlquiler;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fechaSalida;
    }

    public function setFechaSalida(\DateTimeInterface $fechaSalida): static
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    public function getFechaRecepcion(): ?\DateTimeInterface
    {
        return $this->fechaRecepcion;
    }

    public function setFechaRecepcion(?\DateTimeInterface $fechaRecepcion): static
    {
        $this->fechaRecepcion = $fechaRecepcion;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): static
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFkTecnicoEntrega(): ?TblUsuario
    {
        return $this->fkTecnicoEntrega;
    }

    public function setFkTecnicoEntrega(?TblUsuario $fkTecnicoEntrega): static
    {
        $this->fkTecnicoEntrega = $fkTecnicoEntrega;

        return $this;
    }

    public function getFkTecnicoRecibe(): ?TblUsuario
    {
        return $this->fkTecnicoRecibe;
    }

    public function setFkTecnicoRecibe(?TblUsuario $fkTecnicoRecibe): static
    {
        $this->fkTecnicoRecibe = $fkTecnicoRecibe;

        return $this;
    }

    public function getFkProyectoEquipo(): ?TblProyectos
    {
        return $this->fkProyectoEquipo;
    }

    public function setFkProyectoEquipo(?TblProyectos $fkProyectoEquipo): static
    {
        $this->fkProyectoEquipo = $fkProyectoEquipo;

        return $this;
    }


}
