<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblProyectos
 *
 * @ORM\Table(name="tbl_proyectos", indexes={@ORM\Index(name="fk_municipio", columns={"fk_municipio"}), @ORM\Index(name="fk_cliente", columns={"fk_cliente"}), @ORM\Index(name="fk_departamento", columns={"fk_departamento"})})
 * @ORM\Entity
 */
class TblProyectos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_proyecto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProyecto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre_proyecto", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $nombreProyecto = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ubicacion_proyecto", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $ubicacionProyecto = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_creado", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fechaCreado = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="codigo", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $codigo = 'NULL';

    /**
     * @var \TblMunicipios
     *
     * @ORM\ManyToOne(targetEntity="TblMunicipios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_municipio", referencedColumnName="id_municipio")
     * })
     */
    private $fkMunicipio;

    /**
     * @var \TblEmpresa
     *
     * @ORM\ManyToOne(targetEntity="TblEmpresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_cliente", referencedColumnName="id_empresa")
     * })
     */
    private $fkCliente;

    /**
     * @var \TblDepartamentos
     *
     * @ORM\ManyToOne(targetEntity="TblDepartamentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_departamento", referencedColumnName="id_departamento")
     * })
     */
    private $fkDepartamento;

    public function getIdProyecto(): ?int
    {
        return $this->idProyecto;
    }

    public function getNombreProyecto(): ?string
    {
        return $this->nombreProyecto;
    }

    public function setNombreProyecto(?string $nombreProyecto): static
    {
        $this->nombreProyecto = $nombreProyecto;

        return $this;
    }

    public function getUbicacionProyecto(): ?string
    {
        return $this->ubicacionProyecto;
    }

    public function setUbicacionProyecto(?string $ubicacionProyecto): static
    {
        $this->ubicacionProyecto = $ubicacionProyecto;

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

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getFkMunicipio(): ?TblMunicipios
    {
        return $this->fkMunicipio;
    }

    public function setFkMunicipio(?TblMunicipios $fkMunicipio): static
    {
        $this->fkMunicipio = $fkMunicipio;

        return $this;
    }

    public function getFkCliente(): ?TblEmpresa
    {
        return $this->fkCliente;
    }

    public function setFkCliente(?TblEmpresa $fkCliente): static
    {
        $this->fkCliente = $fkCliente;

        return $this;
    }

    public function getFkDepartamento(): ?TblDepartamentos
    {
        return $this->fkDepartamento;
    }

    public function setFkDepartamento(?TblDepartamentos $fkDepartamento): static
    {
        $this->fkDepartamento = $fkDepartamento;

        return $this;
    }


}
