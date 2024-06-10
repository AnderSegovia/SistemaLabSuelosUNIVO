<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblRol
 *
 * @ORM\Table(name="tbl_rol")
 * @ORM\Entity
 */
class TblRol
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRol;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre_rol", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $nombreRol = 'NULL';

    public function getIdRol(): ?int
    {
        return $this->idRol;
    }

    public function getNombreRol(): ?string
    {
        return $this->nombreRol;
    }

    public function setNombreRol(?string $nombreRol): static
    {
        $this->nombreRol = $nombreRol;

        return $this;
    }


}
