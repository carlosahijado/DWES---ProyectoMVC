<?php
use models\LibroModel;
?>
<section class="container">
	<?php if(isset($_SESSION["usuario"])):?>
    	<?php if($_SESSION["usuario"]->getRol()=="admin"):?>
        	<div class="clearfix">
               <a class="btn btn-primary float-right" href="<?php echo URL_BASE?>/libro/insertar">Insertar Libro</a>
            </div>
     	<?php endif;?>
    <?php endif;?>
      <div class="row">
        <div class="col-md-4">
          <div class="wrapper">
            <nav id="sidebar">
              <div class="sidebar-header">
                <h3>Elige el Género</h3>
              </div>
              <ul class="list-unstyled components">
                <?php $lm = new LibroModel();
                      $generos=$lm->genero();
                      foreach ($generos as $genero):?>
                    <li>
                      <a href="<?php echo URL_BASE?>/libro/genero/<?php echo $genero?>"><?php echo $genero?></a>
                    </li>
                    <?php endforeach;?>
              </ul>
            </nav>
          </div>
        </div>
		<div class="col-md-8">
		<div class="row">
        <?php foreach($libros as $libro):?>   	
                <div class="col-md-3 mr-5 mt-5 border-bottom border-primary" style="width: 18rem;">
                  <?php if($libro->getFoto() != null):
                  $transformarABase64 = base64_encode($libro->getFoto());?>
                  <a href="<?php echo URL_BASE?>/libro/ver/<?php echo $libro->getIdlibro();?>"><img class="card-img-top" src="data:image/png; base64,<?php echo $transformarABase64; ?>">
                  <?php endif;?>
                  <div class="mt-3">
                    <h6><?php echo $libro->getTitulo()?></h6></a>
                    <?php if(isset($_SESSION["usuario"])):?>
                          	<?php if($_SESSION["usuario"]->getRol()=="admin"):?>
                          	<a href="<?php echo URL_BASE?>/libro/borrar/<?php echo $libro->getIdlibro()?>"><img src="<?php echo URL_BASE?>/assets/img/borrar2.png" width="20%" class="mb-3"></a>
                        	<a href="<?php echo URL_BASE?>/libro/editar/<?php echo $libro->getIdlibro()?>"><img src="<?php echo URL_BASE?>/assets/img/editar2.png" width="20%" class="mb-3"></a>
                        <?php endif;?>
                    <?php endif;?>
                  </div>
                </div>
            <?php endforeach;?>
            </div>
		</div>
    </section>