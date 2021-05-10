 <!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Cadastro</h1>

	<div class="p-3 my-3 text-danger">
		<?= \Config\Services::validation()->listErrors(); ?>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"><?=$subtitulo?></h6>
					<div class="botoes">
						<a href="<?= base_url('Agenda/lista/'.$idcadastro.'/'.$idcategoria)?>" class="btn-voltar btn"  
						> << Voltar</a>
					</div>
				</div>
				<div class="card-body">
					<div class="form-row">
						<label for="release">Release resumido</label>
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
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Link de vídeos</h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
						<tbody>
							<?php if($linkVideos != null) foreach($linkVideos as $d):?>	
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