<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblEnsayos
 *
 * @ORM\Table(name="tbl_ensayos", indexes={@ORM\Index(name="fkEstado", columns={"fkEstado"})})
 * @ORM\Entity
 */
class TblEnsayos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ensayo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEnsayo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_ensayo", type="string", length=100, nullable=false)
     */
    private $nombreEnsayo;

    /**
     * @var \TblEstado
     *
     * @ORM\ManyToOne(targetEntity="TblEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fkEstado", referencedColumnName="id")
     * })
     */
    private $fkestado;

    public function getIdEnsayo(): ?int
    {
        return $this->idEnsayo;
    }

    public function getNombreEnsayo(): ?string
    {
        return $this->nombreEnsayo;
    }

    public function setNombreEnsayo(string $nombreEnsayo): static
    {
        $this->nombreEnsayo = $nombreEnsayo;

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
