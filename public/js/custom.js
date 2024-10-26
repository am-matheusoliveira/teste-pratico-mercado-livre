
/* Função para formatar preço para o padrão BR */
function formatarMoedaBR(input){
    // Incluindo Evento
    input.addEventListener('input', function(e) {    
        let valor = e.target.value;

        // Remove tudo que não for dígito ou vírgula
        valor = valor.replace(/\D/g, '');

        // Impede valores negativos (não deixa que o valor seja menor que zero)
        if (valor < 0) {
            valor = 0;
        }

        // Se o valor for vazio, não faz nada e deixa o campo vazio
        if (valor === '') {
            e.target.value = '';
            return;
        }    

        // Formata o valor para o padrão brasileiro
        valor = (parseFloat(valor) / 100).toFixed(2).replace('.', ',');

        // Adiciona os pontos nos milhares
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Atualiza o campo com o valor formatado
        e.target.value = valor;
    });
}

/* Função para validar campo permitindo que digite apenas números */
function somenteNumero(input){
    // Incluindo Evento
    input.addEventListener('input', function(e) {    
        let valor = e.target.value;

        // Remove qualquer caractere que não seja número
        valor = valor.replace(/\D/g, '');

        // Se o valor for vazio, deixa o campo vazio
        if (valor === '') {
            e.target.value = '';
            return;
        }

        // Impede valores negativos (não deixa ser menor que zero)
        if (parseInt(valor) < 0) {
            valor = 0;
        }

        // Atualiza o campo com o valor numérico válido
        e.target.value = valor;
    });
}

/* Função para validar os campos do Formulário */
(function () {
    'use strict'

    const forms = document.querySelectorAll('.requires-validation');

    Array.from(forms).forEach(function (form){

        form.addEventListener('submit', function (event){
            if (!form.checkValidity()){
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
})()