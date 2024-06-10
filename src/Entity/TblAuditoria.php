<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * TblAuditoria
 *
 * @ORM\Table(name="tbl_auditoria", indexes={@ORM\Index(name="fk_usuario", columns={"fk_usuario"}), @ORM\Index(name="fk_material1", columns={"fk_material"}), @ORM\Index(name="fk_lista", columns={"fk_lista"})})
 * @ORM\Entity
 */
class TblAuditoria
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_auditoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAuditoria;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=100, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo_nuevo", type="string", length=200, nullable=false)
     */
    private $archivoNuevo;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo_antiguo", type="string", length=200, nullable=false)
     */
    private $archivoAntiguo;

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
     * @var \TblUsuario
     *
     * @ORM\ManyToOne(targetEntity="TblUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_usuario", referencedColumnName="codigo_usuario")
     * })
     */
    private $fkUsuario;

    /**
     * @var \TblListaarchivos
     *
     * @ORM\ManyToOne(targetEntity="TblListaarchivos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_lista", referencedColumnName="id_lista")
     * })
     */
    private $fkLista;

    public function getIdAuditoria(): ?int
    {
        return $this->idAuditoria;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getArchivoNuevo(): ?string
    {
        return $this->archivoNuevo;
    }

    public function setArchivoNuevo(string $archivoNuevo): static
    {
        $this->archivoNuevo = $archivoNuevo;

        return $this;
    }

    public function getArchivoAntiguo(): ?string
    {
        return $this->archivoAntiguo;
    }

    public function setArchivoAntiguo(string $archivoAntiguo): static
    {
        $this->archivoAntiguo = $archivoAntiguo;

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

    public function getFkUsuario(): ?TblUsuario
    {
        return $this->fkUsuario;
    }

    public function setFkUsuario(?TblUsuario $fkUsuario): static
    {
        $this->fkUsuario = $fkUsuario;

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
