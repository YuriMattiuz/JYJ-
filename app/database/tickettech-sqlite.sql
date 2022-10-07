PRAGMA foreign_keys=OFF; 

CREATE TABLE filmes( 
      id  INTEGER    NOT NULL  , 
      titulo text   NOT NULL  , 
      genero text   NOT NULL  , 
      classificacao text   NOT NULL  , 
      horario text   NOT NULL  , 
      sala text   NOT NULL  , 
      salas_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(salas_id) REFERENCES salas(id)) ; 

CREATE TABLE funcionarios( 
      nome text   NOT NULL  , 
      id  INTEGER    NOT NULL  , 
      rg text   NOT NULL  , 
      entrada text   NOT NULL  , 
      saida text   NOT NULL  , 
      usuarios_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(usuarios_id) REFERENCES usuarios(id)) ; 

CREATE TABLE poltronas( 
      id  INTEGER    NOT NULL  , 
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
 PRIMARY KEY (id),
FOREIGN KEY(salas_id) REFERENCES salas(id)) ; 

CREATE TABLE salas( 
      id  INTEGER    NOT NULL  , 
      status text   , 
      filme text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE usuarios( 
      id  INTEGER    NOT NULL  , 
      user text   , 
      senha text   , 
      acesso text   , 
      rg text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vendas( 
      id  INTEGER    NOT NULL  , 
      filme text   , 
      sessao text   , 
      sala int   , 
      poltrona int   , 
      ingresso text   , 
      filmes_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(filmes_id) REFERENCES filmes(id)) ; 

 
 
  
