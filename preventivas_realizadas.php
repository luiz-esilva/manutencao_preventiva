<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Preventivas Realizadas</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/person.css">
    <link href="css/datatables.min.css" rel="stylesheet">
</head>
<body>
    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>
    
    <div class="container">
        <div class="row text-center">
            <div class="row" style="margin-top: 15px;">
                <h3 class="text-center">Preventivas Realizadas</h3>
                <table id="prev_realizadas" class="table align-middle text-center table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Computador</th>
                            <th scope="col">Técnico</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Localidade</th>
                            <th scope="col">Última Preventiva</th>
                            <th scope="col">Antes da Preventiva</th>
                            <th scope="col">Patrimonio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                            $dados = $db->query("SELECT rp.id_preventiva, rp.tecnico, rc.computador, rs.setor_nome, rp.imagem_antes, rp.imagem_patrimonio, rl.localidade_nome, MIN(rc.data_ultimo_realizado) as data_ultimo_realizado, rc.periodo_limpeza FROM reg_computadores rc JOIN reg_localidades rl ON rc.id_localidade = rl.id_localidade JOIN reg_setores rs ON rl.id_setor = rs.id_setor LEFT JOIN reg_preventiva rp ON rc.id_computadores = rp.id_computadores WHERE rc.data_ultimo_realizado IS NOT NULL OR datetime(COALESCE(rc.data_ultimo_realizado, 'now'), '+' || rc.periodo_limpeza || ' months') < datetime('now') GROUP BY rc.computador, rs.setor_nome, rl.localidade_nome, rc.periodo_limpeza ORDER BY data_ultimo_realizado DESC");
			    /*$dados = $db->query("SELECT rp.id_preventiva, rp.tecnico, rc.computador, rs.setor_nome, rp.imagem_antes, rp.imagem_patrimonio, rl.localidade_nome, MIN(rc.data_ultimo_realizado) as data_ultimo_realizado, rc.periodo_limpeza FROM reg_computadores rc JOIN reg_localidades rl ON rc.id_localidade = rl.id_localidade JOIN reg_setores rs ON rl.id_setor = rs.id_setor LEFT JOIN reg_preventiva rp ON rc.id_computadores = rp.id_computadores WHERE rc.data_ultimo_realizado IS NOT NULL GROUP BY rc.computador, rs.setor_nome, rl.localidade_nome, rc.periodo_limpeza ORDER BY data_ultimo_realizado DESC;");*/
                            while ($row = $dados->fetchArray()) {
                                $nome_computador = $row['computador'];
                                echo "<tr>";
                                echo "<td>$row[id_preventiva]</td>";
                                echo "<td>$row[computador]</td>";
                                echo "<td>$row[tecnico]</td>";
                                echo "<td>$row[setor_nome]</td>";
                                echo "<td>$row[localidade_nome]</td>";
                                // Verifica se a data da última preventiva é nula
                                if ($row['data_ultimo_realizado']) {
                                    $data_formatada = new DateTime($row['data_ultimo_realizado']);
                                    echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                                } else {
                                    echo "<td> NUNCA REALIZADO </td>";
                                }
                                $db_imagens = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $dados_imagens = $db_imagens->query("SELECT rp.imagem_antes, rp.imagem_patrimonio FROM reg_computadores rc JOIN reg_localidades rl ON rc.id_localidade = rl.id_localidade JOIN reg_setores rs ON rl.id_setor = rs.id_setor LEFT JOIN reg_preventiva rp ON rc.id_computadores = rp.id_computadores WHERE rp.id_computadores IS NULL OR datetime(COALESCE(rc.data_ultimo_realizado, 'now'), '+' || rc.periodo_limpeza || ' months') < datetime('now') GROUP BY rc.computador, rs.setor_nome, rl.localidade_nome, rc.periodo_limpeza ORDER BY data_ultimo_realizado DESC;");
                                while ($imagens = $dados_imagens->fetchArray()) {
                                    $caminho_imagemantes = $row['imagem_antes'];
                                    $caminho_imagempatrimonio = $row['imagem_patrimonio'];
                                }
                                // Verifica se a imagem computador existe
                                if ($row['imagem_antes']) {
                                    echo "<td><a href='./imgs/preventiva/$caminho_imagemantes' target='_blank'><img src='./imgs/preventiva/$row[imagem_antes]' width='100' height='100'></a></td>";
                                } else {
                                    echo "<td> NUNCA REALIZADO </td>";
                                }
                                // Verifica se a imagem patrimonio existe
                                if ($row['imagem_patrimonio']) {
                                    echo "<td><a href='./imgs/preventiva/$caminho_imagempatrimonio' target='_blank'><img src='./imgs/preventiva/$row[imagem_patrimonio]' width='100' height='100'></a></td>";
                                } else {
                                    echo "<td> NUNCA REALIZADO </td>";
                                }
                                $db_imagens->close();
                                echo "</tr>";
                            }
                            // Close the connection
                            $db->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.5.2.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        new DataTable('#prev_realizadas', {
            language: {
                info: 'Exibindo página _PAGE_ de _PAGES_ paginas, foram encontrados _MAX_ preventivas',
                infoEmpty: 'Nenhum dado encontrado',
                infoFiltered: '(filtrado _MAX_ total resultados)',
                lengthMenu: 'Exibir _MENU_ linhas por página',
                search: "Pesquisar:",
                zeroRecords: 'Sua busca não retornou nenhuma informação',
                paginate: {
                    first: "Primeiro",
                    last: "Último",
                    next: "Próximo",
                    previous: "Anterior"
                }
            },
	    order: [[0, 'desc']],
            dom: '<f>rt<"bottom"p><"clear">',
            lengthMenu: [ [15], [15] ]
        });     
    </script>
</body>
</html>
