<?php
#https://dev.to/nahuelsegovia/inyeccion-de-dependencias-174a
#https://platzi.com/tutoriales/1467-curso-php-laravel/4552-inyeccion-de-dependencias-en-php/
#https://es.eitca.org/web-development/eitc-wd-pmsf-php-and-mysql-fundamentals/expertise-in-php/null-coalescing/examination-review-null-coalescing/how-does-the-null-coalescing-operator-work-in-php/#:~:text=El%20operador%20coalescente%20nulo%20en%20PHP%20es%20una%20herramienta%20poderosa,el%20valor%20original%20es%20nulo.

class GestorDeBusqueda {
    private $biblioteca;

    #hacemos uso de la inyeccion de dependencias
    public function __construct(Biblioteca $biblioteca) {
        $this->biblioteca = $biblioteca;
    }

    #este busca a todos los libros que cumplen con el requisito y devuelve la lista
    public function buscarLibros($criterio) {
        $libros = $this->biblioteca->obtenerLibros();
        $librosEncontrados = [];
        foreach ($libros as $libro) {
            if ($libro->buscar($criterio)) {
                $librosEncontrados[] = $libro;
            }
        }
        return $librosEncontrados; #;a lista
    }


    // #Este es mayormente para buscar cosas especificas, en lugar de la lista devuelve el objeto
    // public function buscarLibro($criterio) {
    //     $librosEncontrados = $this->buscarLibros($criterio);
    //     return $librosEncontrados[0] ?? null; // Retorna el primer libro o null
    // }
    // #ya no se usa, pero quien sabe
}
