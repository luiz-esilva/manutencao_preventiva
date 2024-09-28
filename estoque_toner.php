<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Estoque Toner</title>
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
                                        <input type="text" class="form-control" name="id_toner_novo" id="id_toner_novo" required>
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

        <!-- Modal Devolver Toner -->
        <div class='modal fade' id='modalRetorna' tabindex='-1' aria-labelledby='modalRetornaLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='modalNobreakLabel'>Devolver toner ao estoque</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action="./php_funcions/devolver_toner.php" method="POST" enctype="multipart/form-data">
                            <div class='modal-body'>
                                <div class="container-fluid">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="id_toner_retorno" style="padding-left: 4px;font-weight: 500;">Identificação</label>
                                        <input type="text" class="form-control" name="id_toner_retorno" id="id_toner_retorno" readonly>
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
                                <button type='submit' class='btn btn-primary'>Devolver</button>
                            </div>
                        </form>
                    </div>
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
                                        <input type="text" class="form-control" name="id_toner_usado" id="id_toner_usado" readonly>
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



        <!-- Modal Entregar Centermaq -->
        <div class='modal fade' id='modalEntregar' tabindex='-1' aria-labelledby='modalEntregarLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='modalEntregarLabel'>Entrega de Toner para Centermaq</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action="./php_funcions/entregar_toner.php" method="POST" enctype="multipart/form-data">
                            <div class='modal-body'>
                                <div class="container-fluid">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="id_drum_receb" style="padding-left: 4px;font-weight: 500;">Identificação</label>
                                        <input type="text" class="form-control" name="id_drum_receb" id="id_drum_receb" readonly>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="tecnico" style="padding-left: 4px;font-weight: 500;">Técnico</label>
                                        <?php
                                            include "./model/equipe_tecnica.php";
                                        ?>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="dt_saida" style="padding-left: 4px;font-weight: 500;">Data da Saída</label>
                                        <input type="datetime-local" class="form-control" id="dt_saida" name="dt_saida" required>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                <button type='submit' class='btn btn-primary'>Entregar</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>

        <!-- Modal Solicitação de Toner -->
        <div class='modal fade' id='modalSolicita' tabindex='-1' aria-labelledby='modalSolicitaLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='modalSolicitaLabel'>Solicitação de Toner</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action="./php_funcions/solicita_toner.php" method="POST" enctype="multipart/form-data">
                            <div class='modal-body'>
                                <div class="container-fluid">
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="id_toner_usado_sol" style="padding-left: 4px;font-weight: 500;">Identificação</label>
                                        <input type="text" class="form-control" name="id_toner_usado_sol" id="id_toner_usado_sol" readonly>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="tecnico" style="padding-left: 4px;font-weight: 500;">Técnico</label>
                                        <?php
                                            include "./model/equipe_tecnica.php";
                                        ?>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="cod_centermaq" style="padding-left: 4px;font-weight: 500;">Código de Solicitação</label>
                                        <input type="text" class="form-control" id="cod_centermaq" name="cod_centermaq" required>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px;">
                                        <label for="dt_pedido_sol" style="padding-left: 4px;font-weight: 500;">Data da Solicitação</label>
                                        <input type="datetime-local" class="form-control" id="dt_pedido_sol" name="dt_pedido_sol" required>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                <button type='submit' class='btn btn-primary'>Solicitar</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        
        <!-- Adiciona o menu -->
        <?php
            include "./model/navbar.php";
        ?>

        <div class="container-fluid" style="margin-top: 15px;">
            <div class="card">
                <div class="card-header text-center">
                    Toners em Uso
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TECNICO QUE INSTALOU</th>
                                <th>DATA DA INSTALAÇÃO</th>
                                <th>STATUS</th>
                                <th>IMPRESSORA</th>
                                <th>Nº DE SÉRIE</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT mt.id_mov_toner, mt.tecnico, mt.dt_entrada, mt.status, ip.nome_impressora, ip.nserie, ip.ip FROM mov_toner mt LEFT JOIN impressoras ip on ip.id_impressora = mt.id_impressora WHERE mt.status = 'Em Uso';");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    $id_toner = $row['id_mov_toner'];
                                    echo "<td>$id_toner</td>";
                                    echo "<td>$row[tecnico]</td>";
                                    $data_entrada = new DateTime($row['dt_entrada']);
                                    echo "<td>" . $data_entrada->format('d/m/Y - H:i') . "</td>";
                                    echo "<td>$row[status]</td>";
                                    echo "<td>$row[nome_impressora]</td>";
                                    echo "<td>$row[nserie]</td>";
                                    echo "<td>$row[ip]</td>";
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
                    Toners em Estoque
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
				<th>TONER</th>
                                <th>TECNICO QUE RECEBEU</th>
                                <th>DATA ENTRADA ESTOQUE</th>
                                <th>STATUS</th>
                                <!--<th>AÇÕES</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT mt.id_mov_toner, mt.tecnico, mt.dt_entrada, mt.status, tt.nome_toner FROM mov_toner mt LEFT JOIN toner tt ON mt.id_toner = tt.id_toner WHERE status = 'Em Estoque';");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    $id_toner = $row['id_mov_toner'];
                                    echo "<td>$id_toner</td>";
				    echo "<td>$row[nome_toner]</td>";
                                    echo "<td>$row[tecnico]</td>";
                                    $data_entrada = new DateTime($row['dt_entrada']);
                                    echo "<td>" . $data_entrada->format('d/m/Y - H:i') . "</td>";
                                    echo "<td>$row[status]</td>";
                                    //echo "<td><button class='botao_personalizado' onclick=\"UsoToner('$id_toner')\" data-bs-toggle='modal' data-bs-target='#modalUsoToner'><img src='bootstrap-icons-1.11.2/printer.svg' width='30' height='30'></button></td>";
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
                    Toners a Solicitar
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TONER</th>
                                <th>TECNICO QUE SUBSTITUIU</th>
                                <th>DATA DA INSTALAÇÃO</th>
                                <th>STATUS</th>
                                <th>IMPRESSORA</th>
                                <th>Nº DE SÉRIE</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT mt.id_mov_toner, tt.nome_toner, mt.tecnico, mt.dt_entrada, mt.status, ip.nome_impressora, ip.nserie FROM mov_toner mt LEFT JOIN impressoras ip on ip.id_impressora = mt.id_impressora LEFT JOIN toner AS tt ON mt.id_toner = tt.id_toner WHERE mt.status = 'A Solicitar';");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    $id_toner = $row['id_mov_toner'];
                                    echo "<td>$id_toner</td>";
                                    echo "<td>$row[nome_toner]</td>";
                                    echo "<td>$row[tecnico]</td>";
                                    $data_entrada = new DateTime($row['dt_entrada']);
                                    echo "<td>" . $data_entrada->format('d/m/Y - H:i') . "</td>";
                                    echo "<td>$row[status]</td>";
                                    echo "<td>$row[nome_impressora]</td>";
                                    echo "<td>$row[nserie]</td>";
                                    echo "<td><button class='botao_personalizado' onclick=\"Devolver('$id_toner')\" data-bs-toggle='modal' data-bs-target='#modalRetorna'><img src='bootstrap-icons-1.11.2/arrow-return-left.svg' width='26' height='26'></button> / <button class='botao_personalizado' onclick=\"Solicitar('$id_toner')\" data-bs-toggle='modal' data-bs-target='#modalSolicita'><img src='bootstrap-icons-1.11.2/basket2.svg' width='30' height='30'></button></td>";
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
                    Toners Solicitados
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TECNICO QUE SOLICITOU</th>
                                <th>DATA DA SOLICITAÇÃO</th>
                                <th>STATUS</th>
                                <th>IMPRESSORA</th>
                                <th>Nº DE SÉRIE</th>
                                <th>COD CENTERMAQ</th>
                                <th>DATA PEDIDO</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT mt.id_mov_toner, mt.tecnico, mt.dt_entrada, mt.status, mt.cod_centermaq, mt.dtped_centermaq, ip.nome_impressora, ip.nserie FROM mov_toner mt LEFT JOIN impressoras ip on ip.id_impressora = mt.id_impressora WHERE mt.status = 'Solicitado';");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    $id_toner = $row['id_mov_toner'];
                                    echo "<td>$id_toner</td>";
                                    echo "<td>$row[tecnico]</td>";
                                    $data_entrada = new DateTime($row['dt_entrada']);
                                    echo "<td>" . $data_entrada->format('d/m/Y - H:i') . "</td>";
                                    echo "<td>$row[status]</td>";
                                    echo "<td>$row[nome_impressora]</td>";
                                    echo "<td>$row[nserie]</td>";
                                    echo "<td>$row[cod_centermaq]</td>";
                                    $data_formatada_pedcentermaq = new DateTime($row['dtped_centermaq']);
                                    echo "<td>" . $data_formatada_pedcentermaq->format('d/m/Y - H:i') . "</td>";
                                    echo "<td><button class='botao_personalizado' onclick=\"Entregar('$id_toner')\" data-bs-toggle='modal' data-bs-target='#modalEntregar'><img src='bootstrap-icons-1.11.2/box-arrow-right.svg' width='30' height='30'></button></td>";
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
                    Toners Entregues a Centermaq
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle text-center table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TECNICO QUE ENTREGOU</th>
                                <th>STATUS</th>
                                <th>COD CENTERMAQ</th>
                                <th>DATA PEDIDO</th>
                                <th>DATA SAIDA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                                $dados = $db->query("SELECT mt.id_mov_toner, mt.tecnico, mt.status, mt.cod_centermaq, mt.dtped_centermaq, mt.dt_saida, ip.nome_impressora, ip.nserie FROM mov_toner mt LEFT JOIN impressoras ip on ip.id_impressora = mt.id_impressora WHERE mt.status = 'Entregue Centermaq';");
                                while ($row = $dados->fetchArray()) {
                                    echo "<tr>";
                                    $id_toner = $row['id_mov_toner'];
                                    echo "<td>$id_toner</td>";
                                    echo "<td>$row[tecnico]</td>";
                                    echo "<td>$row[status]</td>";
                                    echo "<td>$row[cod_centermaq]</td>";
                                    $data_formatada_pedcentermaq = new DateTime($row['dtped_centermaq']);
                                    echo "<td>" . $data_formatada_pedcentermaq->format('d/m/Y - H:i') . "</td>";
                                    $data_formatada_saida = new DateTime($row['dt_saida']);
                                    echo "<td>" . $data_formatada_saida->format('d/m/Y - H:i') . "</td>";
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
                var input_id_toner = document.getElementById('id_toner_usado');

                input_id_toner.value = id_toner;
            }


            function Entregar(id_drum) {
                var input_id_drum = document.getElementById('id_drum_receb');

                input_id_drum.value = id_drum;
            }
            function Solicitar(id_toner_sol) {
                var input_id_drum = document.getElementById('id_toner_usado_sol');

                input_id_drum.value = id_toner_sol;
            }
            function Devolver(id_toner_devolver) {
                var input_id_toner = document.getElementById('id_toner_retorno');
                input_id_toner.value = id_toner_devolver;
            }
        </script>
    </body>
</html>
