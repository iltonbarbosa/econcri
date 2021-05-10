 <!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Cadastro</h1>

	<div class="row">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"><?=$subtitulo?></h6>
					<div class="botoes">
						<a href="<?= base_url('/Cadastro/visualiza/'.$idcadastro.'/'.$idcategoria)?>" class="btn-voltar btn"  
						> << Voltar</a>
						<a href="<?= base_url('/Agenda/lista/'.$idcadastro)?>" class="btn-avanca btn">Próxima tela >></a>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
						<tbody>
						<?php if($cadastros != null) foreach($cadastros as $d):?>	
							<tr role="row" class="odd">
								<td class="sorting_1"><?=$d['link']?></td>
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