<?php

// Clase Libro (Base)
class Libro
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
        $this->disponibilidad = true;  // Al principio está disponible
    }

    public function prestar()
    {
        if ($this->disponibilidad) {
            $this->disponibilidad = false;
            return "¡El libro '$this->titulo' ha sido prestado! \n";
        }
        return "El libro '$this->titulo' no está disponible.";
    }

    public function devolver()
    {
        $this->disponibilidad = true;
        return "¡El libro '$this->titulo' ha sido devuelto!";
    }

    public function buscar($criterio)
    {
        // Busca por título, autor, o categoría
        if (stripos($this->titulo, $criterio) !== false || stripos($this->autor, $criterio) !== false || stripos($this->categoria, $criterio) !== false) {
            return true;
        }
        return false;
    }


    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($Ntitulo)
    {
        $this->titulo = $Ntitulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($Nautor)
    {
        $this->autor = $Nautor;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($Ncategoria)
    {
        $this->categoria = $Ncategoria;
    }

    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }

    public function setDisponibilidad($disponibilidad)
    {
        $this->disponibilidad = $disponibilidad;
    }

}

// Clase Biblioteca (Gestión de Libros)
class Biblioteca
{
    private $libros = [];

    public function agregarLibro(Libro $libro)
    {
        $this->libros[] = $libro;
    }
    public function editarLibro($criterio, $Ntitulo, $Nautor, $Ncategoria, $disponibilidad) {
        foreach ($this->libros as $libro) {            
            if ($libro->buscar($criterio)) {
                $libro->setTitulo($Ntitulo);
                $libro->setAutor($Nautor);
                $libro->setCategoria($Ncategoria);
                $libro->setDisponibilidad($disponibilidad); // Corrige el nombre del método
                return $libro; // Retorna el libro editado
            }
        }
        return null; // Retorna null si no se encuentra el libro
    }

    #este es para retornar el objeto de libro si existe
    public function buscarLibro($criterio1)
    {
        foreach ($this->libros as $libro) {

            if ($libro->buscar($criterio1)) {
                #                return $libro->getTitulo();
                return $libro;
            }
        }
        return null;
    }
    #este es apra retornar los libros existentes bajo autor
    public function buscarLibros($criterio)
    {
        $librosEncontrados = []; // Array para almacenar los libros encontrados
        foreach ($this->libros as $libro) {
            if ($libro->buscar($criterio)) {
                $librosEncontrados[] = $libro; // Agregar el libro encontrado al array
            }
        }
    
        // Manejo de resultados
        if (!empty($librosEncontrados)) {
            echo "Libros encontrados:\n";
            foreach ($librosEncontrados as $libro) {
                echo "- " . $libro->getTitulo() . " por " . $libro->getAutor() . "\n";
            }
        } else {
            echo "No se encontraron libros para el criterio especificado.\n";
        }
    
        return $librosEncontrados; // se retorna en lista pa que sea mas ez
    }

    public function mostrarLibros() {
        if (empty($this->libros)) {
            echo "No hay libros registrados.\n";
            return;
        }
        echo "Lista de libros:\n";
        foreach ($this->libros as $libro) {
            echo "- " . $libro->getTitulo() . " (Autor: " . $libro->getAutor() . ", Categoría: " . $libro->getCategoria() . ", " . ($libro->getDisponibilidad() ? "Disponible" : "No disponible") . ")\n";
        }
    }
    

    public function prestarLibro($titulo)
    {
        $libro = $this->buscarLibro($titulo);
        if ($libro) {

            return $libro->prestar(); // El libro maneja su propio estado
        }
        return "El libro no existe.";
    }
    public function devolverLibro($titulo)
    {
        $libro = $this->buscarLibro($titulo);
        if (!$libro->getDisponibilidad()) {
            return $libro->devolver();
        }
        return "El libro no existe.";
    }
}

// Ejemplo de uso

$bib = new Biblioteca();
$libro1 = new Libro("El Quijote", "Cervantes", "Clásicos");
$libro2 = new Libro("PHP para Dummies", "John Doe", "Tecnología");
$libro3 = new Libro("PHP para Dummies2", "John Doe", "Tecnología");
$libro4 = new Libro("El Quijote2", "Cervantes", "Clásicos");
$libro5 = new Libro("El Quijote3", "Cervantes", "Clásicos");

$bib->agregarLibro($libro1);
$bib->agregarLibro($libro2);
$bib->agregarLibro($libro3);
$bib->agregarLibro($libro4);
$bib->agregarLibro($libro5);

#$bib->mostrarLibros();

// $libroBuscado = $bib->buscarLibros('John Doe');
// if ($libroBuscado) {
//     echo "Libro encontrado: " . $libroBuscado->getTitulo() . "\n";
// }

// $librosBuscados = $bib->buscarLibros('PHP para Dummies2');
// if (!empty($librosBuscados)) {
//     echo "Libros encontrados:\n";
//     foreach ($librosBuscados as $libro) {
//         echo "- " . $libro->getTitulo() . " por " . $libro->getAutor() . "\n";
//     }
// } else {
//     echo "No se encontraron libros para el autor especificado.\n";
// }

// echo $bib->prestarLibro('El Quijote');

// $bib->mostrarLibros();



// $bib->mostrarLibros();

// $bib->editarLibro("El Quijote", "El Quijote - Edición 2023", "Cervantes", "Clásicos", true);


// $bib->mostrarLibros();



print($bib->buscarLibros('Clásicos'));
#$bib->mostrarLibros();