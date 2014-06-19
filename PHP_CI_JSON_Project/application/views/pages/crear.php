	<div id="contenido">
<h2>Create a news item</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('create') ?>
<label for="fecha">Fecha</label>
<input type="text" name="fecha" /><br />
<label for="horario">Horario</label>
<input type="text" name="horario" /><br />
<label for="lugar">Lugar</label>
<input type="text" name="lugar" /><br />
<label for="localidad">Localidad</label>
<input type="text" name="localidad" /><br />
<label for="donacion">Donacion</label>
<input type="text" name="donacion" /><br />

<input type="submit" name="submit" value="Crear ítem de noticias" />
</form>
</div>