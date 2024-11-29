<?php
include_once 'Biblioteca.php';
include_once 'Busqueda.php';
include_once 'Prestamo.php';


// instancia de biblioteca
$biblioteca = new Biblioteca();

// agregando libros
$biblioteca->agregarLibro(new Libro("Cien años de soledad", "Gabriel García Márquez", "Novela"));
$biblioteca->agregarLibro(new Libro("Cien años de seriedad", "Gabriel García Márquez", "Novela"));
$biblioteca->agregarLibro(new Libro("1984", "George Orwell", "Distopía"));
$biblioteca->agregarLibro(new Libro("El Principito", "Antoine de Saint-Exupéry", "Fábula"));

# generar los gesorres de busqueda y prestmos de los libros
$gestorDeBusqueda = new GestorDeBusqueda($biblioteca);
$gestorDePrestamos = new GestorDePrestamos($biblioteca);

# pa mostrar los libros
$biblioteca->mostrarLibros();

// Buscar un libro
echo "\n \n";
$libros = $gestorDeBusqueda->buscarLibros("Novela");
#retorna los libros con ese criterio
if (empty($libros)) {
    echo "No se encontraron libros con ese criterio.\n";
} else {
    foreach ($libros as $libro) {
        echo "Título: {$libro->getTitulo()} - Autor: {$libro->getAutor()}\n";
    }
}
#para borrar necesitamos determinar
#titulo y la especificacion titulo
#autor y especificacion autor
echo $biblioteca->eliminarLibro('1984','titulo');
echo "\n";
$biblioteca->mostrarLibros();

#metodos adicinales:

#prestar un libro
echo $gestorDePrestamos->prestarLibro("Cien años de soledad");
echo "\n";
$biblioteca->mostrarLibros();
#Regresar e libro
echo $gestorDePrestamos->devolverLibro("Cien años de soledad");
echo "\n";
$biblioteca->mostrarLibros();
#editar un libro
print_r($biblioteca->editarLibro("Cien años de soledad",'la papa','Don pelos', 'terror',true));
echo "\n";
$biblioteca->mostrarLibros();


?>