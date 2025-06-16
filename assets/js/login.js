import { validarCampoVazio, validarEmail } from './helpers/validacoes.js';
import { enviarRequestPost } from './helpers/requests.js';
import { alertarErro, alertarSucesso } from './helpers/alertas.js';

document.addEventListener("DOMContentLoaded", function() {
    ouvinte();
});

function ouvinte() {

    document.getElementById("botaoEntrarFuncionario").onclick = efetuarLogin;

}

async function efetuarLogin() {
 
    const endPoint = "funcionario/efetuarLogin";

    const email = document.getElementById("email");
    const senha = document.getElementById("senha");

    if ( validarCampoVazio(email) === false ) return;
    if ( validarEmail(email.value) == false ) return;

    if ( validarCampoVazio(senha) === false ) return;

    const dados = { endPoint, email: email.value, senha: senha.value }

    try {
    
        const url = "http://localhost/github/thaistar/src/core.php";

        const resposta = await enviarRequestPost(url, dados);
        
        if ( resposta.status === true ) {
            
            alertarSucesso(resposta.msg);
            setTimeout(() => window.location.href = "painel.php", 2000);

        }
    
    } catch (error) {
        alertarErro(error.message);    
    }
    
}