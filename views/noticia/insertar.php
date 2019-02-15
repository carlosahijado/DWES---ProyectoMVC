<div class="container">
<h2 class="mb-3 text-center">Insertando Noticia</h2>
<hr>
<form action="<?php echo URL_BASE;?>/noticia/insertar" method="post" enctype="multipart/form-data">
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Titulo</label>
	      <input type="text" class="form-control" required placeholder="Titulo" name="titulo">
	    </div>
		<div class="form-group col-md-6">
	      <label>Fecha</label>
	      <input type="date" class="form-control" required name="fecha">
	    </div>
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Contenido</label>
	      <textarea required name="contenido" class="form-control" cols="30" rows="5"></textarea>
	    </div>
	  </div>
	  <input type="file" name="foto" accept="image/*" ><br><br>
	  <button type="submit" class="btn btn-primary" name="btninsertar">Insertar</button>
</form>
</div>