<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMolde
 *
 * @ORM\Table(name="tbl_molde", indexes={@ORM\Index(name="IDX_1725E09B6F38973", columns={"fk_estado"})})
 * @ORM\Entity
 */
class TblMolde
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_molde", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMolde;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_molde", type="string", length=120, nullable=false)
     */
    private $nombreMolde;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cantidad_molde", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cantidadMolde = NULL;

    /**
     * @var \TblEstado
     *
     * @ORM\ManyToOne(targetEntity="TblEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_estado", referencedColumnName="id")
     * })
     */
    private $fkEstado;

    public function getIdMolde(): ?int
    {
        return $this->idMolde;
    }

    public function getNombreMolde(): ?string
    {
        return $this->nombreMolde;
    }

    public function setNombreMolde(string $nombreMolde): static
    {
        $this->nombreMolde = $nombreMolde;

        return $this;
    }

    public function getCantidadMolde(): ?int
    {
        return $this->cantidadMolde;
    }

    public function setCantidadMolde(?int $cantidadMolde): static
    {
        $this->cantidadMolde = $cantidadMolde;

        return $this;
    }

    public function getFkEstado(): ?TblEstado
    {
        return $this->fkEstado;
    }

    public function setFkEstado(?TblEstado $fkEstado): static
    {
        $this->fkEstado = $fkEstado;

        return $this;
    }


}
