<?php
include_once 'Libro.php';
class Biblioteca {
    private $libros = [];

    #agregmos a la lista de los libros
    public function agregarLibro(Libro $libro) {
        $this->libros[] = $libro;
    }

    #hacemos un recorrido de la lista y mostramos con algunos detalles
    public function mostrarLibros() {
        echo "Lista de libros disponibles:\n";
        foreach ($this->libros as $libro) {
            echo "- " . $libro->getTitulo() . " por " . $libro->getAutor() . 
                ($libro->getDisponibilidad() ? " (Disponible)" : " (No disponible)") . "\n";
        }
    }


    
    public function editarLibro($criterio, $Ntitulo, $Nautor, $Ncategoria, $disponibilidad) {
    #neceistamos que todo tenga al menos 2 cracteres, pueden no ser null pero no vamos a nombrar un libro 'df'
        foreach ($this->libros as $libro) {
            if ($libro->buscar($criterio)) {
                if (strlen($Ntitulo) < 2 || strlen($Nautor) < 2 || strlen($Ncategoria) < 2 || !is_bool($disponibilidad)) {
                    echo "Error: Asegúrate de que todos los datos sean válidos.\n";
                    return null;
                }
                
                # validar datos ingresados
                #pa poder editar, necesitamos validar que todos los datos sean validos, de lo contrario, nel
                if (!empty($Ntitulo) && !empty($Nautor) && !empty($Ncategoria) && is_bool($disponibilidad)) {
                    $libro->setTitulo($Ntitulo);
                    $libro->setAutor($Nautor);
                    $libro->setCategoria($Ncategoria);
                    $libro->setDisponibilidad($disponibilidad);
                    echo "Libro actualizado correctamente.\n";
                    return $libro; #retornamos el nuevo libro
                } else {
                    echo "Error -> Asegúrate de que todos los datos estén completos y sean válidos.\n";
                    return null; #retornamos que nada es valido
                }
            }
        }
        #si no hay libro
        echo "Error: No se encontró ningún libro con el criterio especificado.\n";
        return null;
    }

    #antes podia borrar todo el genero, ahora necesita:
    #titulo y que se especifique que se pasa titulo
    #autor y que se especifique que se pasa el autor
    public function eliminarLibro($criterio, $campo) {
        foreach ($this->libros as $index => $libro) {
            #verificacion si es valido y cumple con los criterios
            if (($campo === 'titulo' && $libro->getTitulo() === $criterio) ||
                ($campo === 'autor' && $libro->getAutor() === $criterio)) {
                unset($this->libros[$index]);
                return "Libro '$criterio' eliminado correctamente.";
            }
        }
        return "Error -> No se encontró ningún libro con el $campo '$criterio'.";
    }
    
    
    

    public function obtenerLibros() {
        return $this->libros; #por si otras clases lo usan
    }
}
