<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblEstado
 *
 * @ORM\Table(name="tbl_estado")
 * @ORM\Entity
 */
class TblEstado
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_estado", type="string", length=50, nullable=false)
     */
    private $nombreEstado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEstado(): ?string
    {
        return $this->nombreEstado;
    }

    public function setNombreEstado(string $nombreEstado): static
    {
        $this->nombreEstado = $nombreEstado;

        return $this;
    }


}
