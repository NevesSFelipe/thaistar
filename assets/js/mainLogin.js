import { deslogarUsuario } from '../js/storage.js';
import { exibirMsg } from '../js/sweetAlert.js';

document.addEventListener('DOMContentLoaded', function() {
    ouvinte();
});

function ouvinte() {
    document.getElementById('iconeLogout').addEventListener('click', sairSistema);
}

function sairSistema() {

    deslogarUsuario();
    exibirMsg('success', 'Sucesso!', "Usuário deslogado com sucesso.", 'funcionario-login');

}