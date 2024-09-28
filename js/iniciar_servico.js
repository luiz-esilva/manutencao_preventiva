var computador;
function chamarModal_inicia(nome_computador) {
    function alterartitulo() {
        document.getElementById("modalIniciarServicoLabel").textContent = "Manutenção Preventiva: " + computador;
    }
    setTimeout(alterartitulo, 200);
    // Defina o valor do computador selecionado no select do modal
    var computadorSelecionado = document.getElementById('computador_modal');
    var computadores = computadorSelecionado.getElementsByTagName('option');
    computador = nome_computador;
    for (var i = 0; i < computadores.length; i++) {
        if (computadores[i].textContent === nome_computador) {
            computadores[i].setAttribute('selected', 'selected');
        } else {
            computadores[i].removeAttribute('selected');
        }
    }
}