export async function enviarRequestPost(url, dados) {

    try {

        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(dados),
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.msg || "Erro desconhecido");
        }

        return data;

    } catch (error) {
        console.error("Erro no fetch:", error);
        throw error; // Repassa para o caller tratar
    }
}