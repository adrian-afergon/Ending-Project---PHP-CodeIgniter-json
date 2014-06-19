<div id="contenido">
<?php echo validation_errors(); ?>
<?php echo form_open('administrar/crear') ?>
	<h2>Administrar:</h2>
	
	<label>Tipo de operación:</label><br/>
	<input type="radio" name="tipo" value="0">Añadir
	<input type="radio" name="tipo" value="1">Extraer
	<br/>
	<label>Litros de sangre:</label><br/>
	<input type="number" name="cantidad" min="1" max="5">
	<br/>
	<label>Descripcion:</label><br/>
	<textarea rows="4" cols="50" name="descripcion">
	</textarea><br/>
	
	<input type="hidden" value="<?php echo date('Y-m-d');?>" name="fecha"/>
	
	<input type="submit" name="submit" value="Realizar Transacción" />
</form>
</div>