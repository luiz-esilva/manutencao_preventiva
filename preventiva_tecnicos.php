<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manutenções Preventivas TI/HUA - Preventiva por Técnicos</title>
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
                <h3>Andamento das Manutenções Preventivas</h3>
            </div>
            <div class="row align-items-center">
                <!-- Alex Rebequi -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Alex Rebequi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Diaria</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no dia</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d');
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Alex Rebequi' AND DATE(data_realizado_final) = '$data_hoje';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Mario Henrique -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Mario Henrique
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Diaria</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no dia</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d');
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Mario Henrique' AND DATE(data_realizado_final) = '$data_hoje';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Kaique Miranda -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Kaique Miranda
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Diaria</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no dia</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d');
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Kaique Miranda' AND DATE(data_realizado_final) = '$data_hoje';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Fernando Mirim -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Fernando Sgobbi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Diaria</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no dia</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d');
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Fernando Sgobi' AND DATE(data_realizado_final) = '$data_hoje';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Gabriel Ribeiro -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Gabriel Ribeiro
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Diaria</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no dia</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d');
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Gabriel Ribeiro' AND DATE(data_realizado_final) = '$data_hoje';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center" style="margin-top: 10px;">
                <!-- Alex Rebequi -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Alex Rebequi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Semanal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas na semana</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $dia_semana = date('w', strtotime($data_hoje));
                                $data_inicio_semana = date('Y-m-d', strtotime("-$dia_semana days", strtotime($data_hoje)));
                                $data_fim_semana = date('Y-m-d', strtotime("+6 days", strtotime($data_inicio_semana)));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Alex Rebequi' AND data_realizado_final >= '$data_inicio_semana' AND data_realizado_final <= '$data_fim_semana';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Mario Henrique -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Mario Henrique
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Semanal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas na semana</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $dia_semana = date('w', strtotime($data_hoje));
                                $data_inicio_semana = date('Y-m-d', strtotime("-$dia_semana days", strtotime($data_hoje)));
                                $data_fim_semana = date('Y-m-d', strtotime("+6 days", strtotime($data_inicio_semana)));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Mario Henrique' AND data_realizado_final >= '$data_inicio_semana' AND data_realizado_final <= '$data_fim_semana';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Kaique Miranda -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Kaique Miranda
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Semanal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas na semana</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $dia_semana = date('w', strtotime($data_hoje));
                                $data_inicio_semana = date('Y-m-d', strtotime("-$dia_semana days", strtotime($data_hoje)));
                                $data_fim_semana = date('Y-m-d', strtotime("+6 days", strtotime($data_inicio_semana)));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Kaique Miranda' AND data_realizado_final >= '$data_inicio_semana' AND data_realizado_final <= '$data_fim_semana';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Fernando Mirim -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Fernando Sgobbi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Semanal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas na semana</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $dia_semana = date('w', strtotime($data_hoje));
                                $data_inicio_semana = date('Y-m-d', strtotime("-$dia_semana days", strtotime($data_hoje)));
                                $data_fim_semana = date('Y-m-d', strtotime("+6 days", strtotime($data_inicio_semana)));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Fernando Sgobi' AND data_realizado_final >= '$data_inicio_semana' AND data_realizado_final <= '$data_fim_semana';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Gabriel Ribeiro -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Gabriel Ribeiro
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Semanal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas na semana</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $dia_semana = date('w', strtotime($data_hoje));
                                $data_inicio_semana = date('Y-m-d', strtotime("-$dia_semana days", strtotime($data_hoje)));
                                $data_fim_semana = date('Y-m-d', strtotime("+6 days", strtotime($data_inicio_semana)));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Gabriel Ribeiro' AND data_realizado_final >= '$data_inicio_semana' AND data_realizado_final <= '$data_fim_semana';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center" style="margin-top: 10px;">
                <!-- Alex Rebequi -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Alex Rebequi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Mensal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no mês</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $mes_atual = date('m', strtotime($data_hoje));
                                $ano_atual = date('Y', strtotime($data_hoje));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Alex Rebequi' AND strftime('%m', data_realizado_final) = '$mes_atual' AND strftime('%Y', data_realizado_final) = '$ano_atual';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Mario Henrique -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Mario Henrique
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Mensal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no mês</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $mes_atual = date('m', strtotime($data_hoje));
                                $ano_atual = date('Y', strtotime($data_hoje));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Mario Henrique' AND strftime('%m', data_realizado_final) = '$mes_atual' AND strftime('%Y', data_realizado_final) = '$ano_atual';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Kaique Miranda -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Kaique Miranda
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Mensal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no mês</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $mes_atual = date('m', strtotime($data_hoje));
                                $ano_atual = date('Y', strtotime($data_hoje));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Kaique Miranda' AND strftime('%m', data_realizado_final) = '$mes_atual' AND strftime('%Y', data_realizado_final) = '$ano_atual';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Fernando Mirim -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Fernando Sgobbi
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Mensal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no mês</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $mes_atual = date('m', strtotime($data_hoje));
                                $ano_atual = date('Y', strtotime($data_hoje));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Fernando Sgobi' AND strftime('%m', data_realizado_final) = '$mes_atual' AND strftime('%Y', data_realizado_final) = '$ano_atual';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Gabriel Ribeiro -->
                <div class="col">      
                    <div class="card text-center">
                        <div class="card-header">
                            Gabriel Ribeiro
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Mensal</h5>
                            <p class="card-text">Segue abaixo a quantidade de manutenções preventivas realizadas no mês</p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <?php
                                $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                $data_hoje = date('Y-m-d', strtotime('now'));
                                $mes_atual = date('m', strtotime($data_hoje));
                                $ano_atual = date('Y', strtotime($data_hoje));
                                $dados = $db->query("SELECT COUNT(*) as qtd_preventiva FROM reg_preventiva WHERE tecnico = 'Gabriel Ribeiro' AND strftime('%m', data_realizado_final) = '$mes_atual' AND strftime('%Y', data_realizado_final) = '$ano_atual';");
                                while ($row = $dados->fetchArray()) {
                                    if ($row['qtd_preventiva'] == 1) {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventiva realizada</div>";
                                    } elseif ($row['qtd_preventiva'] == 0) {
                                        echo "<div>Nenhuma manutenção preventiva realizada</div>";
                                    } else {
                                        echo "<div style='font-weight: bold;'>$row[qtd_preventiva] preventivas realizadas</div>";
                                    }
                                }
                                $db->close();
                            ?>
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









