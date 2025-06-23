<?php include_once __DIR__ . '/includes/header.php'; ?>

<div class="container mt-3">
    <div class="mb-3">
        <h2 class="text-center">Parametrizador de Horários</h2>
        <h6 class="text-center">Parametrize os horários de atendimentos.</h6>
    </div>

    <?php if ( isset($msg) || isset($_GET['msg']) ): ?>
        <div class="alert alert-warning mt-2 text-center"><?= $msg ?? $_GET['msg'] ?></div>
    <?php endif; ?>

    <form action="salvar-horarios-atendimento" method="POST">
        <!-- Segunda a Sexta -->
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Segunda a Sexta</div>
            <div class="card-body row align-items-center">
                <div class="col-md-6">
                    <label for="segsex_inicio" class="form-label">Hora Início</label>
                    <input value="<?= $segsex['inicio'] ?>" type="time" id="segsex_inicio" name="horarios[semana][segsex][inicio]" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="segsex_fim" class="form-label">Hora Fim</label>
                    <input value="<?= $segsex['fim'] ?>" type="time" id="segsex_fim" name="horarios[semana][segsex][fim]" class="form-control" required />
                </div>
            </div>
        </div>

        <!-- Sábado -->
        <div class="card mb-3">
            <div class="card-header bg-success text-white">Sábado</div>
            <div class="card-body row align-items-center">
                <div class="col-md-6">
                    <label for="sabado_inicio" class="form-label">Hora Início</label>
                    <input value="<?= $sabado['inicio'] ?>" type="time" id="sabado_inicio" name="horarios[semana][sabado][inicio]" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="sabado_fim" class="form-label">Hora Fim</label>
                    <input value="<?= $sabado['fim'] ?>" type="time" id="sabado_fim" name="horarios[semana][sabado][fim]" class="form-control" required />
                </div>
            </div>
        </div>

        <!-- Domingo -->
        <div class="card mb-3">
            <div class="card-header bg-warning text-white">Domingo</div>
            <div class="card-body row align-items-center">
                <div class="col-md-6">
                    <label for="domingo_inicio" class="form-label">Hora Início</label>
                    <input value="<?= $domingo['inicio'] ?>" type="time" id="domingo_inicio" name="horarios[semana][domingo][inicio]" class="form-control" required />
                </div>
                <div class="col-md-6">
                    <label for="domingo_fim" class="form-label">Hora Fim</label>
                    <input value="<?= $domingo['fim'] ?>" type="time" id="domingo_fim" name="horarios[semana][domingo][fim]" class="form-control" required />
                </div>
            </div>
        </div>

        <!-- Datas Específicas -->
        <div class="card mb-3">
            <div class="card-header bg-danger text-light">Datas Específicas</div>
            <div id="datasEspecificasContainer"></div>
            <div class="text-center mt-3 mb-3">
                <button type="button" id="adicionarDataBtn" class="btn btn-outline-secondary btn-sm">+ Adicionar Data</button>
            </div>
        </div>

        <!-- Botão Salvar -->
        <div class="text-center mt-4 mb-4">
            <button type="submit" class="btn btn-primary w-100">Salvar Parametrização</button>
        </div>
    </form>
</div>

<script src="assets/js/parametrizador-horarios.js?v=<?= time() ?>"></script>
<script>
    const datasEspecificas = <?php echo json_encode($data_especifica); ?>;
</script>

<?php include_once __DIR__ . '/includes/footer.php'; ?>