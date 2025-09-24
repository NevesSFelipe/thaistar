import { exibirMsg } from './sweetAlert.js';
import { salvarToken, salvarFuncionario, obterToken } from './storage.js';

document.addEventListener('DOMContentLoaded', function() {
    ouvinte();
});

function ouvinte() {
    document.getElementById('btnLoginFuncionario').addEventListener('click', autenticarFuncionario);
}

async function autenticarFuncionario() {

    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value.trim();

    if (!email || !senha) {

        exibirMsg('warning', 'Atenção', 'Preencha todos os campos!', 'funcionario-login');
        return;
    }

    try {

        const res = await fetch('http://localhost:8080/funcionarios/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, senha })
        });

        const data = await res.json();

        const codigo = res.status;
        const msg = data.msg;

        if( codigo != 200 ) {
            exibirMsg('warning', 'Atenção', msg, 'funcionario-login');
            return;
        }

        salvarToken(data.dados.token);
        salvarFuncionario(data.dados.nome);
        exibirMsg('success', 'Sucesso!', msg, 'dashboard');

    } catch (err) {
        exibirMsg('error', 'Erro', "Falha na comunicação com a API.", 'funcionario-login');
    }

}