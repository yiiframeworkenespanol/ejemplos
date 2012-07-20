<h1>Combos Dependientes</h1>

<p>Este ejemplo muestra como usar dos dropDownList dependientes, uno conteniendo categorias
y el otro productos, entonces al seleccionar una categoria aparecen los productos asociados. 
El ejemplo se realizara usando parcialmente ajax y jquery debido al alto performance que da y a
la simplicidad del codigo.
</p>
<hr/>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<!-- 
	Seleccion de Categoria
-->
<p><span>Selecciona Categoria:</span>
<?php 
	echo CHtml::dropDownList(
		 'combo1',""
		,array('0'=>'-Por favor seleccione-')+CHtml::listData($categorias,'idcategoria','nombre')
		,array('id'=>'combo1')
	);
?></p>

<!-- 
	Producto Seleccionado.
-->
<div id='siguiente' style='display: none;'>
<p id='seleccion'></p>
<p><span>Selecciona Producto:</span>
<?php 
	echo CHtml::dropDownList(
		 'combo2',""
		,array()
		,array('id'=>'combo2')
	);
?></p>

<!-- 
	Boton de Pruebas
-->
<button id='botonseleccion'>Ver Producto Seleccionado</button>

</div>

<!-- 
	Area para mostrar errores
-->
<p id='reportarerror' style='color: red;'></p>

<script>
	// creamos un evento onchange para cuando el usuario cambie su seleccion
	// importante:  #combo1 hace referencia al ID indicado arriba con: array('id'=>'combo1')
	//
	$('#combo1').change(function(){
		var opcionSeleccionada = $(this);			// el <option> seleccionado
		var idcategoria = opcionSeleccionada.val();	// el "value" de ese <option> seleccionado
		
		if(idcategoria == 0) {
			$('#siguiente').hide('slow');
			return;
		}
		
		var action = 'index.php?r=/combodependiente/default/obtenerproductos&idcategoria='+idcategoria;

		// se pide al action la lista de productos de la categoria seleccionada
		//
		$('#reportarerror').html("");
		$.getJSON(action, function(listaJson) {
			//
			// el action devuelve los productos en su forma JSON, el iterador "$.each" los separará.
			//
			
			// limpiar el combo productos
			$('#combo2').find('option').each(function(){ $(this).remove(); });
			
			$.each(listaJson, function(key, producto) {
				//
				// "producto" es un objeto JSON que representa al modelo Producto
				// por tanto una llamada a: alert(producto.nombre) dira: "camisas"
				$('#combo2').append("<option value='"+producto.idproducto+"'>"
					+producto.nombre+"</option>");
			});
				
			$('#seleccion').html("Ok, ahora selecciona un producto:");
			$('#siguiente').show('slow');
		}).error(function(e){ $('#reportarerror').html(e.responseText); });		
	});
	
	// para que cuando le des click muestre la seleccion
	//
	$('#botonseleccion').click(function(){
		alert("idproducto es: "+$('#combo2').val());
	});
</script>

