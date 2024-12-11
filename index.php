<?php 

require_once './clases/Producto.php';
require_once './clases/Inventario.php';

function displayMenu(){
    echo "---- Menu de la Tiendita ---- \n";
    echo "1. Agregar nuevo producto \n";
    echo "2. Eliminar producto \n";
    echo "3. Actualizar producto \n";
    echo "4. Devolver producto \n";
    echo "5. Generar Venta \n";
    echo "6. Generar informe \n";
    echo "7. Salir \n";
    echo "Seleccione una opcion: ";
}



$inventario = new Inventario([]);

// Agregar productos quemados al inventario
$productosQuemados = [
    new Producto(1, "Producto Quemado 1", "Descripción del producto quemado 1", 10.00, 5, "Proveedor 1", "Categoría 1"),
    new Producto(2, "Producto Quemado 2", "Descripción del producto quemado 2", 15.00, 3, "Proveedor 2", "Categoría 2"),
    new Producto(3, "Producto Quemado 3", "Descripción del producto quemado 3", 20.00, 2, "Proveedor 3", "Categoría 3"),
];

// Agregar los productos quemados al inventario
foreach ($productosQuemados as $producto) {
    $inventario->agregarProducto($producto);
}

$flag = true;
$idProducto = 3; // Comenzar desde el último ID usado

while($flag){
    displayMenu();
    $opcion = prompt("");
    switch($opcion){
        case 1: 
            // Obtener valores de producto a través de prompt
            $idProducto++;
            $nombre = prompt("Ingrese el nombre del producto:\n");
            $descripcion = prompt("Ingrese la descripcion del producto:\n");
            $precio = prompt("Ingrese el precio del producto:\n");
            $cantidad = prompt("Ingrese la cantidad del producto:\n");
            $categoria = prompt("Ingrese la categoria de su producto: \n");
            $proveedor = prompt("Ingrese quien es el proveedor de su producto: \n");
            // Crear nuevo producto con los valores recibidos
            $producto = new Producto($idProducto, $nombre, $descripcion, $precio, $cantidad, $proveedor, $categoria);
            // Agregar el nuevo producto a nuestro inventario
            $inventario->agregarProducto($producto);
            echo "Ingresaste el siguiente producto: \n";
            print_r($inventario);
            break;
        case 2: 
            echo "Estas eliminando un producto \n";
            break;
        case 3:
            $id = prompt("Digite el ID del item a modificar: ");
            print_r ($inventario -> actualizarProducto($id));
            echo "\n";
            break;
        case 4:
            echo "Estas por devolver un producto \n";
            print_r($inventario);
            echo "\n";
            break;
        case 5: 
            echo "Estas generando una nueva venta \n";
            break;
        case 6:
            echo "Estas generando un informe \n";
            break;
        case 7:
            echo "Estas saliendo ... \n";
            $flag = false;
            break;

        default: 
            echo "Seleccione una opcion valida \n";
    }
}

?>