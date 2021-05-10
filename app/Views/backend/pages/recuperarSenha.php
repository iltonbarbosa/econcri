<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Recuperar Senha!</h1>
					<?php if(isset($msg)): ?>
					<div class="p-3 my-3 alert-info">
						<?= $msg ?>
					</div>
					<?php endif;?>
                  </div>
                  <form action="<?= base_url('login/enviaEmailRecSenha') ?>" method="post">

                    <div class="form-group">
                      <label for="user">Informe seu E-mail para envio do link de recuperação de senha</label>
                        <input class="form-control" type="email" name="email" required/>
                    </div>
                      <?= csrf_field(); ?>

                      <input type="submit" name="submit" class="btn btn-primary" value="Enviar link" />
					  <a style="margin-left:1em" href="<?= base_url('controle/login/')?>" class="btn btn-primary">Cancelar</a>	
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  </body>