<center>
<table class="table">
	<tr>
		<th>Nombre</th>
		<th>Apellido Materno</th>
		<th>Apellido Paterno</th>
		<th>Opciones</th>
	</tr>
	@foreach ($persona as $per)
	<tr>
		<td>{{$per->PER_nombre}}</td>
		<td>{{$per->PER_apellido_p}}</td>
		<td>{{$per->PER_apellido_m}}</td>
		<td>
			<button class="btn btn-danger" onclick="Eliminar({{$per->PER_id}});">Eliminar</button>
			<button class="btn btn-primary" onclick="Mostrar({{$per->PER_id}});" data-toggle='modal' data-target='#update'>Editar</button>

		</td>
	</tr>
	@endforeach
</table>
</center>