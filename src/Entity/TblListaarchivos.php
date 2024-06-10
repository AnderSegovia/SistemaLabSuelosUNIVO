<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblListaarchivos
 *
 * @ORM\Table(name="tbl_listaarchivos", indexes={@ORM\Index(name="fk_estado", columns={"fk_estado"})})
 * @ORM\Entity
 */
class TblListaarchivos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_lista", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLista;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=200, nullable=false)
     */
    private $ruta;

    /**
     * @var \TblEstado
     *
     * @ORM\ManyToOne(targetEntity="TblEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_estado", referencedColumnName="id")
     * })
     */
    private $fkEstado;

    public function getIdLista(): ?int
    {
        return $this->idLista;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getRuta(): ?string
    {
        return $this->ruta;
    }

    public function setRuta(string $ruta): static
    {
        $this->ruta = $ruta;

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
