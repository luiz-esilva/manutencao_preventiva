<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Registrar Preventiva</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>

    <div class="container">
        <div class="row text-center">
            <h3>Registro de Manutenção Preventiva</h3>
        </div>
        <div class="row">
            <form action="./php_funcions/cad_preventiva.php" method="POST" enctype="multipart/form-data">
                <div class="row" style="margin-bottom: 5px;">
                    <label for="computador" style="padding-left: 4px;font-weight: 500;">Selecione o Computador:</label>
                    <select class="form-select" name="computador" id="computador">
                        <option selected disabled>Computador</option>
                        <?php
                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                            $result = $db->query('SELECT id_computadores, computador FROM reg_computadores');
                            
                            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                echo '<option value="' . $row['id_computadores'] . '">' . $row['computador'] . '</option>';
                            }
                            
                            $db->close();
                        ?>
                    </select>
                </div>
                <div class="row" style="margin-bottom: 5px;">
                    <label for="tecnico" style="padding-left: 4px;font-weight: 500;">Selecione o Técnico Responsável:</label>
                    <?php
                        include "./model/equipe_tecnica.php";
                    ?>
                </div>
                <div class="row" style="margin-bottom: 5px;">
                    <label for="imagem_antes" style="padding-left: 4px;font-weight: 500;">Foto Antes da Preventiva:</label>
                    <input class="form-control" type="file" name="imagem_antes" id="imagem_antes" required>
                </div>
                <div class="row" style="margin-bottom: 5px;">
                    <label for="imagem_patrimonio" style="padding-left: 4px;font-weight: 500;">Foto do Patrimônio:</label>
                    <input class="form-control" type="file" name="imagem_patrimonio" id="imagem_patrimonio" required>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                    <label for="data_realizado" style="padding-left: 4px;font-weight: 500;">Data da Realização do Serviço:</label>
                    <input class="form-control" type="datetime-local" name="data_realizado" id="data_realizado" required>
                </div>
                <div class="row">
                    <input class="btn btn-primary" type="submit" value="Registrar Preventiva">
                </div>
            </form>
        </div>
        <div class="row" style="margin-top: 15px;">
            <h3 class="text-center">Preventivas Vencidas</h3>
            <table class="table align-middle text-center table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">Computador</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Localidade</th>
                        <th scope="col">Última Preventiva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                        $dados = $db->query("SELECT rc.computador, rs.setor_nome, rl.localidade_nome, rc.data_ultimo_realizado, rc.periodo_limpeza FROM reg_computadores rc JOIN reg_localidades rl ON rc.id_localidade = rl.id_localidade JOIN reg_setores rs ON rl.id_setor = rs.id_setor LEFT JOIN reg_preventiva rp ON rc.id_computadores = rp.id_computadores WHERE rp.id_computadores IS NULL OR datetime(COALESCE(rc.data_ultimo_realizado, 'now'), '+' || rc.periodo_limpeza || ' months') < datetime('now') ORDER BY rc.data_ultimo_realizado DESC;");
                        while ($row = $dados->fetchArray()) {
                            echo "<tr>";
                            echo "<td>$row[computador]</th>";
                            echo "<td>$row[setor_nome]</td>";
                            echo "<td>$row[localidade_nome]</td>";
                            // Verifica se a data da última preventiva é nula
                            if ($row['data_ultimo_realizado']) {
                                $data_formatada = new DateTime($row['data_ultimo_realizado']);
                                echo "<td>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
                            } else {
                                echo "<td> NUNCA REALIZADO </td>";
                            }
                            echo "</tr>";
                        }

                        // Close the connection
                        $db->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.5.2.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
