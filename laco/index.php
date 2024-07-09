function calcularDigitoVerificador(numero) {
    // Verifica se os dois primeiros dígitos são '03'
    if (numero.slice(0, 2) !== '03') {
        throw new Error('Os dois primeiros dígitos devem ser 03');
    }

    // Despreza o dígito verificador e trabalha apenas com os oito dígitos restantes
    let empresa = numero.slice(2, 10);
    
    // Define os valores de p e d
    let p, d;
    let num = parseInt(empresa);

    if (num >= 3000001 && num <= 3017000) {
        p = 5; d = 0;
    } else if (num >= 3017001 && num <= 3019022) {
        p = 9; d = 1;
    } else if (num >= 3019023) {
        p = 0; d = 0;
    } else {
        throw new Error('Número fora das faixas definidas');
    }

    // Define os pesos
    const pesos = [9, 8, 7, 6, 5, 4, 3, 2];

    // Calcula a soma ponderada
    let soma = p;
    for (let i = 0; i < empresa.length; i++) {
        soma += parseInt(empresa[i]) * pesos[i];
    }

    // Calcula o módulo 11 da soma
    let resto = soma % 11;

    // Calcula o dígito verificador
    let digitoVerificador = 11 - resto;
    if (digitoVerificador === 10) {
        digitoVerificador = 0;
    } else if (digitoVerificador === 11) {
        digitoVerificador = d;
    }

    return numero.slice(0, 10) + digitoVerificador;
}

// Exemplo de uso
let numero = "030123459";
try {
    let resultado = calcularDigitoVerificador(numero);
    console.log(`Número com dígito verificador: ${resultado}`);
} catch (error) {
    console.error(error.message);
}