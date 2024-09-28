<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenções Preventivas TI/HUA - Checar Maleta</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="/bootstrap-icons-1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/datatables.min.css" rel="stylesheet">
</head>
<body>
    <!-- Adiciona o menu -->
    <?php
        include "./model/navbar.php";
    ?>

    <!-- Modal Formulário -->
    <div class='modal modal-lg fade' id='modalCheck' tabindex='-1' aria-labelledby='modalCheckLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <form action="./php_funcions/conferemaleta.php" method="POST" enctype="multipart/form-data">
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='modalCheckLabel'>Checklist de Ferramentas da Maleta</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class="container-fluid">
                            <div class="row" style="margin-bottom: 5px;">
                                
                                <div class="row">
                                    <div class="row">
                                        <label for="tecnico">Técnico</label>
                                        <?php
                                            include "./model/equipe_tecnica.php";
                                        ?>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <label for="foto_maleta">Imagem da Maleta (Pós Organização)</label>
                                        <input class="form-control" type="file" name="foto_maleta" id="foto_maleta" required>
                                    </div>
                                </div>

                                <hr style="margin-top: 15px;">

                                <div class="row">
                                    <h4 class="text-center">Insumos</h4>
                                    
                                    <div class="col">
                                        <fieldset>
                                            <div>
                                                <input type="checkbox" name="fita_duplaface" id="fita_duplaface" value="SELECIONADO" />
                                                <label for="fita_duplaface">Fita dupla face</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="fita_larga" id="fita_larga" value="SELECIONADO" />
                                                <label for="fita_larga">Fita larga</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="rolo_velcro" id="rolo_velcro" value="SELECIONADO" />
                                                <label for="size_3">Rolo de velcro</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="fita_hellerman" id="fita_hellerman" value="SELECIONADO" />
                                                <label for="size_3">Maço de fita Hellerman</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col">
                                        <fieldset>
                                            <div>
                                                <input type="checkbox" name="spray_alcool" id="spray_alcool" value="SELECIONADO" />
                                                <label for="size_1">Spray de Alcool</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="pano_limpo" id="pano_limpo" value="SELECIONADO" />
                                                <label for="size_2">Pano Limpo</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="keystone_bticino" id="keystone_bticino" value="SELECIONADO" />
                                                <label for="size_3">2x - Keystone Bticino</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="keystone_schneider" id="keystone_schneider" value="SELECIONADO" />
                                                <label for="size_3">2x - Keystone Schneider</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col">
                                        <fieldset>
                                            <div>
                                                <input type="checkbox" name="pote_rj45" id="pote_rj45" value="SELECIONADO" />
                                                <label for="size_1">RJ45</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="caneta_marcador" id="caneta_marcador" value="SELECIONADO" />
                                                <label for="size_2">Caneta Marcador</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="caneta_comum" id="caneta_comum" value="SELECIONADO" />
                                                <label for="size_3">Caneta Comum</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <hr style="margin-top: 15px;">

                                <div class="row">
                                    <h4 class="text-center">Ferramentas</h4>
                                    <div class="col">
                                        <fieldset>
                                            <div>
                                                <input type="checkbox" name="phillips_fina" id="phillips_fina" value="SELECIONADO" />
                                                <label for="size_1">Chave Phillips - Fina</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="phillips_finagrande" id="phillips_finagrande" value="SELECIONADO" />
                                                <label for="size_2">Chave Phillips - Fina Grande</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="phillips_grossa" id="phillips_grossa" value="SELECIONADO" />
                                                <label for="size_3">Chave Phillips - Grossa</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="tork_t10" id="tork_t10" value="SELECIONADO" />
                                                <label for="size_3">Chave Tork - T10</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="fenda_pequena" id="fenda_pequena" value="SELECIONADO" />
                                                <label for="size_3">Chave de Fenda - Pequena</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col">
                                        <fieldset>
                                            <div>
                                                <input type="checkbox" name="teste_multimetro" id="teste_multimetro" value="SELECIONADO" />
                                                <label for="size_1"><b>Multímetro*</b></label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="teste_cabos" id="teste_cabos" value="SELECIONADO" />
                                                <label for="size_2"><b>Kit testador de cabos*</b></label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="patchcord" id="patchcord" value="SELECIONADO" />
                                                <label for="size_3">Patchcord 3 mts testado</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="punchdown" id="punchdown" value="SELECIONADO" />
                                                <label for="size_1">Punchdown</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="alicate_crimpar" id="alicate_crimpar" value="SELECIONADO" />
                                                <label for="size_2">Alicate de Crimpar</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col">
                                        <fieldset>
                                            <div>
                                                <input type="checkbox" name="alicate_corte" id="alicate_corte" value="SELECIONADO" />
                                                <label for="size_2">Alicate de Corte</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="tesoura" id="tesoura" value="SELECIONADO" />
                                                <label for="size_3">Tesoura</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="decapador_cabos" id="decapador_cabos" value="SELECIONADO" />
                                                <label for="size_3">Decapador de Cabos</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="estilete" id="estilete" value="SELECIONADO" />
                                                <label for="size_1">Estilete</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="escova" id="escova" value="SELECIONADO" />
                                                <label for="size_1">Escova</label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h6>* - Verificar a bateria dos equipamentos.</h6>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <button type='submit' class='btn btn-primary'>Salvar Checklist</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <h3>Cronograma de Verificação</h3>
            <div>Segunda a Quinta verificar as 17:00<br>Sexta Feira as 16:00</div>
        </div>    
        <div class="row" style="margin-top: 10px;">
            <button class="btn btn-dark" type="submit" data-bs-toggle='modal' data-bs-target='#modalCheck'>Checar Maleta</button>
        </div>
    </div>
    <div class="container text-center" style="margin-top: 10px;">
        <div class="row">
            <table id="checks_maleta" class="table table-hover align-middle text-center table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">TÉCNICO</th>
                        <th scope="col">FOTO</th>
                        <th scope="col">HORARIO</th>
                        <th scope="col">DUPLA FACE</th>
                        <th scope="col">FITA LARGA</th>
                        <th scope="col">VELCRO</th>
                        <th scope="col">FITA HELLERMAN</th>
                        <th scope="col">SPRAY ALCOOL</th>
                        <th scope="col">PANO LIMPO</th>
                        <th scope="col">KEYSTONE BTICINO</th>
                        <th scope="col">KEYSTONE SCHNEIDER</th>
                        <th scope="col">RJ45</th>
                        <th scope="col">CANETA MARCADO</th>
                        <th scope="col">CANETA COMUM</th>
                        <th scope="col">PHILLIPS FINA</th>
                        <th scope="col">PHILLIPS FINA GRANDE</th>
                        <th scope="col">PHILLIPS GROSSA</th>
                        <th scope="col">TORK T10</th>
                        <th scope="col">FENDA PEQUENA</th>
                        <th scope="col">TESTE MULTIMETRO</th>
                        <th scope="col">TESTE CABOS</th>
                        <th scope="col">PATCHCORD</th>
                        <th scope="col">PUNCHDOWN</th>
                        <th scope="col">ALICATE CRIMPAR</th>
                        <th scope="col">ALICATE CORTE</th>
                        <th scope="col">TESOURA</th>
                        <th scope="col">DECAPADOR DE CABOS</th>
                        <th scope="col">ESTELITE</th>
                        <th scope="col">ESCOVA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db = new SQLite3('./db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

                        $dados = $db->query("SELECT id_maleta, nome_tecnico, foto_maleta, data_hora, fita_duplaface, fita_larga, rolo_velcro, fita_hellerman, spray_alcool, pano_limpo, keystone_bticino, keystone_schneider, pote_rj45, caneta_marcador, caneta_comum, phillips_fina, phillips_finagrande, phillips_grossa, tork_t10, fenda_pequena, teste_multimetro, teste_cabos, patchcord, punchdown, alicate_crimpar, alicate_corte, tesoura, decapador_cabos, estilete, escova FROM chk_maleta;");
                        while ($row = $dados->fetchArray()) {
                            echo "<tr>";
                            echo "<td>$row[id_maleta]</td>";
                            echo "<td>$row[nome_tecnico]</td>";
                            echo "<td><a href='./imgs/checar_maleta/$row[foto_maleta]' target='_blank'><img src='./imgs/checar_maleta/$row[foto_maleta]' width='100' height='100'></a></td>";
                            echo "<td>$row[data_hora]</td>";
                            if ($row['fita_duplaface'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['fita_larga'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['rolo_velcro'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['fita_hellerman'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['spray_alcool'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['pano_limpo'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['keystone_bticino'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['keystone_schneider'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['pote_rj45'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['caneta_marcador'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['caneta_comum'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['phillips_fina'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['phillips_finagrande'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['phillips_grossa'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['tork_t10'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['fenda_pequena'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['teste_multimetro'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['teste_cabos'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['patchcord'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['punchdown'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['alicate_crimpar'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['alicate_corte'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['tesoura'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['decapador_cabos'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['estilete'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            if ($row['escova'] == "SELECIONADO") {
                                echo "<td><img src='bootstrap-icons-1.11.2/check-circle.svg' alt='Check' width='32' height='32'></td>";
                            } else {
                                echo "<td><img src='bootstrap-icons-1.11.2/circle.svg' alt='Uncheck' width='32' height='32'></td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.5.2.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        new DataTable('#checks_maleta', {
            scrollX: true,
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
