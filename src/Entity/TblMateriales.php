<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblMateriales
 *
 * @ORM\Table(name="tbl_materiales", indexes={@ORM\Index(name="fk_tecnico", columns={"fk_tecnico"}), @ORM\Index(name="fk_proyecto", columns={"fk_proyecto"})})
 * @ORM\Entity
 */
class TblMateriales
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_material", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMaterial;

    /**
     * @var string
     *
     * @ORM\Column(name="atencion", type="string", length=50, nullable=false)
     */
    private $atencion;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=120, nullable=false)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=9, nullable=false)
     */
    private $contacto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creado", type="datetime", nullable=false)
     */
    private $fechaCreado;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=false)
     */
    private $observaciones;

    /**
     * @var \TblProyectos
     *
     * @ORM\ManyToOne(targetEntity="TblProyectos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_proyecto", referencedColumnName="id_proyecto")
     * })
     */
    private $fkProyecto;

    /**
     * @var \TblUsuario
     *
     * @ORM\ManyToOne(targetEntity="TblUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_tecnico", referencedColumnName="codigo_usuario")
     * })
     */
    private $fkTecnico;

    public function getIdMaterial(): ?int
    {
        return $this->idMaterial;
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

    public function getContacto(): ?string
    {
        return $this->contacto;
    }

    public function setContacto(string $contacto): static
    {
        $this->contacto = $contacto;

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

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): static
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getFkProyecto(): ?TblProyectos
    {
        return $this->fkProyecto;
    }

    public function setFkProyecto(?TblProyectos $fkProyecto): static
    {
        $this->fkProyecto = $fkProyecto;

        return $this;
    }

    public function getFkTecnico(): ?TblUsuario
    {
        return $this->fkTecnico;
    }

    public function setFkTecnico(?TblUsuario $fkTecnico): static
    {
        $this->fkTecnico = $fkTecnico;

        return $this;
    }


}
