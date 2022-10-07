CREATE TABLE filmes( 
      id  INT IDENTITY    NOT NULL  , 
      titulo nvarchar(max)   NOT NULL  , 
      genero nvarchar(max)   NOT NULL  , 
      classificacao nvarchar(max)   NOT NULL  , 
      horario nvarchar(max)   NOT NULL  , 
      sala nvarchar(max)   NOT NULL  , 
      salas_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE funcionarios( 
      nome nvarchar(max)   NOT NULL  , 
      id  INT IDENTITY    NOT NULL  , 
      rg nvarchar(max)   NOT NULL  , 
      entrada nvarchar(max)   NOT NULL  , 
      saida nvarchar(max)   NOT NULL  , 
      usuarios_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE poltronas( 
      id  INT IDENTITY    NOT NULL  , 
      salas int   , 
      poltrona1 int   , 
      poltrona2 int   , 
      poltrona4 int   , 
      poltrona5 int   , 
      poltrona6 int   , 
      poltrona7 int   , 
      poltron8 int   , 
      poltrona9 int   , 
      poltrona10 int   , 
      poltrona11 int   , 
      poltrona12 int   , 
      poltrona13 int   , 
      poltrona14 int   , 
      poltrona15 int   , 
      poltrona16 int   , 
      poltrona17 int   , 
      poltrona18 int   , 
      poltrona19 int   , 
      poltrona20 int   , 
      column_22 int   , 
      poltrona21 int   , 
      poltrona23 int   , 
      poltrona24 int   , 
      poltrona25 int   , 
      poltrona26 int   , 
      poltrona27 int   , 
      poltrona28 int   , 
      poltrona29 int   , 
      poltrona30 int   , 
      salas_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE salas( 
      id  INT IDENTITY    NOT NULL  , 
      status nvarchar(max)   , 
      filme nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE usuarios( 
      id  INT IDENTITY    NOT NULL  , 
      user nvarchar(max)   , 
      senha nvarchar(max)   , 
      acesso nvarchar(max)   , 
      rg nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vendas( 
      id  INT IDENTITY    NOT NULL  , 
      filme nvarchar(max)   , 
      sessao nvarchar(max)   , 
      sala int   , 
      poltrona int   , 
      ingresso nvarchar(max)   , 
      filmes_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE filmes ADD CONSTRAINT fk_filmes_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE funcionarios ADD CONSTRAINT fk_funcionarios_1 FOREIGN KEY (usuarios_id) references usuarios(id); 
ALTER TABLE poltronas ADD CONSTRAINT fk_poltronas_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE vendas ADD CONSTRAINT fk_vendas_1 FOREIGN KEY (filmes_id) references filmes(id); 

  
