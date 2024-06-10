<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblPivote
 *
 * @ORM\Table(name="tbl_pivote", indexes={@ORM\Index(name="fk_lista", columns={"fk_lista"}), @ORM\Index(name="fk_material", columns={"fk_material"})})
 * @ORM\Entity
 */
class TblPivote
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pivote", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPivote;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_archivo", type="string", length=200, nullable=false)
     */
    private $nombreArchivo;

    /**
     * @var \TblMateriales
     *
     * @ORM\ManyToOne(targetEntity="TblMateriales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_material", referencedColumnName="id_material")
     * })
     */
    private $fkMaterial;

    /**
     * @var \TblListaarchivos
     *
     * @ORM\ManyToOne(targetEntity="TblListaarchivos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_lista", referencedColumnName="id_lista")
     * })
     */
    private $fkLista;

    public function getIdPivote(): ?int
    {
        return $this->idPivote;
    }

    public function getNombreArchivo(): ?string
    {
        return $this->nombreArchivo;
    }

    public function setNombreArchivo(string $nombreArchivo): static
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    public function getFkMaterial(): ?TblMateriales
    {
        return $this->fkMaterial;
    }

    public function setFkMaterial(?TblMateriales $fkMaterial): static
    {
        $this->fkMaterial = $fkMaterial;

        return $this;
    }

    public function getFkLista(): ?TblListaarchivos
    {
        return $this->fkLista;
    }

    public function setFkLista(?TblListaarchivos $fkLista): static
    {
        $this->fkLista = $fkLista;

        return $this;
    }


}
