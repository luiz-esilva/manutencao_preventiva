<?php
    // Função para obter dados do banco de dados
    function buscar_dados($query) {
        // Configurações do banco de dados
        $servername = "192.168.11.146";
        $username = "root";
        $password = "h4ck3d";
        $dbname = "glpi";
        
        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verifica a conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Define a codificação de caracteres
        $conn->set_charset("utf8mb4");
        
        // Executa a consulta
        $result = $conn->query($query);
        
        // Verifica se a consulta foi bem-sucedida
        //if (!$result) {
        //    die("Query failed: " . $conn->error);
        //}
        
        // Armazena os dados em um array
        //$data = [];
        //while ($row = $result->fetch_assoc()) {
        //    $data[] = $row;
        //}
        
        // Fecha a conexão
        //$conn->close();
        
        // Retorna os dados
        return $result;
    }
?>
