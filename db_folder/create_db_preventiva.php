<?php
  $db = new SQLite3('db_preventiva.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

  // Criar a Tabela: Test_Drum
  $db->query(
    'CREATE TABLE reg_setores (
      id_setor INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      setor_nome TEXT NOT NULL
    );
    
    CREATE TABLE reg_localidades (
      id_localidade INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      localidade_nome TEXT NOT NULL,
      id_setor INTEGER,
      FOREIGN KEY (id_setor) REFERENCES reg_setores (id_setor)
    );

    CREATE TABLE reg_computadores (
        id_computadores INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        computador TEXT NOT NULL,
        id_localidade INTEGER,
        periodo_limpeza TEXT NOT NULL,
        data_ultimo_realizado DATETIME,
        FOREIGN KEY (id_localidade) REFERENCES reg_localidades (id_localidade)
    );

    CREATE TABLE reg_preventiva (
        id_preventiva INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        id_computadores INTEGER,
        tecnico TEXT NOT NULL,
        imagem_antes TEXT NOT NULL,
        imagem_patrimonio TEXT NOT NULL,
        data_realizado DATETIME NOT NULL,
        data_realizado_final DATETIME,
        FOREIGN KEY (id_computadores) REFERENCES reg_computadores (id_computadores)
    );
    
    CREATE TABLE chk_maleta( 
        id_maleta INTEGER PRIMARY KEY AUTOINCREMENT, 
        nome_tecnico TEXT, 
        foto_maleta TEXT, 
        data_hora DATETIME NOT NULL,
        fita_duplaface TEXT, 
        fita_larga TEXT, 
        rolo_velcro TEXT, 
        fita_hellerman TEXT, 
        spray_alcool TEXT, 
        pano_limpo TEXT, 
        keystone_bticino TEXT, 
        keystone_schneider TEXT, 
        pote_rj45 TEXT, 
        caneta_marcador TEXT, 
        caneta_comum TEXT, 
        phillips_fina TEXT, 
        phillips_finagrande TEXT, 
        phillips_grossa TEXT, 
        tork_t10 TEXT, 
        fenda_pequena TEXT, 
        teste_multimetro TEXT, 
        teste_cabos TEXT, 
        patchcord TEXT, 
        punchdown TEXT, 
        alicate_crimpar TEXT, 
        alicate_corte TEXT, 
        tesoura TEXT, 
        decapador_cabos TEXT, 
        estilete TEXT, 
        escova TEXT 
    );
    
    CREATE TABLE chk_fita( 
        id_fita INTEGER PRIMARY KEY AUTOINCREMENT, 
        datahora DATETIME NOT NULL, 
        tecnico TEXT NOT NULL,
        temperatura_ar TEXT NOT NULL,
        observacoes TEXT 
    );
    
    CREATE TABLE patrimonio(
      id_patrimonio INTEGER PRIMARY KEY AUTOINCREMENT,
      datahora DATETIME NOT NULL,
      tecnico TEXT NOT NULL,
      patrimonio TEXT NOT NULL,
      observacoes TEXT,
      enviado TEXT
    );
    
    CREATE TABLE chk_totem(
        id_totem INTEGER PRIMARY KEY AUTOINCREMENT,
        datahora_restart DATETIME NOT NULL,
        tecnico TEXT NOT NULL,
        observacoes TEXT
    );
    
    CREATE TABLE chk_sala(
        id_sala INTEGER PRIMARY KEY AUTOINCREMENT,
        datahora DATETIME NOT NULL,
        nome_tecnico TEXT NOT NULL,
        foto_sala TEXT NOT NULL,
        obs_sala TEXT NOT NULL
    )'
  );

  // Close the connection
  $db->close();

  echo("Banco de dados criado com sucesso !");
?>
