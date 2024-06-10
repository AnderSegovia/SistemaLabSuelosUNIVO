<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblTipoMuestra
 *
 * @ORM\Table(name="tbl_tipo_muestra", indexes={@ORM\Index(name="fkEstado", columns={"fkEstado"})})
 * @ORM\Entity
 */
class TblTipoMuestra
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tipo_muestra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoMuestra;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tipo_muestra", type="string", length=100, nullable=false)
     */
    private $nombreTipoMuestra;

    /**
     * @var \TblEstado
     *
     * @ORM\ManyToOne(targetEntity="TblEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkEstado", referencedColumnName="id")
     * })
     */
    private $fkestado;

    public function getIdTipoMuestra(): ?int
    {
        return $this->idTipoMuestra;
    }

    public function getNombreTipoMuestra(): ?string
    {
        return $this->nombreTipoMuestra;
    }

    public function setNombreTipoMuestra(string $nombreTipoMuestra): static
    {
        $this->nombreTipoMuestra = $nombreTipoMuestra;

        return $this;
    }

    public function getFkestado(): ?TblEstado
    {
        return $this->fkestado;
    }

    public function setFkestado(?TblEstado $fkestado): static
    {
        $this->fkestado = $fkestado;

        return $this;
    }


}
