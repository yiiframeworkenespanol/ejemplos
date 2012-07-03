<?php 
/**	Clase para manejar asuntos relativos a los demos.

	usada generalmente para que los demos apunten a una base de datos propia en sqlite,
	
	ejemplo de uso:
	
	DemoSetup::usar('demo1');

	@author: Christian Salazar H. <christiansalazarh@gmail.com> @bluyell
*/
class DemoSetup extends CApplicationComponent {
	/*	@stringDbname:	nombre de la base de datos de SqLite previamente creada y configurada.
		usage:	DemoSetup::usar('demo1');
		@author: Christian Salazar H. <christiansalazarh@gmail.com> @bluyell
	*/
	public static function usar($stringDbname){
		Yii::app()->db->active=false;		
		Yii::app()->db->connectionString = 'sqlite:protected/data/'.$stringDbname.'.db';
		Yii::app()->db->active=true;
	}
	
	public function init(){
		Yii::log("iniciando demos...");
		$modulos = scandir("protected/modules");
		$arr = array();
		foreach($modulos as $f){
			if(($f != '.') && ($f != '..')){
				Yii::log("DEMO: ".$f);
				$arr[] = $f;
			}
		}
		Yii::app()->modules = $arr;
	}
}