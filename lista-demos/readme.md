@author: Christian Salazar H. <christiansalazarh@gmail.com> @bluyell

Normas Basicas para Demos
-------------------------

Esta es la lista de demos creados por la comunidad, para insertar un demo debes cumplir lo siguiente:

1. Crea tu demo con un numero secuencial que no este siendo usado, ejemplo DEMO1, luego crea una base de datos SQLITE con el mismo nombre para proposito de tu demo, evita otro tipo de nombres porque el administrador de los ejemplos lo borrara conjunto con el demo, es un asunto de orden.

2. Debido a que tendras tu propio archivo de base de datos para sqlite es indispensable que tu configures tu propio atributo connectionString a efectos de hacerlo apuntar a tu propio archivo.

3.	Debes configurar la extension en tu PHP.INI:
	extension=php_pdo_sqlite.dll
	extension=php_sqlite.dll

Usando SQLite
-------------

Todos los demos deben usar una base de datos SQLITE en caso de requerir datos. Para usar sqlite debes descargar un pequeño cliente para gestionar las tablas y tu propia base de datos, para descargar el cliente sqlite entra aqui: <a href='http://www.sqlite.org/'>http://www.sqlite.org/</a>

Para el caso de Windows, puedes descargar este pequeño EXE:
[cliente sqlite para windows](http://www.sqlite.org/sqlite-shell-win32-x86-3071300.zip)

Es muy simple usar SQLITE, simplemente en la carpeta /protected/data usa tu shell prompt para ir hacia 
el directorio:
/e/code/yiiframeworkenespanol/ejemplos/protected/data
Luego, ejecutas sqlite3.exe seguido del nombre de la base de datos de tu demo.

	publico@COCO /e/code/yiiframeworkenespanol/ejemplos/protected/data (master)
	$ sqlite demo1.db
	SQLite version 3.7.13 2012-06-11 02:05:22
	Enter ".help" for instructions
	Enter SQL statements terminated with a ";"
	sqlite>

luego, crear tablas para el demo:

	sqlite> create table categoria(idcategoria integer, nombre char(45));
	sqlite> create table producto(idproducto integer,idcategoria integer, nombre char(45), precio float);

insertar algunos datos de ejemplo:

	sqlite> insert into categoria values(1,'vehiculos');
	sqlite> insert into categoria values(2,'ropa');
	sqlite> insert into categoria values(3,'alimentos');

	sqlite> insert into producto values(1,1,'chevrolet aveo',125000);
	sqlite> insert into producto values(2,1,'ford fiesta',120000);
	sqlite> insert into producto values(3,1,'malibu classic',80000);
	sqlite> insert into producto values(4,2,'camisas',1000);
	sqlite> insert into producto values(5,2,'pantalones',1200);
	sqlite> insert into producto values(6,3,'cereales',80);
	sqlite> insert into producto values(7,3,'granos',25);

consultas:

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

---	
	
