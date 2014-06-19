	<div id="contenido">
<?php echo validation_errors(); ?>
<?php echo form_open('ficha/crear/'.$id) ?>
	<div id="ficha_izquierda">
		<input type="hidden" name="id" value="<?php echo $id;?>"/>
		<h2>Tipo de Donación:</h2>
		<input type="hidden" name="donacion" value="<?php echo $obj["donacion"];?>"/>
		<input type="text" disabled name="donacion2" value="<?php echo $obj["donacion"];?>"/><br/>
		<b>Fecha:</b><br/>
		<input type="hidden" name="fecha" value="<?php echo $obj["fecha"];?>"/>
		<input type="text" disabled name="fecha2" value="<?php echo $obj["fecha"];?>"/><br/>
		<b>Horario:</b><br/>
		<input type="hidden" name="horario" value="<?php echo $obj["horario"];?>"/>
		<input type="text" disabled name="horario2" value="<?php echo $obj["horario"];?>"/><br/>
		<b>Localidad:</b><br/>
		<input type="hidden" name="localidad" value="<?php echo $obj["localidad"];?>"/>
		<input type="text" disabled name="localidad2" value="<?php echo $obj["localidad"];?>"/><br/>
		<b>Lugar:</b><br/>
		<input type="hidden" name="lugar" value="<?php echo $obj["lugar"];?>"/>
		<input type="text" disabled name="lugar2" value="<?php echo $obj["lugar"];?>"/><br/><br/>
	</div>
	<div id="ficha_derecha">
		<h3>Ubicación:</h3>
		<?php echo $map['mapdiv'];?>
	</div>
	<input type="submit" name="submit" value="Pedir citas" id="enviar"/><br/>
</form>
	</div>