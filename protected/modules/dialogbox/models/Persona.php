<?php
class Persona extends CFormModel {
	public $nombre;		// string
	public $apellido;	// string
	public $cedula;		// integer

	public function rules(){
		return array(
			array('cedula, nombre','required'),
			array('nombre','length', 'max'=>3),
			array('apellido','safe'),
		);
	}

	public function attributeLabels(){
		return array(
			'cedula'=>'Cedula de Identidad',
			'nombre'=>'Nombre',
			'apellido'=>'Apellido',
		);
	}
}
