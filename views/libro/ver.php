<section class="container">
      <div class="row text-center">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php if($fila->getFoto() != null):
          $transformarABase64 = base64_encode($fila->getFoto());?>
          <img src="data:image/png; base64,<?php echo $transformarABase64; ?>" width="30%"">
          <?php endif;?>
          <h2 class="post-title mt-3">
            <?php echo $fila->getTitulo()?>
          </h2>
          <p><?php echo $fila->getContenido()?></p>
          <hr>
          <div class="clearfix">
            <a class="btn btn-primary float-right" href="<?php echo URL_BASE?>/libro/mostrar">Volver</a>
          </div>
        </div>
      </div>
      <h2 class="border-bottom border-info mt-4">Comentarios</h2>
      <?php foreach($comentarios as $comentario):?>
      	<div class="row border border-info mb-4 p-3 comentarios">
      		<h5 class="nombrecomentario col-md-1"><?php echo $comentario->getNombreusuario();?></h5><br>
      		<p class="col-md-10"><?php echo $comentario->getContenido();?></p>
      		<?php if(isset($_SESSION["usuario"])):?>
      		<?php if($comentario->getIdusuario() == $_SESSION["usuario"]->getIdusuario()):?>
      			<a href="<?php echo URL_BASE?>/comentario/borrarComentarioLibro/<?php echo $comentario->getIdcomentario()?>" class="col-md-1"><img src="<?php echo URL_BASE?>/assets/img/borrarcomentario.png" width="40%"></a>
      		<?php endif;?>
      		<?php endif;?>
      	</div>
      <?php endforeach;?>
      <?php if(isset($_SESSION["usuario"])):?>
      <hr>
      <form action="<?php echo URL_BASE;?>/comentario/insertarComentarioLibro/<?php echo $fila->getIdlibro();?>" method="post">
    	  <div class="form-row">
    	    <div class="form-group col-md-6">
    	      <label>Comentario</label>
    	      <textarea name="contenido" class="form-control" cols="30" rows="5"></textarea>
    	    </div>
    	  </div>
    	  <button type="submit" class="btn btn-primary" name="btninsertar">Comentar</button>
    </form>
    <?php else:?>
    <h4 class="text-center">Debes estar registrado para comentar</h4>
    <?php endif;?>
    </section>

    <hr>