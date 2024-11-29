<?php

class GestorDePrestamos {
    private $biblioteca;

    public function __construct(Biblioteca $biblioteca) {
        $this->biblioteca = $biblioteca;
    }

    #pa optimizar esto de pedir lo mismo en las 2 funciones
    private function obtenerLibroPorTitulo($titulo) {
        #mandamos a llmar a obtener libros de la clase biblioteca
        $libros = $this->biblioteca->obtenerLibros();
        foreach ($libros as $libro) {
            if ($libro->getTitulo() === $titulo) {
                return $libro;
            }
        }
        return null; # Si no se encuentra el libro
    }
    

    public function prestarLibro($titulo) {
        #buscamos el libro
        $libro = $this->obtenerLibroPorTitulo($titulo);
        if ($libro) {#si lo hallamos
            if ($libro->getDisponibilidad()) { #verificamos que este disponible
                return $libro->prestar(); #prestamos (ver metodo en Libro)
            }
            return "El libro '$titulo' ya está prestado."; #parace que te lo ganaron
        }
        return "El libro no existe."; #a ese libro ni su escritor lo conoce
    }
    

    
    public function devolverLibro($titulo) {
        #verificamos si el titulo es algo que exista
        $libro = $this->obtenerLibroPorTitulo($titulo);
        #validamos que este no disponible, por que como vas a devolver algo que ya esta devolvido (creo que eso no existe)
        if ($libro && !$libro->getDisponibilidad()) { 
            #devolvemos, revisa metodo en Libro
            return $libro->devolver();
        }
        return "El libro no existe o ya está disponible.";
    }
    
}
