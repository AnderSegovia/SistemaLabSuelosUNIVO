<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMunicipios
 *
 * @ORM\Table(name="tbl_municipios", indexes={@ORM\Index(name="fk_departamento", columns={"fk_departamento"})})
 * @ORM\Entity
 */
class TblMunicipios
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_municipio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_municipio", type="string", length=100, nullable=false)
     */
    private $nombreMunicipio;

    /**
     * @var \TblDepartamentos
     *
     * @ORM\ManyToOne(targetEntity="TblDepartamentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_departamento", referencedColumnName="id_departamento")
     * })
     */
    private $fkDepartamento;

    public function getIdMunicipio(): ?int
    {
        return $this->idMunicipio;
    }

    public function getNombreMunicipio(): ?string
    {
        return $this->nombreMunicipio;
    }

    public function setNombreMunicipio(string $nombreMunicipio): static
    {
        $this->nombreMunicipio = $nombreMunicipio;

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
