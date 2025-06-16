export function alertarErro(msg) {

    Toastify({

        text: msg,

        duration: 2000,

        destination: "https://github.com/apvarun/toastify-js",

        newWindow: true,

        close: false,

        gravity: "top", // `top` or `bottom`

        position: "center", // `left`, `center` or `right`

        stopOnFocus: true, // Prevents dismissing of toast on hover

        style: {
            background: "linear-gradient(to right, #ff4e50, #f44336)", // vermelho vibrante para vermelho escuro
        },

        onClick: function () {}, // Callback after click

    }).showToast();

}

export function alertarSucesso(msg) {

    Toastify({

        text: msg,

        duration: 2000,

        destination: "https://github.com/apvarun/toastify-js",

        newWindow: true,

        close: false,

        gravity: "top", // `top` or `bottom`

        position: "center", // `left`, `center` or `right`

        stopOnFocus: true, // Prevents dismissing of toast on hover

        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)", // vermelho vibrante para vermelho escuro
        },

        onClick: function () {}, // Callback after click

    }).showToast();

}