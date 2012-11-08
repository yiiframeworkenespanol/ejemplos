var Dialogo1 = function(options) {

	// una funcion ajax bien probada y que ayuda:
	//
	var ajaxcmd = function(action,postdata,callback){
		var result=false;
		var dateObject = new Date();
		var nocache = dateObject.getTime();
		jQuery.ajax({
			url: action+"&nocache="+nocache,
			type: 'post',
			async: false,
			contentType: "application/json",
			data: postdata,
			success: function(data, textStatus, jqXHR){
				result = data;
				if(callback != null)
					callback(true, data);
			},
			error: function(jqXHR, textStatus, errorThrown){
				callback(false, jqXHR.responseText);
				return false;
			},
		});
		return result;
	}

	$("#"+options.idlanzador).click(function(){
		var dialogo1 = $("#"+options.iddialogo); // el #ID de mas abajo..
		var form = $("#"+options.iddialogo+"_form");

		// agregamos un helper getter y setter para facilitar mas abajo
		// el acceso a campos segun su atributo "name" y no por su ID.
		form.setField = function(name,value) {
			$(this).find("[name|='"+name+"']").val(value);
		}
		form.getField = function(name) {
			return $(this).find("[name|='"+name+"']").val();
		}

		// el controlador de validacion jQuery:
		//
		//  cuidado con la funcion de validacion alphastrict, la puse yo
		//  y no viene por defecto, esta valida asi:
		//		/^[A-Za-z0-9]+$/
		//

		form.validate({
			rules: {
				cedula: { required: true , digits: true },
				nombre: { required: true , alphastrict: true},
				apellido: { required: false, alphastrict: true}
			},
			messages: {
				cedula: "Cedula es Requerida, solo digitos",
				nombre: "Nombre es requerido solo letras o numeros",
				apellido: "Apellido debe tener solo letras o numeros"
			},
			submitHandler: function(){
				var objeto = {
					cedula: form.getField('cedula'),
					nombre: form.getField('nombre'),
					apellido: form.getField('apellido'),
				};
				// alert(JSON.stringify(objeto));
				//	esta linea (alert) podrias probarla y emitirá algo como:
				//  {"cedula":"123","nombre":"asasas123","apellido":"asasa"}

				// en cambio, la lanzamos a un action:
				ajaxcmd(options.action,objeto, function(ok,errtxt){
					if(ok == true){
						$('#'+options.logid).html("DATOS ENVIADOS !");
						setTimeout(function(){ dialogo1.dialog('close'); }
							,1000);
					}
					else{
						$('#'+options.logid).html(errtxt);
					}
				});
			}
		}); // end form.validate


		// el controlador del dialogo:
		//
		var opcionesDelDialogo = {
			autoOpen: false,
			resizable: false,
			title: "Mi Dialogo",
			width: "auto", // podria ser: "300px"
			buttons: {
					"Ok": {
						text: "Crear Persona",
						click: function(){
							// esto dispara la validacion:
							//
							form.submit();
						}
					},//OK
					"Cancel": {
						text: "Cancelar",
						click: function(){
							dialogo1.dialog('close');
						}
					},//OK
				},
			close:function(){
				// llamado cuando se cierra el dialogo
			},
			open:function(){
				// inicializa el dialogo
				// si quisieras inicializar el dialogo
				// con datos existentes solo tienes que poner
				// aqui el codigo necesario:
			
				// por ejemplo, podrias consultar via ajax
				// a un action aqui mismo para obtener un JSON
				// con los datos del usuario
/*
				$.getJSON('algun action aqui', function(usuario) {
					siendo 'usuario' un objeto json
					el cual fue construido en el action
					y el cual podria usarse asi:
					form.setField('cedula',usuario.cedula);
				});
*/	
				form.setField('cedula','123456');
				form.setField('nombre','juan');
				form.setField('apellido','perez');
			}
		};
		dialogo1.dialog(opcionesDelDialogo);
		dialogo1.dialog('open');
	});

};
