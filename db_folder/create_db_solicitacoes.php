<?php
  $db = new SQLite3('db_solicitacoes.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

  // Criar a Tabela: Test_Drum
  $db->query(
  'CREATE TABLE IF NOT EXISTS "test_drum" (
      "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      "data" DATETIME,
      "setor" VARCHAR NOT NULL,
      "localidade" VARCHAR NOT NULL,
      "porcentagem_drum" INTEGER NOT NULL,
      "imagem" VARCHAR NOT NULL
    )'
  );

  // Close the connection
  $db->close();

  echo("Banco de dados criado com sucesso !");
?>