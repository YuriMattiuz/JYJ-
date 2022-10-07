CREATE TABLE filmes( 
      id  SERIAL    NOT NULL  , 
      titulo text   NOT NULL  , 
      genero text   NOT NULL  , 
      classificacao text   NOT NULL  , 
      horario text   NOT NULL  , 
      sala text   NOT NULL  , 
      salas_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE funcionarios( 
      nome text   NOT NULL  , 
      id  SERIAL    NOT NULL  , 
      rg text   NOT NULL  , 
      entrada text   NOT NULL  , 
      saida text   NOT NULL  , 
      usuarios_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE poltronas( 
      id  SERIAL    NOT NULL  , 
      salas integer   , 
      poltrona1 integer   , 
      poltrona2 integer   , 
      poltrona4 integer   , 
      poltrona5 integer   , 
      poltrona6 integer   , 
      poltrona7 integer   , 
      poltron8 integer   , 
      poltrona9 integer   , 
      poltrona10 integer   , 
      poltrona11 integer   , 
      poltrona12 integer   , 
      poltrona13 integer   , 
      poltrona14 integer   , 
      poltrona15 integer   , 
      poltrona16 integer   , 
      poltrona17 integer   , 
      poltrona18 integer   , 
      poltrona19 integer   , 
      poltrona20 integer   , 
      column_22 integer   , 
      poltrona21 integer   , 
      poltrona23 integer   , 
      poltrona24 integer   , 
      poltrona25 integer   , 
      poltrona26 integer   , 
      poltrona27 integer   , 
      poltrona28 integer   , 
      poltrona29 integer   , 
      poltrona30 integer   , 
      salas_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE salas( 
      id  SERIAL    NOT NULL  , 
      status text   , 
      filme text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE usuarios( 
      id  SERIAL    NOT NULL  , 
      user text   , 
      senha text   , 
      acesso text   , 
      rg text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vendas( 
      id  SERIAL    NOT NULL  , 
      filme text   , 
      sessao text   , 
      sala integer   , 
      poltrona integer   , 
      ingresso text   , 
      filmes_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE filmes ADD CONSTRAINT fk_filmes_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE funcionarios ADD CONSTRAINT fk_funcionarios_1 FOREIGN KEY (usuarios_id) references usuarios(id); 
ALTER TABLE poltronas ADD CONSTRAINT fk_poltronas_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE vendas ADD CONSTRAINT fk_vendas_1 FOREIGN KEY (filmes_id) references filmes(id); 

  
