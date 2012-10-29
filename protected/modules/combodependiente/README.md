##usando dropDownList dependientes
####Christian Salazar H. <christiansalazarh@gmail.com> @bluyell
####how-to
Este ejemplo muestra como usar dos dropDownList dependientes, uno conteniendo categorias
y el otro productos, entonces al seleccionar una categoria aparecen los productos asociados. 
El ejemplo se realizara usando parcialmente ajax y jquery debido al alto performance que da y a
la simplicidad del codigo.

Disponemos de dos tablas: Categoria y Productos, de esta forma:

	sqlite> select * from categoria;
	1|vehiculos
	2|ropa
	3|alimentos

	sqlite> select * from producto;
	1|1|chevrolet aveo|125000.0
	2|1|ford fiesta|120000.0
	3|1|malibu classic|80000.0
	4|2|camisas|1000.0
	5|2|pantalones|1200.0
	6|3|cereales|80.0
	7|3|granos|25.0