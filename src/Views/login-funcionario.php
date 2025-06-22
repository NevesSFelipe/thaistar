<?php include_once __DIR__ . '/includes/header.php'; ?>

    <!-- <div class="container vh-100 d-flex justify-content-center align-items-start pt-5"> -->
    <div class="container d-flex justify-content-center align-items-start mt-5">


        <div class="row m-0 shadow rounded bg-white w-75 align-items-center">
            
            <!-- Coluna da Imagem -->
            <div class="col-md-6 p-0">
                <img src="assets/img/thaistar-login-admin.jpeg" alt="Imagem Login" class="img-fluid h-100 rounded-start" style="object-fit: cover;">
            </div>
            
            <!-- Coluna do Formulário -->
            <div class="col-md-6 p-5">
                <h2 class="mb-4 text-center texto-acesso-adm">Acesso Administrativo</h2>
                <form method="POST" action="autenticar-funcionario">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua senha" required>
                    </div>
                    <button type="submit" class="btn w-100 btnLogin">Entrar</button>

                    <?php if ( isset($msg) || isset($_GET['msg']) ): ?>
                        <div class="alert alert-warning mt-2 text-center"><?= $msg ?? $_GET['msg'] ?></div>
                    <?php endif; ?>

                </form>
            </div>

        </div>
    </div>



<?php include_once __DIR__ . '/includes/footer.php'; ?>