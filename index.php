<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manutenções Preventivas TI/HUA</title>
        <link rel="stylesheet" href="css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body style="margin-bottom: 15px;">
        <!-- Adiciona o menu -->
        <?php
            include "./model/navbar.php";
        ?>

        <div class="container-fluid">
            <div class="row text-center" style="margin-top: 15px;">
                <h3>Manutenção Preventiva</h3>
            </div>
            <div class="row align-items-center" style="margin-top: 10px;">
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="card text-center">
                                <div class="card-header">
                                    Total de Preventivas Vencidas
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <?php
                                            $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                            $dados = $db->query("SELECT COUNT(*) as qtd_vencidas FROM reg_computadores rc JOIN reg_localidades rl ON rc.id_localidade = rl.id_localidade JOIN reg_setores rs ON rl.id_setor = rs.id_setor LEFT JOIN reg_preventiva rp ON rc.id_computadores = rp.id_computadores WHERE rp.id_computadores IS NULL OR datetime(COALESCE(rc.data_ultimo_realizado, 'now'), '+' || rc.periodo_limpeza || ' months') < datetime('now');");
                                            while ($row = $dados->fetchArray()) {
                                                echo "$row[qtd_vencidas]";
                                            }
                                            $db->close();
                                        ?>
                                    </p>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <?php
                                        $data_hoje = date('d/m/Y');
                                        $data_hoje_query = date('Y-m-d');
                                        echo "Consulta realizada em: $data_hoje";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-header">
                                        Agendamentos Realizados
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <?php
                                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                                $dados = $db->query("SELECT COUNT(*) as qt_agendado FROM reg_computadores rc LEFT JOIN reg_localidades lo on lo.id_localidade = rc.id_localidade LEFT JOIN reg_setores st on st.id_setor = lo.id_setor WHERE rc.data_agendada IS NOT NULL;");
                                                while ($row = $dados->fetchArray()) {
                                                    echo "$row[qt_agendado]";
                                                }
                                                $db->close();
                                            ?>
                                        </p>
                                    </div>
                                    <div class="card-footer text-body-secondary">
                                        <?php
                                            $data_hoje = date('d/m/Y');
                                            $data_hoje_query = date('Y-m-d');
                                            echo "Consulta realizada em: $data_hoje";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                    
            <div class="row align-items-center" style="margin-top: 10px;">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Preventivas Realizadas Hoje
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE DATE(data_realizado_final) = '$data_hoje_query';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_preventiva]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $data_hoje = date('d/m/Y');
                                echo "Consulta realizada em: $data_hoje";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Preventivas Realizadas na Semana
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $data_hoje = date('Y-m-d', strtotime('now'));
                                    $dia_semana = date('w', strtotime($data_hoje));
                                    $data_inicio_semana = date('Y-m-d', strtotime("-$dia_semana days", strtotime($data_hoje)));
                                    $data_fim_semana = date('Y-m-d', strtotime("+6 days", strtotime($data_inicio_semana)));
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE data_realizado_final >= '$data_inicio_semana' AND data_realizado_final <= '$data_fim_semana';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_preventiva]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $data_hoje = date('d/m/Y');
                                echo "Consulta realizada em: $data_hoje";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Preventivas Realizadas no Mês
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $data_hoje = date('Y-m-d', strtotime('now'));
                                    $mes_atual = date('m', strtotime($data_hoje));
                                    $ano_atual = date('Y', strtotime($data_hoje));
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE strftime('%m', data_realizado_final) = '$mes_atual' AND strftime('%Y', data_realizado_final) = '$ano_atual';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_preventiva]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $data_hoje = date('d/m/Y');
                                echo "Consulta realizada em: $data_hoje";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center" style="margin-top: 15px;">
                <h3>Impressoras</h3>
            </div>
            <div class="row align-items-center" style="margin-top: 10px;">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Total Cadastrados
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
					require './php_funcions/query_mysql_glpi.php';

					// Exemplo de uso da função
					$query = "SELECT count(*) as qtd_total FROM glpi.glpi_printers prt LEFT JOIN glpi.glpi_locations AS loc ON prt.locations_id = loc.id;";
					$dados = buscar_dados($query);

					if ($dados->num_rows > 0) {
						while($row = $dados->fetch_assoc()){
							echo "$row[qtd_total]";
						}
					} else {
						echo "Nenhuma impressora cadastrada.";
					}
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Aguardando Retorno
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                        $query = 'SELECT count(*) as qtd_retorno FROM glpi.glpi_printers prt LEFT JOIN glpi.glpi_locations AS loc ON prt.locations_id = loc.id WHERE prt.states_id = "5";';
                                        $dados = buscar_dados($query);

                                        if ($dados->num_rows > 0) {
                                                while($row = $dados->fetch_assoc()){
                                                        echo "$row[qtd_retorno]";
                                                }
                                        } else {
                                                echo "Nenhuma impressora cadastrada.";
                                        }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Em manutenção (Centermaq)
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                        $query = 'SELECT count(*) as qtd_manutencao FROM glpi.glpi_printers prt LEFT JOIN glpi.glpi_locations AS loc ON prt.locations_id = loc.id WHERE prt.states_id = "4";';
                                        $dados = buscar_dados($query);

                                        if ($dados->num_rows > 0) {
                                                while($row = $dados->fetch_assoc()){
                                                        echo "$row[qtd_manutencao]";
                                                }
                                        } else {
                                                echo "Nenhuma impressora cadastrada.";
                                        }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Aguardando Manutenção (Chamado aberto)
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                        $query = 'SELECT count(*) as qtd_aguardando_manutencao FROM glpi.glpi_printers prt LEFT JOIN glpi.glpi_locations AS loc ON prt.locations_id = loc.id WHERE prt.states_id = "6";';
                                        $dados = buscar_dados($query);

                                        if ($dados->num_rows > 0) {
                                                while($row = $dados->fetch_assoc()){
                                                        echo "$row[qtd_aguardando_manutencao]";
                                                }
                                        } else {
                                                echo "Nenhuma impressora aguardando manutenção.";
                                        }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Reserva (Na sala da TI)
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                        $query = 'SELECT count(*) as qtd_reserva FROM glpi.glpi_printers prt LEFT JOIN glpi.glpi_locations AS loc ON prt.locations_id = loc.id WHERE prt.states_id = "7";';
                                        $dados = buscar_dados($query);

                                        if ($dados->num_rows > 0) {
                                                while($row = $dados->fetch_assoc()){
                                                        echo "$row[qtd_reserva]";
                                                }
                                        } else {
                                                echo "Nenhuma impressora cadastrada.";
                                        }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center" style="margin-top: 15px;">
                <h3>Toners</h3>
            </div>
            <div class="row align-items-center" style="margin-top: 10px;">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: HP 408/HP 432
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 1 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: M5360RX/M5370LX
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 10 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Black C710/C711
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 2 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Ciano C710/C711
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 3 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Magenta C710/C711
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 4 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Yellow C710/C711
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 5 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" style="margin-top: 10px;">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Konica C284 Black
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 6 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Konica C284 Magenta
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 7 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Konica C284 Yellow
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 8 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: Konica C284 Ciano
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 9 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: GX-6010 Yellow
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 11 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: GX-6010 Black
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 12 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" style="margin-top: 10px;">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: GX-6010 Magenta
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 13 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: GX-6010 Ciano
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 14 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: L-15160 Yellow
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 15 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: L-15160 Black
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 16 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: L-15160 Ciano
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 17 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Toners: L-15160 Magenta
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'qtd_toner_estoque' FROM mov_toner WHERE id_toner = 18 AND status = 'Em Estoque';");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[qtd_toner_estoque]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center" style="margin-top: 15px;">
                <h3>Demais informações</h3>
            </div>
            <div class="row align-items-center" style="margin-top: 10px;">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Nobreaks em Manutenção
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'nobreak_manutencao' FROM manutencao_nobreaks WHERE data_recebimento IS NULL;");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[nobreak_manutencao]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Materiais a Descartar
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                    $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    $dados = $db->query("SELECT count(*) as 'material_descartar' FROM descarte_material WHERE saida IS NULL;");
                                    while ($row = $dados->fetchArray()) {
                                        echo "$row[material_descartar]";
                                    }
                                    $db->close();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery-3.5.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap-4.5.2.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
