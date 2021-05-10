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
					<h6 class="m-0 font-weight-bold text-primary"><?=$subtitulo?></h6>
					<?php if(isset($idcadastro)):?>
					    <div class="botoes">
							<a href="<?= base_url('controle/Agenda/index/'.$idcadastro.'/'.$idcategoria)?>" class="btn-voltar btn"  
							> << Voltar</a>
							<a  href="<?= base_url('controle/MapaForm/')?>" class="btn-avanca btn ">Próxima tela</a>
						</div>
					<?php endif ?>
				</div>
				<div class="card-body">
					<form action="<?= base_url('controle/Release/gravar') ?>" method="post">

						<div class="form-row">
							<label for="release">Release</label>
							<textarea name="release" rows="7" class="form-control" 
							required><?=isset($cadastro)?$cadastro['release']:''?></textarea>
						</div>
						<div class="form-group">
							<label for="linkportfolio">Link do Portfolio</label>
							<input class="form-control" type="link" name="linkportfolio" value="<?=isset($cadastro)?$cadastro['linkportfolio']:''?>"/>
						</div>
						<div class="form-group">
							<label for="linkportfolio">Palavras-chave (para facilitar localiza-lo nas pesquisas)</label>
							<input class="form-control" type="palavraschave" name="palavraschave" value="<?=isset($cadastro)?$cadastro['palavraschave']:''?>"/>
						</div>
						<input type="hidden" name="idrelease" value="<?=isset($cadastro)?$cadastro['idrelease']:''?>"/>
						<input type="hidden" name="idcadastro" value="<?=$idcadastro?>"/>
						<?= csrf_field(); ?>
						<?php if(isset($cadastro)):?>
							<a style="margin-right:10em" href="<?= base_url('controle/Release/excluir/'.$cadastro['idrelease'])?>" class="btn btn-danger btn-primary"  
							onclick="return confirm('Deseja realmente apagar este release?')">Excluir</a>
						<?php endif ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Link de vídeos</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('controle/Release/gravarLink') ?>" method="post">	
						<div class="form-group">
							<label for="link">Adicionar link</label>
							<input class="form-control" type="link" name="link" value=""/>
						</div>
						<input type="hidden" name="idcadastro" value="<?=$idcadastro?>"/>
						<?= csrf_field(); ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
					</form>
					<table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
						<thead>
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Links</th>
								<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Excluir</th>
							</tr>
						</thead>
						<tbody>
						<?php if($linkVideos != null) foreach($linkVideos as $d):?>	
							<tr role="row" class="odd">
								<td class="sorting_1"><?=$d['link']?></td>
								<td><a href="/controle/Release/excluirLink/<?=$d['idlinkvideo'].'/'.$d['idcadastro']?>" onclick="return confirm('Confirma exclusão do link <?=$d['link']?>?');"><i class="fas fa-trash"></i> Excluir</a></td>
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