<div class="container">
<div class="clearfix">
	<a class="btn btn-primary float-right mb-3" href="<?php echo URL_BASE?>/noticia/index">Volver</a>
</div>
<h2 class="mb-3 text-center">Editando Noticia</h2>
<hr>
<form action="<?php echo URL_BASE;?>/noticia/editar" method="post" enctype="multipart/form-data">
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Id Noticia</label>
	      <input type="text" class="form-control" name="idnoticia" value="<?php echo $noticia->getIdnoticia();?>">
	    </div>
	    <div class="form-group col-md-6">
	      <label>Titulo</label>
	      <input type="text" class="form-control" required name="titulo" value="<?php echo $noticia->getTitulo();?>">
	    </div>		
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Contenido</label>
	      <textarea required name="contenido" class="form-control" cols="30" rows="5"><?php echo $noticia->getContenido();?></textarea>
	    </div>
	    <div class="form-group col-md-6">
	      <label>Fecha</label>
	      <input type="date" class="form-control" required name="fecha" value="<?php echo $noticia->getFecha();?>">
	    </div>
	  </div>
	  <?php if($noticia->getFoto() != null):
	  $transformarABase64 = base64_encode($noticia->getFoto());?>
		      <img src="data:image/png; base64,<?php echo $transformarABase64; ?>">
	  <?php endif;?>
	  <input type="file" name="foto" accept="image/*" required><br><br>
	  <button type="submit" class="btn btn-primary" name="btneditar">Editar</button>
</form>
</div>