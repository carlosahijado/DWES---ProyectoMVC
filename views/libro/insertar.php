<div class="container">
<form action="<?php echo URL_BASE;?>/libro/insertar" method="post" enctype="multipart/form-data">
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Titulo</label>
	      <input type="text" class="form-control" required placeholder="Titulo" name="titulo">
	    </div>
		<div class="form-group col-md-6">
	      <label>Genero</label>
	      <input type="text" class="form-control" required placeholder="Genero" name="genero">
	    </div>
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Autor</label>
	      <input type="text" class="form-control" required name="autor">
	    </div>
	    <div class="form-group col-md-6">
	      <label>Contenido</label>
	      <textarea required name="contenido" class="form-control" cols="30" rows="5"></textarea>
	    </div>
	  </div>
	  <input type="file" name="foto" accept="image/*" ><br><br>
	  <button type="submit" class="btn btn-primary" name="btninsertar">Insertar</button>
</form>
</div>