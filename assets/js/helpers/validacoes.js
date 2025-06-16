// Helper onde você pode implementar todos os tipos de validações

import { alertarErro } from './alertas.js';

export function validarCampoVazio(campo) {

    if ( campo.value == "" ) {

        alertarErro(`Por favor, preencha corretamente o campo '${campo.id}'.`);
        return false;
        
    }

    return true;

}

export function validarEmail(email) {
  
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    if ( regex.test(email) === false ) {
        alertarErro(`Por favor, preencha corretamente o email.`);
        return false;
    }

    return true;
}