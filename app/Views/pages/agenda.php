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
						<a href="<?= base_url('RedeSocial/lista/'.$idcadastro.'/'.$idcategoria)?>" class="btn-voltar btn"  
						> << Voltar</a>
						<a href="<?= base_url('Release/index/'.$idcadastro)?>" class="btn-avanca btn">Próxima tela >></a>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
						<tbody>
							<?php if($cadastros != null) foreach($cadastros as $d):
								$agenda = "<strong>Data</strong>: ".date('d/m/Y', strtotime($d['dtagenda'])).' - <strong>Hora</strong>: '.$d['hora']." - <strong>Local</strong>: ".$d['local'];?>	
								<tr role="row" class="odd">
									<td class="sorting_1"><?=$agenda?></td>
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