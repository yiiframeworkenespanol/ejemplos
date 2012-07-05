<h1>Obtener seleccion de un CGridView y pasarla a un Action usando Ajax</h2>
<script>
	/*
		MUY IMPORTANTE:
		Tu CActiveDataProvider debe proveer esta configuracion:
			'keyAttribute'=>'idcategoria',
		para que  var idcategoria = $.fn.yiiGridView.getSelection('categorias');
		devuelva un valor de seleccion.
	*/
	function obtenerSeleccion(){
		// no olvides configurar tu CActiveDataProvider con: 'keyAttribute'=>'idcategoria',
		var idcategoria = $.fn.yiiGridView.getSelection('categorias');
		var action='index.php?r=/democgridviewseleccionajaxaction/default/obtenerproductos&idcategoria='+idcategoria;
		// http://api.jquery.com/category/ajax/shorthand-methods/
		// http://api.jquery.com/jQuery.getJSON/
		$.getJSON(action, function(data) {
			// limpia la lista
			$('#respuesta').find("li").each(function(){ $(this).remove(); });
			  
			  $.each(data, function(key, prod) {
				$('#respuesta').append("<li>"+prod.idproducto+", "+prod.precio+", "+prod.nombre+"</li>");
			  });
		}).error(function(jqXHR, textStatus, errorThrown) { 
			$("#respuesta").html(jqXHR.responseText);
		});		
	}
</script>

<p>
	Aqui deberia aparecer la respuesta:
	<ul id='respuesta'></ul>
</p>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categorias',
	'selectableRows'=>1,
	'selectionChanged'=>'obtenerSeleccion',	// via 1: para mostrar detalles al seleccionar
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
						'click'=>'js:obtenerSeleccion',
					),
				),
        ),
    ),
));
?>

