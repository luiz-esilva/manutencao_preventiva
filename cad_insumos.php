<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Cadastro de Insumos de Impressoras</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/person.css">
</head>
    <body>
        <!-- Modal Receber Toner -->
        <div class='modal fade' id='modalRecebToner' tabindex='-1' aria-labelledby='modalRecebTonerLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='modalNobreakLabel'>Recebimento de Toner</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action="./php_funcions/receb_toner.php" method="POST" enctype="multipart/form-data">
                            <div class='modal-body'>
                                <div class="container-fluid">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <input type="text" class="form-control" name="id_toner_receb" id="id_toner_receb" hidden>                        
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="id_toner_novo" style="padding-left: 4px;font-weight: 500;">Identificação</label>
                                        <input type="number" class="form-control" name="id_toner_novo" id="id_toner_novo" required>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="tecnico" style="padding-left: 4px;font-weight: 500;">Técnico</label>
                                        <?php
                                            include "./model/equipe_tecnica.php";
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                <button type='submit' class='btn btn-primary'>Receber</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>

        <!-- Modal Uso de Toner -->
        <div class='modal fade' id='modalUsoToner' tabindex='-1' aria-labelledby='modalUsoTonerLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='modalNobreakLabel'>Uso de Toner</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action="./php_funcions/uso_toner.php" method="POST" enctype="multipart/form-data">
                            <div class='modal-body'>
                                <div class="container-fluid">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="id_toner_usado" style="padding-left: 4px;font-weight: 500;">Identificação</label>
                                        <input type="number" class="form-control" name="id_toner_usado" id="id_toner_usado" required>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="tecnico" style="padding-left: 4px;font-weight: 500;">Técnico</label>
                                        <?php
                                            include "./model/equipe_tecnica.php";
                                        ?>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="impressora" style="padding-left: 4px;font-weight: 500;">Selecione a Impressora</label>
                                        <select class="form-select" name="impressora" id="impressora" style="margin-bottom: 5px;" required>
                                            <option selected disabled>Selecione uma impressora</option>
                                            <?php
                                                // Conexão com o banco de dados
                                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                                // Consulta para buscar os setores
                                                $result = $db->query('SELECT id_impressora, nome_impressora, nserie, patrimonio FROM impressoras');

                                                // Preencher o select com os dados dos setores
                                                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                                    echo '<option value="' . $row['id_impressora'] . '">' . $row['patrimonio'] . ' - ' . $row['nome_impressora']  . ' - ' . $row['nserie'] . '</option>';
                                                }

                                                // Close the connection
                                                $db->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                <button type='submit' class='btn btn-primary'>Usar</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>

        <!-- Adiciona o menu -->
        <?php
            include "./model/navbar.php";
        ?>

        <div class="container-fluid">
            <div class="card" style="margin-top: 15px;">
                <div class="card-header text-center">
                    Cadastro de Toners
                </div>
                <form action="./php_funcions/cad_toners.php" method="POST">
                    <div class="card-body">
                        <div class="container-fluid">
                            <p class="card-text">
                                <div class="row">
                                    <label for="nome_toner">Nome: </label>
                                    <select class="form-select" name="nome_toner" id="nome_toner" required>
                                        <option hidden>Selecione o Toner</option>
                                        <option value="HP - W1330XZ - Toner Black">HP - W1330XZ - Toner Black</option>
                                        <option value="Katun - OKI C710/C711 - Toner Ciano">Katun - OKI C710/C711 - Toner Ciano</option>
                                        <option value="Katun - OKI C710/C711 - Toner Magenta">Katun - OKI C710/C711 - Toner Magenta</option>
                                        <option value="Katun - OKI C710/C711 - Toner Yellow">Katun - OKI C710/C711 - Toner Yellow</option>
                                        <option value="OKI - OKI C710/C711 - Toner Black">OKI - OKI C710/C711 - Toner Black</option>
                                        <option value="Konica - TN324K - Toner Black">Konica - TN324K - Toner Black</option>
                                        <option value="Konica - TN324M - Toner Magenta">Konica - TN324M - Toner Magenta</option>
                                        <option value="Konica - TN324Y - Toner Yellow">Konica - TN324Y - Toner Yellow</option>
                                        <option value="Konica - TN324C - Toner Ciano">Konica - TN324C - Toner Ciano</option>
                                        <option value="Samsung - 358S - Toner Black">Samsung - 358S - Toner Black</option>
                                        <option value="Canon - Yellow">Canon - Yellow</option>
                                        <option value="Canon - Black">Canon - Black</option>
                                        <option value="Canon - Magenta">Canon - Magenta</option>
                                        <option value="Canon - Ciano">Canon - Ciano</option>
                                        <option value="Epson - Yellow">Epson - Yellow</option>
                                        <option value="Epson - Black">Epson - Black</option>
                                        <option value="Epson - Ciano">Epson - Ciano</option>
                                        <option value="Epson - Magenta">Epson - Magenta</option>
                                    </select>
                                    <label for="tipo_impressora">Tipo de Impressora: </label>
                                    <select class="form-select" name="tipo_impressora" id="tipo_impressora" required>
                                        <option hidden>Selecione o Tipo de Impressora</option>
                                        <option value="Impressoras HP: 408/432">Impressoras HP: 408/432</option>
                                        <option value="Impressoras OKI: C710/C711">Impressoras OKI: C710/C711</option>
                                        <option value="Impressoras Konica: C284">Impressoras Konica: C284</option>
                                        <option value="Impressoras Samsung: M5360RX/M5370LX">Impressoras Samsung: M5360RX/M5370LX</option>
                                        <option value="Impressoras Canon: GX-6010">Impressoras Canon: GX-6010</option>
                                        <option value="Impressoras Epson: L-15160">Impressoras Epson: L-15160</option>
                                    </select>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <div class="container-fluid">
                            <div class="row">
                                <input class="btn btn-dark" type="submit" value="Registrar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card" style="margin-top: 15px;">
                <div class="card-header text-center">
                    Cadastro de Drum
                </div>
                <form action="./php_funcions/cad_drums.php" method="POST">
                    <div class="card-body">
                        <div class="container-fluid">
                            <p class="card-text">
                                <div class="row">
                                    <label for="nome_drum">Nome: </label>
                                    <select class="form-select" name="nome_drum" id="nome_drum" required>
                                        <option hidden>Selecione o Drum</option>
                                        <option value="Samsung - R358">Samsung - R358 - Black</option>
                                        <option value="HP - W1332AC">HP - W1332AC - Black</option>
                                        <option value="OKI - Ciano">OKI - Ciano</option>
                                        <option value="OKI - Black">OKI - Black</option>
                                        <option value="OKI - Magenta">OKI - Magenta</option>
                                        <option value="OKI - Yellow">OKI - Yellow</option>
                                    </select>
                                    <label for="tipo_impressora">Tipo de Impressora: </label>
                                    <select class="form-select" name="tipo_impressora" id="tipo_impressora" required>
                                        <option hidden>Selecione o Tipo de Impressora</option>
                                        <option value="Impressoras HP: 408/432">Impressoras HP: 408/432</option>
                                        <option value="Impressoras OKI: C710/C711">Impressoras OKI: C710/C711</option>
                                        <option value="Impressoras Samsung: M5360RX/M5370LX">Impressoras Samsung: M5360RX/M5370LX</option>
                                    </select>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <div class="container-fluid">
                            <div class="row">
                                <input class="btn btn-dark" type="submit" value="Registrar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid" style="margin-top: 15px;">
            <div class="card">
                <div class="card-header text-center">
                    Estoque de Toners
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>IMPRESSORAS</th>
                                <th>QUANTIDADE EM ESTOQUE</th>
                                <th>A SOLICITAR</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT id_toner, nome_toner, tipo_impressora FROM toner;");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    $id_toner = $row['id_toner'];
                                    echo "<td>$id_toner</td>";
                                    echo "<td>$row[nome_toner]</td>";
                                    echo "<td>$row[tipo_impressora]</td>";

                                    $db2 = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados2 = $db2->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = '$row[id_toner]' AND status = 'Em Estoque';");
                                    while ($row2 = $dados2->fetchArray()) {
                                    echo "<td>$row2[qtd_toner_estoque]</td>";
                                    }
                                    $db2->close();
                                    
                                    $db3 = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados3 = $db3->query("SELECT count(*) as 'qtd_toner_asolicitar' FROM mov_toner WHERE id_toner = '$row[id_toner]' AND status = 'A Solicitar';");
                                    while ($row3 = $dados3->fetchArray()) {
                                    echo "<td>$row3[qtd_toner_asolicitar]</td>";
                                    }
                                    $db3->close();

                                    echo "<td><button class='botao_personalizado' onclick=\"RecebToner('$id_toner')\" data-bs-toggle='modal' data-bs-target='#modalRecebToner'><img src='bootstrap-icons-1.11.2/plus-lg.svg' width='32' height='32'></button> / <button class='botao_personalizado' onclick=\"UsoToner('$id_toner')\" data-bs-toggle='modal' data-bs-target='#modalUsoToner'><img src='bootstrap-icons-1.11.2/printer.svg' width='30' height='30'></button></td>";
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
        <div class="container-fluid" style="margin-top: 15px;">
            <div class="card">
                <div class="card-header text-center">
                    Estoque de Drums
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>IMPRESSORAS</th>
                                <th>QUANTIDADE EM ESTOQUE</th>
                                <th>A SOLICITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT id_unidimagem, nome_drum, tipo_impressora FROM unid_imagem;");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    $id_drum = $row['id_unidimagem'];
                                    echo "<td>$id_drum</td>";
                                    echo "<td>$row[nome_drum]</td>";
                                    echo "<td>$row[tipo_impressora]</td>";

                                    $db4 = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados4 = $db4->query("SELECT count(*) as 'qtd_drum_estoque' FROM mov_unid_imagem WHERE id_unidimagem = '$row[id_unidimagem]' AND status = 'Em Estoque';");
                                    while ($row4 = $dados4->fetchArray()) {
                                        echo "<td>$row4[qtd_drum_estoque]</td>";
                                    }
                                    $db4->close();
                                    
                                    $db5 = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados5 = $db5->query("SELECT count(*) as 'qtd_drum_asolicitar' FROM mov_unid_imagem WHERE id_unidimagem = '$row[id_unidimagem]' AND status = 'A Solicitar';");
                                    while ($row5 = $dados5->fetchArray()) {
                                        echo "<td>$row5[qtd_drum_asolicitar]</td>";
                                    }
                                    $db5->close();
                                    
                                    echo "<td><button class='botao_personalizado' onclick=\"RecebDrum('$id_drum')\" data-bs-toggle='modal' data-bs-target='#modalRecebDrum'><img src='bootstrap-icons-1.11.2/plus-lg.svg' width='32' height='32'></button> / <button class='botao_personalizado' onclick=\"UsoDrum('$id_drum')\" data-bs-toggle='modal' data-bs-target='#modalUsoDrum'><img src='bootstrap-icons-1.11.2/printer.svg' width='30' height='30'></button></td>";
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
        <script>
            function RecebToner(id_toner) {
                var input_id_toner = document.getElementById('id_toner_receb');

                input_id_toner.value = id_toner;
            }
            function UsoToner(id_toner) {
                var input_id_toner = document.getElementById('id_toner_uso');

                input_id_toner.value = id_toner;
            }
        </script>
    </body>
</html>