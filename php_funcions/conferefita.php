<?php  
    use PHPMailer\PHPMailer\PHPMailer;
    require '../vendor/autoload.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verificar se a chave "setor" está definida no array $_POST
        if (isset($_POST['datahora'], $_POST['tecnicos'], $_POST['temperatura_ar'], $_POST['observacoes'])) {
            $datahora = $_POST['datahora'];
            $tecnicos = $_POST['tecnicos'];
            $temperatura_ar = $_POST['temperatura_ar'];
            $observacoes = $_POST['observacoes'];
            
            // Evitar injeção de SQL usando prepared statements
            $db = new SQLite3('../db_folder/db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            $stmt = $db->prepare('INSERT INTO "chk_fita" (datahora, tecnico, temperatura_ar, observacoes) VALUES (:datahora, :tecnico, :temperatura_ar, :observacoes)');
            $stmt->bindValue(':datahora', $datahora, SQLITE3_TEXT);
            $stmt->bindValue(':tecnico', $tecnicos, SQLITE3_TEXT);
            $stmt->bindValue(':temperatura_ar', $temperatura_ar, SQLITE3_TEXT);
            $stmt->bindValue(':observacoes', $observacoes, SQLITE3_TEXT);
            $stmt->execute();
        
            // Fechar a conexão com o banco de dados
            $db->close();

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.hosp.unimedaracatuba.com.br';
            $mail->Port = 25;
            $mail->SMTPAuth = false;
            $mail->setFrom('naoresponda@unimedaracatuba.com.br', 'Tecnologia da Informacao - Hospital Unimed Aracatuba');
            $mail->addReplyTo('luiz.esilva@unimedaracatuba.com.br', 'Tecnologia da Informacao - Hospital Unimed Aracatuba');
            $mail->addAddress('luiz.esilva@unimedaracatuba.com.br');
	    $mail->addAddress('ti@unimedaracatuba.com.br');
            $mail->Subject = 'Aviso - Troca da Fita de Backup';
            $datahora_formatada = new DateTime($datahora);
            $datahora = $datahora_formatada->format('d/m/Y - H:i');
            if (!isset($_POST['observacoes'])) {
                $mail->Body = 'A fita de backup foi substituida no dia e hora ' . $datahora . " pelo tecnico " . $tecnicos . " com a seguinte observacoes" . $observacoes;
                if (!$mail->send()) {
                echo 'Erro na entrega do e-mail: ' . $mail->ErrorInfo;
                } else {
                    echo 'O e-mail foi enviado';
                }
            } else {
                $mail->Body = 'A fita de backup foi substituida no dia e hora ' . $datahora . " pelo tecnico " . $tecnicos . ".";
                if (!$mail->send()) {
                echo 'Erro na entrega do e-mail: ' . $mail->ErrorInfo;
                } else {
                    echo 'O e-mail foi enviado';
                }
            }

            // Redirecionar para a página principal após a inserção no banco de dados
            header('Refresh: 0; URL=../fita_backup.php');
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
