<div id="contenido">
<form ACTION="cita" METHOD="post" ENCTYPE="multipart/form-data">
	<label>Elija una fecha:</label><br/>
	<select name="fecha">
		<option value="-1">Seleccione una fecha</option>
		<?php
		/*Para indicar las fechas, ya que se repiten no nos vale con volvarlas, sino que ademas debemos filtrarlas, 
		 * para ello le indicamos que tienen que ser superiores o iguales a la fecha actual y además, que no sean 
		 * iguales a la anterior para que no se repitan, de esta forma se escribe la fecha la primera vez, pero no las posteriores
		 * */
			for ($i=0;$i<count($obj["colectas"]);$i++)
			{
				if ($obj["colectas"][$i]["fecha"] != $obj["colectas"][$i-1]["fecha"] && date('Y-m-d') <= $obj["colectas"][$i]["fecha"])
				{ 
					echo "<option value=".$obj["colectas"][$i]["fecha"];
					if ($fecha == $obj["colectas"][$i]["fecha"])
					{echo " selected";}
					echo ">".$obj["colectas"][$i]["fecha"]."</option>";
				}
			}
		?>
	</select><br/>
	<input type="submit" value="enviar"/><br/>
</form>
<?php 
if ($fecha != -1)
{/*Si se ha recibido una fecha, construimos la tabla con los lugares correspondientes*/
	echo "<table>";
	echo "<tr><th>Fecha</th><th>Localidad</th><th>Lugar</th><th>Horario</th><th>Tipo</th></tr>";
	for ($i=0;$i<count($obj["colectas"]);$i++)
	{
		if ($fecha == $obj["colectas"][$i]["fecha"])
		{
			echo "<tr>";
			echo "<td>".utf8_decode($obj["colectas"][$i]["fecha"])."</td>";
			echo "<td>".utf8_decode($obj["colectas"][$i]["localidad"])."</td>";
			echo "<td>".utf8_decode($obj["colectas"][$i]["lugar"])."</td>";
			echo "<td>".utf8_decode($obj["colectas"][$i]["horario"])."</td>";
			echo "<td>".utf8_decode($obj["colectas"][$i]["donacion"])."</td>";
			echo "<td><a href='ficha/verFicha/".$i."'>Ver</a>";
			echo"</tr>";
		}
		
	}
	echo "</table>";
}
?>
</div>