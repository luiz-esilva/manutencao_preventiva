id_salvo = 0;
function chamarModal_setores(id) {
    ('#modalSetor');
    id_salvo = id;
};

function del_setor() {
    window.location.href = "./php_funcions/del_setor.php?id=" + id_salvo;
};