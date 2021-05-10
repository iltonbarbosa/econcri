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
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo de Volta!</h1>
                  </div>
                  <form action="login/entrar" method="post">

                    <div class="form-group">
                      <label for="user">E-mail</label>
                        <input class="form-control" type="email" name="email"/>
                    </div>
                      
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input class="form-control" type="password" name="senha"/>
                      </div>
                      <?= csrf_field(); ?>

                      <input type="submit" name="submit" class="btn btn-primary" value="Entrar" />
					  <a style="margin-left:1em" href="<?= base_url('/')?>" class="btn btn-primary">Cancelar</a>	
                  </form>
                  <hr>
				  <span><a href="login/recuperarsenha">Esqueci minha senha</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  </body>