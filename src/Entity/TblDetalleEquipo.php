<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblDetalleEquipo
 *
 * @ORM\Table(name="tbl_detalle_equipo", indexes={@ORM\Index(name="fk_molde", columns={"fk_molde"}), @ORM\Index(name="fk_equipo", columns={"fk_equipo"})})
 * @ORM\Entity
 */
class TblDetalleEquipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_detalle_equipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDetalleEquipo;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad_equipo", type="integer", nullable=false)
     */
    private $cantidadEquipo;

    /**
     * @var \TblMolde
     *
     * @ORM\ManyToOne(targetEntity="TblMolde")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_molde", referencedColumnName="id_molde")
     * })
     */
    private $fkMolde;

    /**
     * @var \TblEquipo
     *
     * @ORM\ManyToOne(targetEntity="TblEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_equipo", referencedColumnName="id_equipo")
     * })
     */
    private $fkEquipo;

    public function getIdDetalleEquipo(): ?int
    {
        return $this->idDetalleEquipo;
    }

    public function getCantidadEquipo(): ?int
    {
        return $this->cantidadEquipo;
    }

    public function setCantidadEquipo(int $cantidadEquipo): static
    {
        $this->cantidadEquipo = $cantidadEquipo;

        return $this;
    }

    public function getFkMolde(): ?TblMolde
    {
        return $this->fkMolde;
    }

    public function setFkMolde(?TblMolde $fkMolde): static
    {
        $this->fkMolde = $fkMolde;

        return $this;
    }

    public function getFkEquipo(): ?TblEquipo
    {
        return $this->fkEquipo;
    }

    public function setFkEquipo(?TblEquipo $fkEquipo): static
    {
        $this->fkEquipo = $fkEquipo;

        return $this;
    }


}
