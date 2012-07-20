##Obtener seleccion de un CGridView y pasarla a un Action usando Ajax
####Christian Salazar H. <christiansalazarh@gmail.com> @bluyell
####how-to
Este ejemplo muestra como pasar la categoria seleccionada a un action para que este devuelva los productos seleccionados en forma JSON para usarlas en cualquier parte.  Este ejemplo se enfoca en el uso de CGridView, si quieres algo un poco mas completo busca el ejemplo llamado "maestro detalle con cgridview y ajax".

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