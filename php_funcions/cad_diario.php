<?php  
    use PHPMailer\PHPMailer\PHPMailer;
    require '../vendor/autoload.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['datahorario_diario'], $_POST['tecnico_diario'], $_POST['diario'])) {
            $datahorario_diario = $_POST['datahorario_diario'];
            $tecnico_diario = $_POST['tecnico_diario'];
            $diario = $_POST['diario'];
	                
            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "chk_diario" (datahorario_diario, tecnico_diario, diario) VALUES (:datahorario_diario, :tecnico, :diario)');
            $stmt->bindValue(':datahorario_diario', $datahorario_diario, SQLITE3_TEXT);
            $stmt->bindValue(':tecnico', $tecnico_diario, SQLITE3_TEXT);
            $stmt->bindValue(':diario', $diario, SQLITE3_TEXT);
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->Host = 'smtp.unimedaracatuba.com.br';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
	    $mail->SMTPSecure = 'ssl';
	    $mail->Username = 'naoresponder@unimedaracatuba.com.br';
	    $mail->Password = 'Mgnjy#R#fnud7@df';
            $mail->setFrom('naoresponder@unimedaracatuba.com.br', 'Tecnologia da Informacao - Hospital Unimed Aracatuba');
            $mail->addReplyTo('luiz.esilva@unimedaracatuba.com.br', 'Tecnologia da Informacao - Hospital Unimed Aracatuba');
            $mail->addAddress('luiz.esilva@unimedaracatuba.com.br');
	    $mail->addAddress('alex.rebequi@unimedaracatuba.com.br');
	    $mail->addAddress('alex.andrade@unimedaracatuba.com.br');
            $mail->Subject = 'Diario Tecnico - Espaco Viver Bem';
            $datahorario_diario_formatada = new DateTime($datahorario_diario);
            $datahorario_diario = $datahorario_diario_formatada->format('d/m/Y - H:i');
            if (!isset($_POST['observacoes'])) {
                $mail->Body = 'A rotina de preenchimento do diario tecnico do EVB, foi realizada hoje ' . $datahorario_diario . " pelo tecnico " . $tecnico_diario . ".\nAs seguintes informacoes foram preenchidas pelo tecnico: \n\n" . $diario;
                if (!$mail->send()) {
                echo 'Erro na entrega do e-mail: ' . $mail->ErrorInfo;
                } else {
                    echo 'O e-mail foi enviado';
                }
            } else {
                $mail->Body = 'A rotina de reiniciar o totem, foi realizada hoje ' . $datahorario_diario . " pelo tecnico " . $tecnico_diario . ".";
                if (!$mail->send()) {
                echo 'Erro na entrega do e-mail: ' . $mail->ErrorInfo;
                } else {
                    echo 'O e-mail foi enviado';
                }
            }

            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../diario_evb.php');
            exit(); // Certificar-se de que nenhum código adicional seja executado após o redirecionamento
        } else {
            // A chave "setor" não está definida em $_POST
            echo "Erro: A chave 'setor' não está definida.";
        }
    } else {
        // O método da requisição não é POST
        echo "Erro: Método de requisição inválido.";
    }
?>
