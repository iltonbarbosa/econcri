 <!-- Begin Page Content -->
<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">Categorias</h1>

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
                  <h6 class="m-0 font-weight-bold text-primary"><?=$subtitulo?> categoria</h6>
                </div>
                <div class="card-body">
					<form action="<?= base_url('controle/categorias/gravar') ?>" method="post">
						<div class="form-group">
							<label for="titulo">Descrição</label>
							<input class="form-control" type="input" name="descricao" value="<?=isset($categoria)?$categoria['descricao']:''?>"/>
						</div>
						
						<input type="hidden" name="id" value="<?=isset($categoria)?$categoria['idcategoria']:''?>"/>
						<?= csrf_field(); ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
					</form>
                </div>
          </div>
		</div>
		<div class="col-md-6">
		  	<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Categorias Cadastradas</h6>
                </div>
                <div class="card-body">
                  	<table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
						<thead>
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Categoria</th>
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alterar</th>
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Excluir</th>
							</tr>
						</thead>
						<tbody>
				 			<?php foreach($categorias as $c):?>	
								<tr role="row" class="odd">
									<td class="sorting_1"><?=$c['descricao']?></td>
									<td><a href="/controle/categorias/editar/<?=$c['idcategoria']?>"><i class="fas fa-edit"></i> Editar</a></td>
									<td><a href="/controle/categorias/excluir/<?=$c['idcategoria']?>" onclick="return confirm('Confirma exclusão da categoria <?=$c['descricao']?>?');"><i class="fas fa-trash"></i> Excluir</a></td>
								</tr>
					  		<?php endforeach; ?>
               	 		</tbody>
                	</table>
					<?= $pager->links(); ?>
                </div>
          </div>
		</div>
  	</div>
</div>
        <!-- /.container-fluid -->