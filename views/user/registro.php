<div class="container">
<form action="<?php echo URL_BASE;?>/user/registro" method="post">
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Nombre</label>
	      <input type="text" class="form-control" required placeholder="Nombre" name="nombre">
	    </div>
		<div class="form-group col-md-6">
	      <label>Email</label>
	      <input type="email" class="form-control" required placeholder="correo@ejemplo.es" name="email">
	    </div>
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label>Contraseña</label>
	      <input type="password" class="form-control" required name="password">
	    </div>
	  </div>  
	  <button type="submit" class="btn btn-primary" name="btnregistro">Registrar</button>
</form>
</div>