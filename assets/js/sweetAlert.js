export function exibirMsg(icon, title, text, diretorio)
{
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        timer: 1500,
        showConfirmButton: false
    }).then(() => {
        window.location.href = `${diretorio}.html`;
    });

}