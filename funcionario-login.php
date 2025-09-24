<?php require_once 'templates/headerLogout.php'; ?>

<link rel="stylesheet" href="assets/css/main.css" />

<div class="login-container mx-auto">

    <h3>Login</h3>

    <form id="formLogin">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" class="form-control" placeholder="Digite seu e-mail" required />
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" class="form-control" placeholder="Digite sua senha" required />
        </div>

        <button id="btnLoginFuncionario" type="button" class="btn btn-primary btn-block">Entrar</button>
    </form>

</div>

<script type="module" src="assets/js/funcionario-login.js"></script>

<?php require_once 'templates/footerLogout.php'; ?>
