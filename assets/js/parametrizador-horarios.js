document.addEventListener("DOMContentLoaded", function () {
    
    if (datasEspecificas.length > 0) {
        datasEspecificas.forEach(function(item) {
            const index = adicionarDatasEspecificas(); // Cria o bloco normalmente
            preencherBlocoDataEspecifica(index, item.dia, item.inicio, item.fim); // Preenche os campos
        });
    }
    
    ouvintes();

});

function ouvintes() {
    document.getElementById("adicionarDataBtn").addEventListener("click", adicionarDatasEspecificas);
}

function adicionarDatasEspecificas() {

    let index = Math.floor(Math.random() * 100000);

    // Cria um novo div (bloco de inputs)
    const novoBloco = document.createElement("div");

    novoBloco.classList.add("row", "mt-3", "card-body", "align-items-center");

    novoBloco.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">Data</label>
                <input type="date" name="horarios[data_especifica][${index}][dia]" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Hora Início</label>
                <input type="time" name="horarios[data_especifica][${index}][inicio]" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Hora Fim</label>
                <input type="time" name="horarios[data_especifica][${index}][fim]" class="form-control" required>
            </div>
            <div class="col-md-1 d-flex align-items-end mt-4">
                <i class="bi bi-trash fs-8 text-danger removerBloco" title="Remover este horário" style="cursor: pointer;"></i>
            </div>
        `;

    // Adiciona esse bloco no container
    document.getElementById("datasEspecificasContainer").appendChild(novoBloco);

    adicionarEventoRemover(novoBloco);

    return index;

}

function adicionarEventoRemover(bloco) {
    bloco.querySelector(".removerBloco").addEventListener("click", function () {
        bloco.remove();
    });
}

function preencherBlocoDataEspecifica(index, dia, inicio, fim) {
    document.querySelector(`input[name="horarios[data_especifica][${index}][dia]"]`).value = dia;
    document.querySelector(`input[name="horarios[data_especifica][${index}][inicio]"]`).value = inicio;
    document.querySelector(`input[name="horarios[data_especifica][${index}][fim]"]`).value = fim;
}