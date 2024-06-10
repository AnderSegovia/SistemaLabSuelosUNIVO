<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblMuestras
 *
 * @ORM\Table(name="tbl_muestras", indexes={@ORM\Index(name="fk_materiales", columns={"fk_materiales"}), @ORM\Index(name="tipo_muestra", columns={"tipo_muestra"}), @ORM\Index(name="ensayo", columns={"ensayo"})})
 * @ORM\Entity
 */
class TblMuestras
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_muestra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMuestra;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_elaboracion", type="date", nullable=false)
     */
    private $fechaElaboracion;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=255, nullable=false)
     */
    private $procedencia;

    /**
     * @var \TblEnsayos
     *
     * @ORM\ManyToOne(targetEntity="TblEnsayos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ensayo", referencedColumnName="id_ensayo")
     * })
     */
    private $ensayo;

    /**
     * @var \TblMateriales
     *
     * @ORM\ManyToOne(targetEntity="TblMateriales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_materiales", referencedColumnName="id_material")
     * })
     */
    private $fkMateriales;

    /**
     * @var \TblTipoMuestra
     *
     * @ORM\ManyToOne(targetEntity="TblTipoMuestra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_muestra", referencedColumnName="id_tipo_muestra")
     * })
     */
    private $tipoMuestra;

    public function getIdMuestra(): ?int
    {
        return $this->idMuestra;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFechaElaboracion(): ?\DateTimeInterface
    {
        return $this->fechaElaboracion;
    }

    public function setFechaElaboracion(\DateTimeInterface $fechaElaboracion): static
    {
        $this->fechaElaboracion = $fechaElaboracion;

        return $this;
    }

    public function getProcedencia(): ?string
    {
        return $this->procedencia;
    }

    public function setProcedencia(string $procedencia): static
    {
        $this->procedencia = $procedencia;

        return $this;
    }

    public function getEnsayo(): ?TblEnsayos
    {
        return $this->ensayo;
    }

    public function setEnsayo(?TblEnsayos $ensayo): static
    {
        $this->ensayo = $ensayo;

        return $this;
    }

    public function getFkMateriales(): ?TblMateriales
    {
        return $this->fkMateriales;
    }

    public function setFkMateriales(?TblMateriales $fkMateriales): static
    {
        $this->fkMateriales = $fkMateriales;

        return $this;
    }

    public function getTipoMuestra(): ?TblTipoMuestra
    {
        return $this->tipoMuestra;
    }

    public function setTipoMuestra(?TblTipoMuestra $tipoMuestra): static
    {
        $this->tipoMuestra = $tipoMuestra;

        return $this;
    }


}
