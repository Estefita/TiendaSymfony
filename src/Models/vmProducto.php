<?php
namespace App\Models;

class vmProducto{
    private $id;
    private $NombreProducto;
    private $descripcion;
    private $precio;
    private $NombreImagen;
    private $NombreCategoria;
    private $cantidad;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of NombreProducto
     */ 
    public function getNombreProducto()
    {
        return $this->NombreProducto;
    }

    /**
     * Set the value of NombreProducto
     *
     * @return  self
     */ 
    public function setNombreProducto($NombreProducto)
    {
        $this->NombreProducto = $NombreProducto;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of NombreImagen
     */ 
    public function getNombreImagen()
    {
        return $this->NombreImagen;
    }

    /**
     * Set the value of NombreImagen
     *
     * @return  self
     */ 
    public function setNombreImagen($NombreImagen)
    {
        $this->NombreImagen = $NombreImagen;

        return $this;
    }

    /**
     * Get the value of NombreCategoria
     */ 
    public function getNombreCategoria()
    {
        return $this->NombreCategoria;
    }

    /**
     * Set the value of NombreCategoria
     *
     * @return  self
     */ 
    public function setNombreCategoria($NombreCategoria)
    {
        $this->NombreCategoria = $NombreCategoria;

        return $this;
    }
    

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
