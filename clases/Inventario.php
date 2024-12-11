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
        // Generar informe de productos de X precio
        // Generar informe de productos con stock mas bajo a X numero
        // Generar informe de productos sin stock
        // Generar informe de productos con stock actualizado
    }




    
}


function prompt($mensaje){
    echo $mensaje;
    $input = trim(fgets(STDIN));
    return $input;
}

?>