export function salvarToken(token) {
    const { exp } = decodeJwt(token); // exp vem em segundos
    localStorage.setItem("token", token);
    localStorage.setItem("exp", exp);
}

export function salvarFuncionario(nomeFuncionario) {
    localStorage.setItem("nomeFuncionario", nomeFuncionario);
}

export function obterToken() {

    const token = localStorage.getItem("token");
    const exp = localStorage.getItem("exp");

    if (!token || !exp) return null;

    const agora = Math.floor(Date.now() / 1000);
    
    if (agora > parseInt(exp, 10)) {
        // Expirou
        localStorage.removeItem("token");
        localStorage.removeItem("exp");
        return null;
    }

    return token;
}

export function obterFuncionario() {
    return localStorage.getItem("nomeFuncionario");
}

function decodeJwt(token) {
    const payload = token.split(".")[1];
    return JSON.parse(atob(payload));
}