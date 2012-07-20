<?php
class DefaultController extends Controller
{
	private function selectdb(){
		DemoSetup::usar("combodependiente");
	}

	/*
		Demo para implementar un maestro detalle usando Ajax Requests
	
		@author: Christian Salazar H. <christiansalazarh@gmail.com> @bluyell
	*/
	public function actionIndex()
	{
		// para efectos de DEMO es necesario apuntar la base de datos
		// al archivo demo1.db, para tu propio caso puedes eliminar estas lineas:
		$this->selectdb();
		
		$categorias = Categoria::model()->findAll();
	
		$this->render('index',array('categorias'=>$categorias));
	}
	
	
	public function actionObtenerProductos($idcategoria){
		$this->selectdb();
		$resp = Producto::model()->findAllByAttributes(array('idcategoria'=>$idcategoria));
		header("Content-type: application/json");
		echo CJSON::encode($resp);
	}
	
}