 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Cadastro</h1>

	<?php if(isset($msg)): ?>
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
					<h6 class="m-0 font-weight-bold text-primary">O que cadastrar?</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('controle/OqueCadastrar/gravar') ?>" method="post">

						<div class="form-group">
							<label for="titulo">Categoria</label>
							<select class="form-control"  name="categoria">
								<option defaultValue="">Selecione...</option>
								<?php foreach ($categorias as $c):?>
									<option  value="<?=$c['idcategoria']."--".$c['descricao']?>"><?=$c['descricao'];?></option>);
								<?php endforeach ?>	
							</select>
						</div>
						
						<?= csrf_field(); ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Confirma" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->