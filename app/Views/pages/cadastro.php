<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Usuário</h1>

	<?php if($msg): ?>
	<div class="p-3 my-3 alert-info">
		<?= $msg ?>
	</div>
	<?php endif;?>

	<div class="p-3 my-3 text-danger">
		<?= \Config\Services::validation()->listErrors(); ?>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"><?=$subtitulo?> Usuário</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('cadastro/gravar') ?>" method="post">

						<div class="form-group">
							<label for="nome">Nome</label>
							<input class="form-control" type="input" name="nome" value="<?=isset($usuario)?$usuario['nome']:''?>"/>
						</div>

						<div class="form-group">
							<label for="nome">E-mail</label>
							<input class="form-control" type="email" name="email" value="<?=isset($usuario)?$usuario['email']:''?>"/>
						</div>
						<?php if($subtitulo !='Editar'):?>
							<div class="form-group">
								<label for="senha">Senha</label>
								<input class="form-control" type="password" name="senha"/>
							</div>
							<div class="form-group">
								<label for="confirmasenha">Repita a Senha</label>
								<input class="form-control" type="password" name="confirmasenha"/>
							</div>
						<?php endif ?>	

						<input type="hidden" name="id" value="<?=isset($usuario)?$usuario['idusuario']:''?>"/>
						<?= csrf_field(); ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->