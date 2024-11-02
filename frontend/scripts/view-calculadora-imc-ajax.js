// somente carregar recursos depois que DOM estiver carregado
$( document ).ready(function() {
    // jquery
    $("#limpar").click(function() {
        // limpar peso e altura
        limparCampos();
        // limpar tabela
        limparTabela();
        // limpar resultados
        limparResultados();
    });

    $("#calcular").click(function() {
        // montar a requisição ajax
        var p = $("#peso").val();
        var a = $("#altura").val();

        var requestParameters = {
            url: "../backend/calculadora-imc-ajax-ui.php",
            method: "POST",
            data: {
                peso: p,
                altura: a
            }
        };
        
        $.ajax(requestParameters).done(function(resposta) {            
            limparTabela();
            //console.log(resposta);
            //var json = JSON.parse(resposta);
            //console.log(json.valor);
            //console.log(json.avaliacao);
            $("#resultado").html(resposta.valor);
            $("#resultado2").text(resposta.avaliacao);

            var rowId = "#row" + resposta.linha;
            //console.log(rowId);

            $( rowId ).addClass("tr_selected");
        });

    });
});

function limparCampos() {
    $("#peso").val('');
    $("#altura").val('');
}

function limparTabela() {
    for (var i = 1; i <= 6; i++) {
        var rowId = "#row" + i;
        $( rowId ).removeClass();
    }
}

function limparResultados() {
    $("#resultado").text('');
    $("#resultado2").text('');
}

// JavaScript puro
/*

// criando função
function nomeDaFuncao(parametro1, parametro2) {

}

// esperando carregar o DOM da página
document.addEventListener("DOMContentLoaded", function(event) {

});

// anexando uma função de click ao elemento com id = limpar
document.getElementById("limpar").addEventListener("click", function(event) {
    
});
*/
