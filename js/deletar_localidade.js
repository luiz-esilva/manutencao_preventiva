id_salvo = 0;
function chamarModal_localidades(id) {
    ('#modalLocalidades');
    id_salvo = id;
};

function del_localidades() {
    window.location.href = "./php_funcions/del_localidades.php?id=" + id_salvo;
};