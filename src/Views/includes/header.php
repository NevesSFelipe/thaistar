<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FSN | Thaistar - Sistema de Estética</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>

    <?php if (isset($ultimoAcesso)) : ?>

        <!-- Navbar - Logado -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="login-funcionario">Thaistar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item mt-1">
                            <a class="nav-link active text-light" href="#">
                                <i class="bi bi-clock-history me-1"></i>Horários
                            </a>
                        </li>

                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link active text-light" href="deslogar-funcionario" title="Sair do sistema">
                                <i class="bi bi-power" style="font-size: 1.4rem;"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

    <?php else : ?>

        <!-- Navbar - Visitante -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <div class="container">
            
                <a class="navbar-brand" href="login-funcionario">Thaistar</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item mt-1">
                            <a class="nav-link active" href="#">Início</a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="#">Serviços</a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="#">Contato</a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="#">Login</a>
                        </li>

                        <li class="nav-item d-flex align-items-center">
                            <a href="login-funcionario" class="nav-link" title="Acesso Administrativo">
                                <i class="bi bi-person-fill" style="font-size: 1.5rem; color: #0d6efd;"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

    <?php endif; ?>