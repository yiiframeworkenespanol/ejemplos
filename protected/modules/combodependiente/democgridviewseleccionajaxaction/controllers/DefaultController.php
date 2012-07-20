<?php
class DefaultController extends Controller
{
	private function selectdb(){
		DemoSetup::usar("democgridviewseleccionajaxaction");
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
		
		$dataProviderProductos=new CActiveDataProvider(Producto::model(), array(
			'keyAttribute'=>'idproducto',
			'criteria'=>array(
				'condition'=>'idcategoria=-1',
			),
		));
		
		if(Yii::app()->request->isAjaxRequest){
			// el update del CGridView Productos hecho en Ajax produce un ajaxRequest sobre el mismo
			// action que lo invoco por primera vez y el argumento fue pasado mediante {data: xxx} al // momento de hacer el update al CGridView con id 'productos'
			$idcategoria = $_GET[0]; 
			Yii::log("\nAJAX_REQUEST\nPROVOCADO_POR_EL_UPDATE_AL_CGRIDVIEW_PRODUCTOS"
				."\nidcategoria seleccionada es=".$idcategoria
			,"info");
			// actualizas el criteria del data provider para ajustarlo a lo que se pide:
			$dataProviderProductos->criteria = array('condition'=>'idcategoria='.$idcategoria);
			// para responderle al request ajax debes hacer un ECHO con el JSON del dataprovider
			echo CJSON::encode($dataProviderProductos);
		}
		
		/* creacion del dataProvider
		
		*/
		$dataProvider=new CActiveDataProvider(Categoria::model(), array(
			'keyAttribute'=>'idcategoria',// IMPORTANTE, para que el CGridView conozca la seleccion
			'criteria'=>array(
				//'condition'=>'cualquier condicion where de tu sql iria aqui',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
			'sort'=>array(
				'defaultOrder'=>array('nombre'=>true),
			),
		));
	
		$this->render('index',array('dataProvider'=>$dataProvider
			,'dataProviderProductos'=>$dataProviderProductos));
	}
	
	
	public function actionObtenerProductos($idcategoria){
		$this->selectdb();
		$resp = Producto::model()->findAllByAttributes(array('idcategoria'=>$idcategoria));
		header("Content-type: application/json");
		echo CJSON::encode($resp);
	}
	
}