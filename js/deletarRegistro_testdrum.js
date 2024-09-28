id_salvo = 0;
function chamarModal(id) {
    ('#exampleModal');
    id_salvo = id;
};

function deletarRegistro() {
    window.location.href = "delete_testdrum.php?id=" + id_salvo;
};