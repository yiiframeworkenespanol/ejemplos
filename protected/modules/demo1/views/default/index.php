<h1>Maestro Detalle con CGridView y Ajax</h2>
<p>Ejemplo de maestro-detalle</p>
<p>El objeto es que al hacerle click al icono view se presente debajo una lista con los productos asociados a la categoria principal</p>
<div id='log'></div>
<script>
	/*
		MUY IMPORTANTE:
		Tu CActiveDataProvider debe proveer esta configuracion:
			'keyAttribute'=>'idcategoria',
		para que  var idcategoria = $.fn.yiiGridView.getSelection('categorias');
		devuelva un valor de seleccion.
	*/
	function mostrarDetalles(){
		// no olvides configurar tu CActiveDataProvider con: 'keyAttribute'=>'idcategoria',
		var idcategoria = $.fn.yiiGridView.getSelection('categorias');
		$.fn.yiiGridView.update('productos',{ data: idcategoria });
	}
</script>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categorias',
	'selectableRows'=>1,
	'selectionChanged'=>'mostrarDetalles',	// via 1: para mostrar detalles al seleccionar
    'dataProvider'=>$dataProvider,
    'columns'=>array(
		// nota que con htmlOptions se puede personalizar el tamano de la columna
        array('name'=>'idcategoria','htmlOptions'=>array('width'=>'80px')),
		// nota que aqui no se usa array, sino directamente el nombre de la columna
        'nombre',
		
		// via 2: para mostrar detalles al hacer click en un icono.
        array(
            'class'=>'CButtonColumn',
			'template' => '{detallarproducto}',
			'buttons' => array(
					'detallarproducto'=>array(
						'label'=>'ver productos',
						'imageUrl'=>'images/demo1/view.png',
						'click'=>'js:mostrarDetalles',
					),
				),
        ),
    ),
));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'productos',
	'dataProvider'=>$dataProviderProductos,
    'columns'=>array(
        'idproducto',
		'idcategoria',
        'nombre',
    ),
));
?>