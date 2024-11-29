<?php
include_once 'Interfaces/IPrestamo.php';

// Clase Libro (Base)
class Libro implements Prestamo
{
    protected $titulo;
    protected $autor;
    protected $categoria;
    protected $disponibilidad;

    public function __construct($titulo, $autor, $categoria)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->disponibilidad = true;  // si lo acabamos de agregar deberia estar activo por defecto
    }

    public function prestar()
    {
        if ($this->disponibilidad) {
            #cambiamos a false determinando que esta ocuoa'o
            $this->disponibilidad = false;
            return "¡El libro '$this->titulo' ha sido prestado! \n";
        }
        return "El libro '$this->titulo' no está disponible.";
    }

    public function devolver()
    {
        #regresamos a true pa que este disponible
        $this->disponibilidad = true;
        return "¡El libro '$this->titulo' ha sido devuelto!";
    }


    #la funcion nos permite buscar por todos los parametros disponibles
    public function buscar($criterio)
    {
        // Busca por título, autor, o categoría
        if (stripos($this->titulo, $criterio) !== false || 
        stripos($this->autor, $criterio) !== false 
        || stripos($this->categoria, $criterio) !== false) {
            return true;
        }
        return false;
    }


    #getters y setters
    # a los setters se le agrego una funcion de verificacion para cadenas vacias
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($Ntitulo) {
        if (empty($Ntitulo)) {
            throw new Exception("El título no puede estar vacío.");
        }
        $this->titulo = $Ntitulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($Nautor) {
        if (empty($Nautor)) {
            throw new Exception("El autor no puede estar vacío.");
        }
        $this->autor = $Nautor;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($Ncategoria) {
        if (empty($Ncategoria)) {
            throw new Exception("La categoría no puede estar vacía.");
        }
        $this->categoria = $Ncategoria;
    }

    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }

    public function setDisponibilidad($disponibilidad) {
        if (!is_bool($disponibilidad)) {
            throw new Exception("La disponibilidad debe ser un valor booleano (true o false).");
        }
        $this->disponibilidad = $disponibilidad;
    }

}
