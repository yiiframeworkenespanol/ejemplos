<?php
include 'protected/modules/dialogbox/models/Persona.php';

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// lo marco como "Ajax" para indicar que no es un action de uso generico
	// aunque la palabra "Ajax" no haga nada en especial.
	public function actionAjaxPersona(){
		$model = new Persona();
		if(Yii::app()->request->isAjaxRequest){
			$post = trim(file_get_contents('php://input'));
			//por ejemplo traeria: "cedula=123&nombre=aasas&apellido=aaa"
			// como lo sabemos ? simple: Yii::log("POST=".$post,"info");
			// ahora los pasamos a un array con forma key=>value
			// para que model->attributes los acepte:
			$attributes = array();
			foreach(explode("&",$post) as $item){
				$att = explode("=",$item);
				$attributes[$att[0]]=$att[1];
			}
			// listo hemos convertido el string post a un array indexado:
			// var_export($attributes,true) mostraria:
			//  array ( 'cedula' => '123', 'nombre' => 'aasas', 'apellido' => 'aaa', )
			$model->attributes = $attributes;
			if($model->validate()){
				// ok todo bien, haces algo aqui con el modelo...
				// como es un ejemplo no haremos nada mas que informar.
				return;
			}
			else{
				// si defined('YII_DEBUG') or define('YII_DEBUG',true);
				// es TRUE por defecto, ver /index.php
				// entonces la excepcion mostrara un codigo horrible,
				// pero si la ponemos en FALSE, entonces solo mostrara
				// el errorSummary, lo cual es deseable.
				throw new Exception(CHtml::errorSummary($model));
			}
		}
	}
}