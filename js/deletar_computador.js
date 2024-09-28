id_salvo = 0;
function chamarModal_DelComputador(id) {
    ('#modalSetor');
    id_salvo = id;
};

function del_computador() {
    window.location.href = "./php_funcions/del_computador.php?id=" + id_salvo;
};