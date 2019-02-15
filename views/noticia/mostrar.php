<section class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
                  <?php if(isset($_SESSION["usuario"])):?>
                	<?php if($_SESSION["usuario"]->getRol()=="admin"):?>
                    	<div class="clearfix">
                           <a class="btn btn-primary float-right mb-3" href="<?php echo URL_BASE?>/noticia/insertar">Insertar Noticia</a>
                        </div>
                 	<?php endif;?>
                <?php endif;?>
                <?php
                foreach ($noticias as $noticia):
                ?>
                    <div class="post-preview border-bottom border-info mb-3">
                        <a href="<?php echo URL_BASE?>/noticia/ver/<?php echo $noticia->getIdnoticia()?>">
                          <h2 class="post-title">
                          	<?php echo $noticia->getTitulo();?></a>
                          </h2>
                                     
                        <p class="post-meta">Posteado el <?php echo $noticia->getFecha()?></p>
                        <?php if(isset($_SESSION["usuario"])):?>
                          		<?php if($_SESSION["usuario"]->getRol()=="admin"):?>
                          		<a href="<?php echo URL_BASE?>/noticia/borrar/<?php echo $noticia->getIdnoticia()?>"><button type="button" class="btn btn-outline-info col-md-2 mb-2"><img src="<?php echo URL_BASE?>/assets/img/borrar2.png" width="40%"></button></a>
								<a href="<?php echo URL_BASE?>/noticia/editar/<?php echo $noticia->getIdnoticia()?>"><button type="button" class="btn btn-outline-info col-md-2 mb-2"><img src="<?php echo URL_BASE?>/assets/img/editar2.png" width="40%"></button></a>
                          		<?php endif;?>
                          	<?php endif;?> 
                      </div>
                <?php endforeach?>      
          <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Otros post &rarr;</a>
          </div>
        </div>
      </div>
    </section>