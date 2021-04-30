 <!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Cadastro</h1>

	<?php if($msg): ?>
	<div class="p-3 my-3 alert-info">
		<?= $msg ?>
	</div>
	<?php endif;
	$idcadastro = isset($cadastro)?$cadastro['idcadastro']:$idcadastro; ?>	

	<div class="p-3 my-3 text-danger">
		<?= \Config\Services::validation()->listErrors(); ?>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 style="float:left" class="m-0 font-weight-bold text-primary"><?=$subtitulo?></h6>
					<?php if(isset($idcadastro)):?>
					    <div class="botoes">
							<a href="<?= base_url('controle/redesocial/index/'.$idcadastro.'/'.$idcategoria)?>" class="btn-voltar btn"  
							> << Voltar</a>
							<a  href="<?= base_url('controle/release/')?>" class="btn-avanca btn ">Próxima tela</a>
						</div>
					<?php endif ?>
				</div>
				<div class="card-body">
					<form action="<?= base_url('controle/agenda/gravar') ?>" method="post">

						<div class="form-row">
							
							<label style="margin-top:0.3em;margin-left:0.3em;margin-right:1em" for="dtagenda">Data</label>
							<input style ="width:10em" class="form-control" type="date" name="dtagenda" value="<?=isset($cadastro)?$cadastro['dtagenda']:''?>" required/>

							<label style="margin-top:0.3em;margin-left:2em;margin-right:1em" for="hora">Horário</label>
							<input style ="width:6em" class="form-control" type="time" name="hora" value="<?=isset($cadastro)?$cadastro['hora']:''?>"/>
						</div>
						<div class="form-group">
							<label for="local">Local</label>
							<input class="form-control" type="text" name="local" value="<?=isset($cadastro)?$cadastro['local']:''?>"/>
						</div>
						<input type="hidden" name="idagenda" value="<?=isset($cadastro)?$cadastro['idagenda']:''?>"/>
						<input type="hidden" name="idcadastro" value="<?=$idcadastro?>"/>
						<?= csrf_field(); ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Registros na Agenda</h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
						<thead>
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Descrição</th>
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Excluir</th>
							</tr>
						</thead>
						<tbody>
						<?php if($cadastros != null) foreach($cadastros as $d):
							$agenda = date('d-m-Y', strtotime($d['dtagenda'])).' - '.$d['hora'].' - '.$d['local'];?>	
							<tr role="row" class="odd">
								<td class="sorting_1"><a href="/controle/agenda/editar/<?=$d['idagenda']?>"><?=$agenda?></a></td>
								<td><a href="/controle/agenda/excluir/<?=$d['idagenda'].'/'.$d['idcadastro']?>" onclick="return confirm('Confirma exclusão da agenda <?=$agenda?>?');"><i class="fas fa-trash"></i> Excluir</a></td>
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