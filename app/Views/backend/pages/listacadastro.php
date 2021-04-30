 <!-- Begin Page Content -->
<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">Categorias</h1>

	<div class="p-3 my-3 text-danger">
		<?= \Config\Services::validation()->listErrors(); ?>
	</div>

	<div class="row">
	
		<div class="col-md-6">
		  	<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Lista de cadastros efetuados</h6>
                </div>
                <div class="card-body">
                  	<table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
						<thead>
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nome</th>
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Cidade</th>
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Categoria</th>
							</tr>
						</thead>
						<tbody>
				 			<?php if($cadastros) foreach($cadastros as $c):?>	
								<tr role="row" class="odd">
									<td><a href="/controle/cadastro/editar/<?=$c['idcadastro'].'/'.$c['idcategoria']?>"><i class="fas fa-edit"></i><?=$c['nome']?></a></td>
									<td class="sorting_1"><?=$c['cidade']?></td>
									<td class="sorting_1"><?=$c['descricao']?></td>
								</tr>
					  		<?php endforeach; ?>
               	 		</tbody>
                	</table>
				
                </div>
          </div>
		</div>
  	</div>
</div>
        <!-- /.container-fluid -->