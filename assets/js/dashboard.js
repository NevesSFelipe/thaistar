import { obterToken, obterFuncionario } from './storage.js';
import { exibirMsg } from './sweetAlert.js';

document.addEventListener('DOMContentLoaded', function() {
    exibirNomeFuncionario();
});

function exibirNomeFuncionario() {

    const token = obterToken();

    if (!token) {
        exibirMsg('warning', 'Sessão expirada', 'Faça login novamente', 'funcionario-login');
        return;
    }

    const nomeFuncionario = obterFuncionario();
    document.getElementById("nomeFuncionario").textContent = nomeFuncionario;

}