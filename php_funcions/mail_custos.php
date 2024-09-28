<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
    $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

    $dados = $db->query("SELECT id_patrimonio, datahora, tecnico, n_patrimonio, observacoes, enviado, localidade_nome, setor_nome FROM patrimonio pt LEFT JOIN reg_localidades lo on lo.id_localidade = pt.id_localidade LEFT JOIN reg_setores se on se.id_setor = lo.id_setor WHERE pt.enviado = 'Não Enviado';");
    $mailContent = "<html><body><table border='1' style='border-collapse: collapse; text-align: center;'><tr><th style='padding: 5px;'>ID</th><th style='padding: 5px;'>Data e Hora</th><th style='padding: 5px;'>Técnico</th><th style='padding: 5px;'>Nº de Patrimônio</th><th style='padding: 5px;'>Setor</th><th style='padding: 5px;'>Localidade</th><th style='padding: 5px;'>Observações</th></tr>";

    while ($row = $dados->fetchArray()) {
        // Formatando data e hora
        $data_formatada = new DateTime($row['datahora']);
        $mailContent .= "<tr>";
        $mailContent .= "<td style='padding: 5px;'>" . $row['id_patrimonio'] . "</td>";
        $mailContent .= "<td style='padding: 5px;'>" . $data_formatada->format('d/m/Y - H:i') . "</td>";
        $mailContent .= "<td style='padding: 5px;'>" . $row['tecnico'] . "</td>";
        $mailContent .= "<td style='padding: 5px;'><b>" . $row['n_patrimonio'] . "</b></td>";
        $mailContent .= "<td style='padding: 5px;'>" . $row['setor_nome'] . "</td>";
        $mailContent .= "<td style='padding: 5px;'>" . $row['localidade_nome'] . "</td>";
        $mailContent .= "<td style='padding: 5px;'>" . $row['observacoes'] . "</td>";
        $mailContent .= "</tr>";
    }

    $mailContent .= "</table></body></html>";
    $db->close();

    use PHPMailer\PHPMailer\PHPMailer;
    require '../vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    //$mail->SMTPDebug = 2;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->Host = 'smtp.unimedaracatuba.com.br';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = 'naoresponder@unimedaracatuba.com.br';
    $mail->Password = 'Mgnjy#R#fnud7@df';
    $mail->SMTPSecure = 'ssl';
    $mail->setFrom('luiz.esilva@unimedaracatuba.com.br', 'Tecnologia da Informacao - Hospital Unimed Aracatuba');
    $mail->addReplyTo('ti@unimedaracatuba.com.br', 'Tecnologia da Informacao - Hospital Unimed Aracatuba');
    $mail->addReplyTo('luiz.esilva@unimedaracatuba.com.br', 'Tecnologia da Informacao - Hospital Unimed Aracatuba');
    $mail->addAddress('luiz.esilva@unimedaracatuba.com.br');
    $mail->addAddress('ti@unimedaracatuba.com.br');
    $mail->addAddress('patrimonio@unimedaracatuba.com.br');
    $mail->Subject = 'Transferência de patrimônios realizadas pela TI';
    $mail->msgHTML($mailContent);

    if (!$mail->send()) {
        echo 'Erro na entrega do e-mail: ' . $mail->ErrorInfo;
    } else {
        // Alteração de Status de envio do e-mail
        $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $dados = $db->query("SELECT id_patrimonio, datahora, tecnico, n_patrimonio, observacoes, enviado, localidade_nome, setor_nome FROM patrimonio pt LEFT JOIN reg_localidades lo on lo.id_localidade = pt.id_localidade LEFT JOIN reg_setores se on se.id_setor = lo.id_setor WHERE pt.enviado = 'Não Enviado';");
        while ($row = $dados->fetchArray()) {
            $db->exec("UPDATE patrimonio SET enviado = 'Enviado' WHERE id_patrimonio = " . $row['id_patrimonio']);
        }
        $db->close();
        // Redirecionar para a página principal após a inserção no banco de dados
        header('Refresh: 0; URL=../patrimonio.php');
        exit(); // Certificar-se de que nenhum código adicional seja executado após o redirecionamento
    }
?>
