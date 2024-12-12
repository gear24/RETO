<?php
class Inventario
{
    private $listaProductos;

    public function __construct($listaProductos)
    {
        $this->listaProductos = $listaProductos;
    }

    public function agregarProducto($producto)
    {
        // validar que el dato que me ingresen sea un objeto de PRODUCTO
        $this->listaProductos[] = $producto;
    }

    public function eliminarProducto($id)
    {
        // Quitar un dato de la lista de PRODUCTOS

        foreach ($this->listaProductos as $key => $producto) {
            if ($producto->id === $id) {
                unset($this->listaProducto[$key]);
                return true;
            }
        }

    }

    // public function buscarProductoPorCategoria($categoria){
    //     // Filtrar la lista de productos por la categoria buscada

    //     return array_filter($this->listaProductos, function($producto) use ($categoria) {
    //         return $producto->categoria === $categoria;
    //     });
    // }
    public function buscarProductoPorID($id)
    {#tomamos prestado de Jairo
        $existe = !empty($productosEncontrados = array_filter($this->listaProductos, fn($producto) => $producto->getId() == $id))
            ? reset($productosEncontrados)
            : null; 
        return $existe;
    }

    public function actualizarProducto($id) {
        $producto = $this->buscarProductoPorID($id); #devolvemos el id
    
        if ($producto instanceof Producto) { #checar si es instancia y si se encontro
            #refer to https://www.w3schools.com/php/keyword_instanceof.asp 4 more info :D
            #se gather la info
            $datos = [
                'nombre' => prompt("Ingrese el nombre del producto (dejar en blanco para no cambiar):\n"),
                'descripcion' => prompt("Ingrese la descripcion del producto (dejar en blanco para no cambiar):\n"),
                'categoria' => prompt("Ingrese la categoria de su producto (dejar en blanco para no cambiar): \n"),
                'proveedor' => prompt("Ingrese quien es el proveedor de su producto (dejar en blanco para no cambiar): \n"),
            ];
    
            #mandamos a llamar al que actualiza
            #nota 1, deberian haber mas cosas asi en el otro archivo, pero me eetoy durmiendo
            $producto->editarProducto(array_filter($datos)); #si damos enter va a obviar los que no le mandamos na'
            #pa mas info
            #https://www.w3schools.com/php/func_array_filter.asp
    
            return "Producto actualizado correctamente.";
        }
        
        return "No existe este ID"; #pos, no hay na'
    }
    public function generarInforme()
    {
        echo "Seleccione un tipo de informe a generar: \n";
        echo "Generar informe de productos de X precio \n";
        echo "Generar informe de productos con stock mas bajo a X numero \n";
        echo "Generar informe de productos sin stock \n";
        echo "Generar informe de productos con stock actualizado \n";
#pedimos la opcion a usar
        $op = prompt("Digite su opcion: \n");
        switch($op){#usamos el switch para determinar a donde va
            case 1:
                $price = prompt("Digite el precio a evaluar para el informe: ");
                #retornamos la funcion que genera el informe y lo same pal case de abajo
                return $this->generarInformePorPrecio($price);
            case 2:
                $stock = prompt("Digite el stock a evaluar para el informe: ");
                return $this->generarInformePorStock($stock);
            default:
            echo "Esa no es una opcion";

        }
    }

#filtra en el array listaproductos, para buscar el que matchee* con el filtro proporcionado que debe ser igual
    public function generarInformePorPrecio($filtro){
        $papas = ($productosEncontrados = array_filter
        ($this->listaProductos, fn($producto) => $producto->getPrecio() == $filtro)
        );
        return $papas;

    }
#filtra en el array listaproductos, para buscar el que matchee* con el filtro proporcionado que debe ser menor
    public function generarInformePorStock($filtro){
        $papas = ($productosEncontrados = array_filter
        ($this->listaProductos, fn($producto) => $producto->getStock() <= $filtro)
        );
        return $papas;

    }




    
}


function prompt($mensaje){
    echo $mensaje;
    $input = trim(fgets(STDIN));
    return $input;
}

?>