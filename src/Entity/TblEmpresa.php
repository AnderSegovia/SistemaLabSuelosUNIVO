<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblEmpresa
 *
 * @ORM\Table(name="tbl_empresa", indexes={@ORM\Index(name="fk_departamento_empresa", columns={"fk_departamento"}), @ORM\Index(name="fk_municipio_empresa", columns={"fk_municipio"})})
 * @ORM\Entity
 */
class TblEmpresa
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_empresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_empresa", type="string", length=255, nullable=false, options={"default"="'NULL'"})
     */
    private $nombreEmpresa = '\'NULL\'';

    /**
     * @var string
     *
     * @ORM\Column(name="correo_empresa", type="string", length=100, nullable=false)
     */
    private $correoEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(name="dui_depositante", type="string", length=10, nullable=false)
     */
    private $duiDepositante;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_empresa", type="string", length=255, nullable=false)
     */
    private $direccionEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_empresa", type="string", length=9, nullable=false)
     */
    private $telefonoEmpresa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="no_nit", type="string", length=25, nullable=true, options={"default"="NULL"})
     */
    private $noNit = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="giro_empresa", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $giroEmpresa = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="razon_social", type="string", length=200, nullable=true, options={"default"="NULL"})
     */
    private $razonSocial = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="no_registroNRC", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $noRegistronrc = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creado", type="datetime", nullable=false)
     */
    private $fechaCreado;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tipo_cliente", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $tipoCliente = NULL;

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
     * @var \TblDepartamentos
     *
     * @ORM\ManyToOne(targetEntity="TblDepartamentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_departamento", referencedColumnName="id_departamento")
     * })
     */
    private $fkDepartamento;

    public function getIdEmpresa(): ?int
    {
        return $this->idEmpresa;
    }

    public function getNombreEmpresa(): ?string
    {
        return $this->nombreEmpresa;
    }

    public function setNombreEmpresa(string $nombreEmpresa): static
    {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }

    public function getCorreoEmpresa(): ?string
    {
        return $this->correoEmpresa;
    }

    public function setCorreoEmpresa(string $correoEmpresa): static
    {
        $this->correoEmpresa = $correoEmpresa;

        return $this;
    }

    public function getDuiDepositante(): ?string
    {
        return $this->duiDepositante;
    }

    public function setDuiDepositante(string $duiDepositante): static
    {
        $this->duiDepositante = $duiDepositante;

        return $this;
    }

    public function getDireccionEmpresa(): ?string
    {
        return $this->direccionEmpresa;
    }

    public function setDireccionEmpresa(string $direccionEmpresa): static
    {
        $this->direccionEmpresa = $direccionEmpresa;

        return $this;
    }

    public function getTelefonoEmpresa(): ?string
    {
        return $this->telefonoEmpresa;
    }

    public function setTelefonoEmpresa(string $telefonoEmpresa): static
    {
        $this->telefonoEmpresa = $telefonoEmpresa;

        return $this;
    }

    public function getNoNit(): ?string
    {
        return $this->noNit;
    }

    public function setNoNit(?string $noNit): static
    {
        $this->noNit = $noNit;

        return $this;
    }

    public function getGiroEmpresa(): ?string
    {
        return $this->giroEmpresa;
    }

    public function setGiroEmpresa(?string $giroEmpresa): static
    {
        $this->giroEmpresa = $giroEmpresa;

        return $this;
    }

    public function getRazonSocial(): ?string
    {
        return $this->razonSocial;
    }

    public function setRazonSocial(?string $razonSocial): static
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    public function getNoRegistronrc(): ?string
    {
        return $this->noRegistronrc;
    }

    public function setNoRegistronrc(?string $noRegistronrc): static
    {
        $this->noRegistronrc = $noRegistronrc;

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

    public function getTipoCliente(): ?int
    {
        return $this->tipoCliente;
    }

    public function setTipoCliente(?int $tipoCliente): static
    {
        $this->tipoCliente = $tipoCliente;

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
