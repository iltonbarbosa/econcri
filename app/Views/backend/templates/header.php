
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('controle/')?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Versão <sup>1.0.0</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('controle/')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tela inicial</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Sistema
      </div>

      <!-- Nav Item - Tables -->
	  <?php if(session()->get('perfil') == 1):?> 
			<li class="nav-item">
				<a class="nav-link" href="/controle/Categorias">
					<i class="fas fa-fw fa-list"></i>
				<span>Categorias</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/cadastro/locaisPraTocar">
				<i class="fas fa-fw fa-users"></i>
				<span>Locais pra tocar</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/controle/Usuarios">
					<i class="fas fa-fw fa-users"></i>
				<span>Usuários</span></a>
			</li>
	  <?php endif; ?>	
	  <li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
		<i class="fas fa-fw fa-cog"></i>
		<span>Cadastros</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item" href="/controle/OqueCadastrar/">Novo</a>
			<?php if(session()->get('perfil') == 1):?> 
				<a class="collapse-item" href="/controle/Cadastro/listar">Listar</a>
			<?php endif ?>
			<?php if(session()->get('perfil') == 2):?> 
				<a class="collapse-item" href="/controle/Cadastro/listar/">Listar</a>
			<?php endif ?>
		</div>
		</div>
	  </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
	 <!-- Content Wrapper -->
	 <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

	<!-- Sidebar Toggle (Topbar) -->
	<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
	  <i class="fa fa-bars"></i>
	</button>

	<!-- Topbar Navbar -->
	<ul class="navbar-nav ml-auto">

	  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
	  <li class="nav-item dropdown no-arrow d-sm-none">
		<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  <i class="fas fa-search fa-fw"></i>
		</a>
		<!-- Dropdown - Messages -->
		<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
		  <form class="form-inline mr-auto w-100 navbar-search" id="pesquisaPalavra" action="<?= base_url('controle/Cadastro/buscaPorPalavra') ?>" method="post">
			<div class="input-group">
			  <input type="text" name="palavra" minlength="4" maxlength="20" class="form-control bg-light border-0 small" placeholder="Pesquise por uma palavra-chave..." aria-label="Search" aria-describedby="basic-addon2">
			  <div class="input-group-append">
			  	<?= csrf_field(); ?>
				<button class="btn btn-primary" type="button" onclick="document.getElementById('pesquisaPalavra').submit()">
				  <i class="fas fa-search fa-sm"></i>
				</button>
			  </div>
			</div>
		  </form>
		</div>
	  </li>
	  <?php if($title == 'Mapa'):?>
		<div>
			<span style="color:red">Clique na bolinha vermelha e arraste para a melhor posição que indique a localização deste cadastro no mapa. Em seguida, clique no botão <strong>"Confirmar"</strong> que será exibido na parte inferior esquerda da tela.</span>
			<a style="margin-left:5em" href="<?= base_url('controle/Release/')?>" class="btn-voltar btn"> << Voltar</a>
		</div>
	  <?php endif ?>
	 
	  <div class="topbar-divider d-none d-sm-block"></div>

	  <!-- Nav Item - User Information -->
	  <li class="nav-item dropdown no-arrow">
		<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('user')?></span>
		 <img class="bi bi-power" src="/img/power.svg">
		</a>
		<!-- Dropdown - User Information -->
		<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
		  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
			<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
			Sair do sistema
		  </a>
		</div>
	  </li>

	</ul>

  </nav>
  <!-- End of Topbar -->