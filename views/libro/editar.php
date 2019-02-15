<div class="container">
<div class="clearfix">
	<a class="btn btn-primary float-right mb-3" href="<?php echo URL_BASE?>/libro/mostrar">Volver</a>
</div>
<h2 class="mb-3 text-center">Editando Libro</h2>
<hr>
<form action="<?php echo URL_BASE;?>/libro/editar" method="post" enctype="multipart/form-data">
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Id Libro</label>
	      <input type="text" class="form-control" name="idlibro" value="<?php echo $libro->getIdlibro();?>">
	    </div>
	    <div class="form-group col-md-6">
	      <label>Titulo</label>
	      <input type="text" class="form-control" required name="titulo" value="<?php echo $libro->getTitulo();?>">
	    </div>		
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Genero</label>
	      <input type="text" class="form-control" name="genero" value="<?php echo $libro->getGenero();?>">
	    </div>
	    <div class="form-group col-md-6">
	      <label>Autor</label>
	      <input type="text" class="form-control" required name="autor" value="<?php echo $libro->getAutor();?>">
	    </div>		
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Contenido</label>
	      <textarea required name="contenido" class="form-control" cols="30" rows="5"><?php echo $libro->getContenido();?></textarea>
	    </div>
	  </div>
	  <?php if($libro->getFoto() != null):
	  $transformarABase64 = base64_encode($libro->getFoto());?>
		      <img src="data:image/png; base64,<?php echo $transformarABase64; ?>" class="col-md-4">
	  <?php endif;?><br>
	  <input type="file" name="foto" accept="image/*"><br><br>
	  <button type="submit" class="btn btn-primary" name="btneditar">Editar</button>
</form>
</div>