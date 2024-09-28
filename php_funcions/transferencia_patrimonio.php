<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['datahora'], $_POST['tecnicos'], $_POST['n_patrimonio'], $_POST['observacoes'], $_POST['localidade'])) {
         $datahora = $_POST['datahora'];
         $tecnicos = $_POST['tecnicos'];
         $localidades = $_POST['localidade'];
         $n_patrimonio = $_POST['n_patrimonio'];
         $observacoes = $_POST['observacoes'];
         
         $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
         $stmt = $db->prepare('INSERT INTO "patrimonio" (datahora, tecnico, n_patrimonio, id_localidade, observacoes, enviado) VALUES (:datahora, :tecnico, :n_patrimonio, :localidade, :observacoes, :enviado)');
         $stmt->bindValue(':datahora', $datahora, SQLITE3_TEXT);
         $stmt->bindValue(':tecnico', $tecnicos, SQLITE3_TEXT);
         $stmt->bindValue(':n_patrimonio', $n_patrimonio, SQLITE3_TEXT);
         $stmt->bindValue(':localidade', $localidades, SQLITE3_TEXT);
         $stmt->bindValue(':observacoes', $observacoes, SQLITE3_TEXT);
         $stmt->bindValue(':enviado', "Não Enviado", SQLITE3_TEXT);
         $stmt->execute();

         $db->close();

         header('Refresh: 0; URL=../patrimonio.php');
        }
    }
?>