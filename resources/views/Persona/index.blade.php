<!DOCTYPE html>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Persona</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<center>
		<h1>CRUD PRUEBA</h1>
	</center>
	<hr>
	<center>
	<h3>Crear usuario</h3>
		<div class="container-fluid">
		{{Form::open(['id'=>'registrodatos'])}}
		<div class="form-group">
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre'])!!}
		</div>
		<div class="form-group">
		{!!Form::text('apellido_p',null,['class'=>'form-control','placeholder'=>'Apellido Paterno'])!!}
		</div>
		<div class="form-group">
		{!!Form::text('apellido_m',null,['class'=>'form-control','placeholder'=>'Apellido Materno'])!!}
		</div>
		<div class="form-group">
			{!!link_to('#',$title='Guardar',$atributes=['id'=>'guardar','class'=>'btn btn-primary','data-role'=>'button'],$secure=null)!!}
		</div>
		{{Form::close()}}
		</div>
	</center>
	<hr>
	<center><h3>Datos</h3></center>
	<div id="datos"></div>
	<hr>

<!-- Modal -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        {{Form::open(['id'=>'formularipupdate'])}}
		<div class="form-group">
        <input type="hidden" id="idpersona" ><!-- id del usuario -->
		{!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre'])!!}
		</div>
		<div class="form-group">
		{!!Form::text('apellido_p',null,['id'=>'apellido_p','class'=>'form-control','placeholder'=>'Apellido Paterno'])!!}
		</div>
		<div class="form-group">
		{!!Form::text('apellido_m',null,['id'=>'apellido_m','class'=>'form-control','placeholder'=>'Apellido Materno'])!!}
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		{!!link_to('#',$title='Update',$atributes=['id'=>'actualizar','class'=>'btn btn-primary','data-role'=>'button'],$secure=null)!!}
		{{Form::close()}}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/js/jquery-3.2.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function(){
		Cargar();
	})

/*
	fucntion cargar
 */
function Cargar()
{
	$.ajax({
		type:'get',
		url:'{{ url('lista')}}',
		success:function(data)
		{
			$("#datos").empty().html(data);
		}
	});
}

/*
 *	Registro de datos
 */

$("#guardar").click(function(event)
{
	$.ajax({
		url:"{{route('persona.store')}}",
		type:'post',
		dataType:'json',
		data:$("#registrodatos :input[value!='']").serialize(),
		success:function(data)
		{
			if(data.success=='true')
			{
				Cargar();
				$("#registrodatos")[0].reset();
			}
			else
			{
				console.log("error");
			}
		}
	});
});
/*
 *	Cargar datos en modal
 */

var Mostrar=function(id)
{
	var ruta="{{url('persona')}}/"+id+"/edit";

	$.get(ruta, function(data){
		$("#idpersona").val(data.PER_id);
		$("#nombre").val(data.PER_nombre);
		$("#apellido_p").val(data.PER_apellido_p);
		$("#apellido_m").val(data.PER_apellido_m);
	});
}

/*
 *	actualizar
 */

$("#actualizar").click(function(){
	var idper=$("#idpersona").val();
	var tokens=$("input[name='_token']").val();
	var ruta="persona/"+idper+"";
	
	$.ajax({
		url:ruta,
		headers:{'X-CSRF-TOKEN':tokens},
		type:'PUT',
		dataType:'json',
		data:$("#formularipupdate :input[value!='']").serialize(),
		success:function(data)
		{
			if(data.success=='true') 
            {
                // $("#update").modal('toggle');
            	console.log("yes");
				$("#formularipupdate")[0].reset();
                $("#update").modal('toggle');
                Cargar();         
            }
            else
            {
            	console.log("error");
            }
		}

	});
});

/*
 * Delete
 */

var Eliminar=function(id)
{
	var tokens=$("input[name='_token']").val();
	var ruta="{{url('persona')}}/"+id+"";

	$.ajax({
		url:ruta,
		headers:{'X-CSRF-TOKEN':tokens},
		type:'DELETE',
		dataType:'json',
		success:function(data)
		{
			if(data.success=='true')
			{
               Cargar();  
               console.log("yes delete");       
			}
			else
			{
				console.log("no delete");
			}
		}
	});
}
</script>
</body>
</html>
