<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php  echo site_url("Dashboard/index") ?>">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Modulo Contabilidad</div>
	</a>
	<!-- Divider -->
	<hr class="sidebar-divider my-0">
	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link" href="<?php  echo site_url("Dashboard/index") ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Inicio</span>
		</a>
	</li>
	<?php
	if (!empty($padres)){
		foreach ($padres as $p){
			if(isset($p->URL)){
	?>
	<li class="nav-item">
		<a class="nav-link" href="<?php  echo site_url($p->URL); ?>">
			<i class="fas fa-fw fa-arrow-right"></i>
			<span><?php echo $p->descripcion?></span>
		</a>
	</li>
	<?php
			}
			else{
	?>
			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				<?php echo $p->descripcion?>
			</div>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Seccion<?php echo $p->idOpcion?>" aria-expanded="true" aria-controls="collapseUtilities">
					<i class="fas fa-fw fa-arrow-right"></i>
					<span><?php echo $p->descripcion?></span>
				</a>
				<div id="Seccion<?php echo $p->idOpcion?>" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<?php
						if (!empty($hijos)){
							foreach ($hijos as $h){
								if($h->idPadre == $p->idOpcion){
									?>
									<h6 class="collapse-header"><?php echo $h->categoria?></h6>
									<a class="collapse-item" href="<?php echo site_url("$h->url") ?>"><?php echo $h->descripcion?></a>
									<?php
								}
							}
						}
						?>
					</div>
				</div>
			</li>
	<?php
			}
		}
	}
	?>
