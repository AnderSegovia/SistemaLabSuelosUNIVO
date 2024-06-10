<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblDepartamentos
 *
 * @ORM\Table(name="tbl_departamentos")
 * @ORM\Entity
 */
class TblDepartamentos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_departamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_departamento", type="string", length=50, nullable=false)
     */
    private $nombreDepartamento;

    public function getIdDepartamento(): ?int
    {
        return $this->idDepartamento;
    }

    public function getNombreDepartamento(): ?string
    {
        return $this->nombreDepartamento;
    }

    public function setNombreDepartamento(string $nombreDepartamento): static
    {
        $this->nombreDepartamento = $nombreDepartamento;

        return $this;
    }


}
