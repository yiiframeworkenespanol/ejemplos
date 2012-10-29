<h1>Dialog Box</h1>

<p>Este ejemplo va a lanzar un dialog box usando jquery-ui. Luego, procederá
a validar el formulario del lado cliente usando un plugin de jquery para
validacion aunque igualmente las reglas de validacion de Persona.php van
a ser aplicadas.</p>

<p>En este caso de ejemplo, una regla de validacion server-side
impuesta por Persona.php a cual obliga a que el nombre no sea mayor que 3 letras
o digitos.</p>

<?php
	// 1. preparar los scripts de jQuery:
	$cs = Yii::app()->getClientScript();
	$cs->registerCoreScript('jquery');
	$cs->registerScriptFile($cs->getCoreScriptUrl()."/jui/js/jquery-ui.min.js");
	$cs->registerCssFile($cs->getCoreScriptUrl()."/jui/css/base/jquery-ui.css");
	// validator no lo trae Yii, asi que lo ponemos a mano en folder /JS/
	//
	// $cs->registerScriptFile("js/jquery-validate.js");
	// $cs->registerScriptFile("js/dialogo1.js");

	// voy a tomar los scripts de assets del modulo y los pasare a assets
	$localAssetsDir = __DIR__."/../../assets/";
	$assetsDir = Yii::app()->getAssetManager()->publish($localAssetsDir);
	$cs->registerScriptFile($assetsDir."/jquery-validate.js");
	$cs->registerScriptFile($assetsDir."/dialogo1.js");

?>

<p>Para probar el dialogo, haz click aqui:</p>
<?php
	// 2. un simple lanzador del dialogo
?>
<a id='lanzador' style='cursor: pointer;'>Nueva Persona</a>



<?php
	// 3. el codigo del lanzador
?>
<script>
	new Dialogo1(
	{
		idlanzador: "lanzador",
		iddialogo: "dialogo1",
		action: "index.php?r=/dialogbox/default/ajaxpersona",
		logid: "logger"
	}
);</script>


<?php // 4. el layout html del dialogo: ?>
<div id='dialogo1' class='form' style='display: none;'>
	<form id='dialogo1_form'>
		<div class="row">
			<label>Cédula: <span class='required'>*</span></label>
			<input type='text' name='cedula'>
		</div>
		<div class="row">
			<label class='requiered'>Nombre: <span class='required'>*</span></label>
			<input type='text' name='nombre'>
		</div>
		<div class="row">
			<label>Apellido:</label>
			<input type='text' name='apellido'>
		</div>
	</form>
	<div id='logger' style='overflow: hidden;'>...</div>
</div>
