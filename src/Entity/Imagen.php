<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imagen
 * @ORM\Entity(repositoryClass="App\Repository\ImagenRepository")
 * @ORM\Table(name="Imagen", indexes={@ORM\Index(name="idproducto", columns={"idproducto"})})
 */
class Imagen
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
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="predeterminado", type="integer", nullable=false)
     */
    private $predeterminado = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="activo", type="integer", nullable=false, options={"default"="1"})
     */
    private $activo = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagencol", type="string", length=45, nullable=true)
     */
    private $imagencol;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idproducto", referencedColumnName="id")
     * })
     */
    private $idproducto;

    function __construct(){
        $this->idproducto = new Producto;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPredeterminado(): ?int
    {
        return $this->predeterminado;
    }

    public function setPredeterminado(int $predeterminado): self
    {
        $this->predeterminado = $predeterminado;

        return $this;
    }

    public function getActivo(): ?int
    {
        return $this->activo;
    }

    public function setActivo(int $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getImagencol(): ?string
    {
        return $this->imagencol;
    }

    public function setImagencol(?string $imagencol): self
    {
        $this->imagencol = $imagencol;

        return $this;
    }

    public function getIdproducto(): ?Producto
    {
        return $this->idproducto;
    }

    public function setIdproducto(?Producto $idproducto): self
    {
        $this->idproducto = $idproducto;

        return $this;
    }


}
