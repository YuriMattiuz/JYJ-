CREATE TABLE filmes( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `titulo` text   NOT NULL  , 
      `genero` text   NOT NULL  , 
      `classificacao` text   NOT NULL  , 
      `horario` text   NOT NULL  , 
      `sala` text   NOT NULL  , 
      `salas_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE funcionarios( 
      `nome` text   NOT NULL  , 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `rg` text   NOT NULL  , 
      `entrada` text   NOT NULL  , 
      `saida` text   NOT NULL  , 
      `usuarios_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE poltronas( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `salas` int   , 
      `poltrona1` int   , 
      `poltrona2` int   , 
      `poltrona4` int   , 
      `poltrona5` int   , 
      `poltrona6` int   , 
      `poltrona7` int   , 
      `poltron8` int   , 
      `poltrona9` int   , 
      `poltrona10` int   , 
      `poltrona11` int   , 
      `poltrona12` int   , 
      `poltrona13` int   , 
      `poltrona14` int   , 
      `poltrona15` int   , 
      `poltrona16` int   , 
      `poltrona17` int   , 
      `poltrona18` int   , 
      `poltrona19` int   , 
      `poltrona20` int   , 
      `column_22` int   , 
      `poltrona21` int   , 
      `poltrona23` int   , 
      `poltrona24` int   , 
      `poltrona25` int   , 
      `poltrona26` int   , 
      `poltrona27` int   , 
      `poltrona28` int   , 
      `poltrona29` int   , 
      `poltrona30` int   , 
      `salas_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE salas( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `status` text   , 
      `filme` text   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE usuarios( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `user` text   , 
      `senha` text   , 
      `acesso` text   , 
      `rg` text   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE vendas( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `filme` text   , 
      `sessao` text   , 
      `sala` int   , 
      `poltrona` int   , 
      `ingresso` text   , 
      `filmes_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
  
 ALTER TABLE filmes ADD CONSTRAINT fk_filmes_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE funcionarios ADD CONSTRAINT fk_funcionarios_1 FOREIGN KEY (usuarios_id) references usuarios(id); 
ALTER TABLE poltronas ADD CONSTRAINT fk_poltronas_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE vendas ADD CONSTRAINT fk_vendas_1 FOREIGN KEY (filmes_id) references filmes(id); 

  
