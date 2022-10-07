CREATE TABLE filmes( 
      id  integer generated by default as identity     NOT NULL , 
      titulo blob sub_type 1    NOT NULL , 
      genero blob sub_type 1    NOT NULL , 
      classificacao blob sub_type 1    NOT NULL , 
      horario blob sub_type 1    NOT NULL , 
      sala blob sub_type 1    NOT NULL , 
      salas_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE funcionarios( 
      nome blob sub_type 1    NOT NULL , 
      id  integer generated by default as identity     NOT NULL , 
      rg blob sub_type 1    NOT NULL , 
      entrada blob sub_type 1    NOT NULL , 
      saida blob sub_type 1    NOT NULL , 
      usuarios_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE poltronas( 
      id  integer generated by default as identity     NOT NULL , 
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
      salas_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE salas( 
      id  integer generated by default as identity     NOT NULL , 
      status blob sub_type 1   , 
      filme blob sub_type 1   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE usuarios( 
      id  integer generated by default as identity     NOT NULL , 
      user blob sub_type 1   , 
      senha blob sub_type 1   , 
      acesso blob sub_type 1   , 
      rg blob sub_type 1   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vendas( 
      id  integer generated by default as identity     NOT NULL , 
      filme blob sub_type 1   , 
      sessao blob sub_type 1   , 
      sala integer   , 
      poltrona integer   , 
      ingresso blob sub_type 1   , 
      filmes_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE filmes ADD CONSTRAINT fk_filmes_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE funcionarios ADD CONSTRAINT fk_funcionarios_1 FOREIGN KEY (usuarios_id) references usuarios(id); 
ALTER TABLE poltronas ADD CONSTRAINT fk_poltronas_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE vendas ADD CONSTRAINT fk_vendas_1 FOREIGN KEY (filmes_id) references filmes(id); 

  
