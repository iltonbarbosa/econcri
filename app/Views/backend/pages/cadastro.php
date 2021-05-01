 <!-- Begin Page Content -->
 <div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Cadastro</h1>

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
					<h6 style="float:left" class="m-0 font-weight-bold text-primary"><?=$subtitulo?></h6>
					<?php if(isset($cadastro)):?>
					    <div style = "float:right;">
							<a style="padding-top:0em;padding-bottom:0em;" href="<?= base_url('controle/redesocial/index/'.$cadastro['idcadastro'])?>"
							 class="btn btn-avanca" >Próxima tela</a>
						</div>
					<?php endif ?>
				</div>
				<div class="card-body">
					<form action="<?= base_url('controle/cadastro/gravar') ?>" method="post">

						<div class="form-group">
							<label for="nome">Nome</label>
							<input class="form-control" type="input" name="nome" value="<?=isset($cadastro)?$cadastro['nome']:''?>" required/>
						</div>
						<?php if((isset($cadastro) && $cadastro['idcategoria'] == 2) || session()->get('idcategoria') == 2):?>
							<div class="form-group">
								<label for="cnpj">Cnpj</label>
								<input class="form-control" type="input" name="cnpj" value="<?=isset($cadastro)?$cadastro['cnpj']:''?>"/>
								<input type="hidden" name="idempresa" value="<?=isset($cadastro)?$cadastro['idempresa']:''?>"/>
							</div>
						<?php endif ?>
						<div class="form-group">
							<label for="cidade">Cidade</label>
							<input class="form-control" type="input" name="cidade" value="<?=isset($cadastro)?$cadastro['cidade']:''?>" required/>
						</div>
		
						<?php if(isset($cadastro)) if($cadastro['idcategoria'] == 5 || $cadastro['idcategoria'] == 8 
								|| session()->get('idcategoria') == 5 || session()->get('idcategoria') == 8):?>
							<div class="form-group">
								<label for="estilo">Estilo</label>
								<input class="form-control" type="input" name="estilo" value="<?=isset($cadastro)?$cadastro['estilo']:''?>" required/>
							</div>

							<div className="input-block">
								<label For="autoral_cover">Autoral ou cover?</label>
								<div class="input-radio">
									<label style="margin-right:2em">
										<input type="radio" name="autoral_cover" value="1"
										<?php if(isset($cadastro) && $cadastro['autoral_cover'] == 1) echo 'checked';?>/> 
										<span>Autoral</span>
									</label>
								
									<label style="margin-right:2em">
										<input type="radio" name="autoral_cover" value="1"
										<?php if(isset($cadastro) && $cadastro['autoral_cover'] == 2) echo 'checked';?>/>  
										<span>Cover</span>
									</label>
								
									<label >
										<input type="radio" name="autoral_cover" value="3"
										<?php if(isset($cadastro) && $cadastro['autoral_cover'] == 3) echo 'checked';?>/> 
										<span>Ambos</span>
									</label>
								</div>
							</div>
							<?php if($cadastro['idcategoria'] == 5):?>
								<input type="hidden" name="idcantor" value="<?=isset($cadastro)?$cadastro['idcantor']:''?>"/>
							<?php endif ?>	
							<?php if($cadastro['idcategoria'] == 8):?>
								<div class="form-group">
									<label for="num_integrantes">Número de integrantes</label>
									<input class="form-control" type="number" name="num_integrantes" value="<?=isset($cadastro)?$cadastro['num_integrantes']:''?>"/>
								</div>
								<div class="form-group">
									<label for="nome_integrantes">Nome dos integrantes</label>
									<input class="form-control" type="text" name="nome_integrantes" value="<?=isset($cadastro)?$cadastro['nome_integrantes']:''?>"/>
								</div>
								<input type="hidden" name="idbanda" value="<?=isset($cadastro)?$cadastro['idbanda']:''?>"/>
							<?php endif ?>

						<?php endif ?>
						<div class="form-group">
							<label for="tempo_atuacao">Tempo de atuação</label>
							<input class="form-control" type="text" name="tempo_atuacao" value="<?=isset($cadastro)?$cadastro['tempo_atuacao']:''?>"/>
						</div>
						<div class="form-group">
							<label for="nome_contato">Nome da pessoa que é o contato principal</label>
							<input class="form-control" type="text" name="nome_contato" value="<?=isset($cadastro)?$cadastro['nome_contato']:''?>" required/>
						</div>
						<div class="form-group">
							<label for="telefone_contato">Telefone do contato principal</label>
							<input class="form-control" type="text" name="telefone_contato" value="<?=isset($cadastro)?$cadastro['telefone_contato']:''?>" required/>
						</div>
						<div class="form-group">
							<label for="email_contato">E-mail do contato principal</label>
							<input class="form-control" type="email" name="email_contato" value="<?=isset($cadastro)?$cadastro['email_contato']:''?>" required/>
						</div>
						<input type="hidden" name="idcategoria" value="<?=isset($cadastro)?$cadastro['idcategoria']:''?>"/>		
						<input type="hidden" name="idcadastro" value="<?=isset($cadastro)?$cadastro['idcadastro']:''?>"/>
						<?= csrf_field(); ?>
						<?php if(isset($cadastro)):?>
							<a style="margin-right:10em" href="<?= base_url('controle/cadastro/excluir/'.$cadastro['idcadastro'])?>" class="btn btn-danger btn-primary"  
							onclick="return confirm('Deseja realmente apagar este cadastro?')">Excluir</a>
						<?php endif ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->