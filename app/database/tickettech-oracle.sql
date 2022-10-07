CREATE TABLE filmes( 
      id number(10)    NOT NULL , 
      titulo varchar(3000)    NOT NULL , 
      genero varchar(3000)    NOT NULL , 
      classificacao varchar(3000)    NOT NULL , 
      horario varchar(3000)    NOT NULL , 
      sala varchar(3000)    NOT NULL , 
      salas_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE funcionarios( 
      nome varchar(3000)    NOT NULL , 
      id number(10)    NOT NULL , 
      rg varchar(3000)    NOT NULL , 
      entrada varchar(3000)    NOT NULL , 
      saida varchar(3000)    NOT NULL , 
      usuarios_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE poltronas( 
      id number(10)    NOT NULL , 
      salas number(10)   , 
      poltrona1 number(10)   , 
      poltrona2 number(10)   , 
      poltrona4 number(10)   , 
      poltrona5 number(10)   , 
      poltrona6 number(10)   , 
      poltrona7 number(10)   , 
      poltron8 number(10)   , 
      poltrona9 number(10)   , 
      poltrona10 number(10)   , 
      poltrona11 number(10)   , 
      poltrona12 number(10)   , 
      poltrona13 number(10)   , 
      poltrona14 number(10)   , 
      poltrona15 number(10)   , 
      poltrona16 number(10)   , 
      poltrona17 number(10)   , 
      poltrona18 number(10)   , 
      poltrona19 number(10)   , 
      poltrona20 number(10)   , 
      column_22 number(10)   , 
      poltrona21 number(10)   , 
      poltrona23 number(10)   , 
      poltrona24 number(10)   , 
      poltrona25 number(10)   , 
      poltrona26 number(10)   , 
      poltrona27 number(10)   , 
      poltrona28 number(10)   , 
      poltrona29 number(10)   , 
      poltrona30 number(10)   , 
      salas_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE salas( 
      id number(10)    NOT NULL , 
      status varchar(3000)   , 
      filme varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE usuarios( 
      id number(10)    NOT NULL , 
      user varchar(3000)   , 
      senha varchar(3000)   , 
      acesso varchar(3000)   , 
      rg varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vendas( 
      id number(10)    NOT NULL , 
      filme varchar(3000)   , 
      sessao varchar(3000)   , 
      sala number(10)   , 
      poltrona number(10)   , 
      ingresso varchar(3000)   , 
      filmes_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE filmes ADD CONSTRAINT fk_filmes_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE funcionarios ADD CONSTRAINT fk_funcionarios_1 FOREIGN KEY (usuarios_id) references usuarios(id); 
ALTER TABLE poltronas ADD CONSTRAINT fk_poltronas_1 FOREIGN KEY (salas_id) references salas(id); 
ALTER TABLE vendas ADD CONSTRAINT fk_vendas_1 FOREIGN KEY (filmes_id) references filmes(id); 
 CREATE SEQUENCE filmes_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER filmes_id_seq_tr 

BEFORE INSERT ON filmes FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT filmes_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE funcionarios_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER funcionarios_id_seq_tr 

BEFORE INSERT ON funcionarios FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT funcionarios_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE poltronas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER poltronas_id_seq_tr 

BEFORE INSERT ON poltronas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT poltronas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE salas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER salas_id_seq_tr 

BEFORE INSERT ON salas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT salas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE usuarios_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER usuarios_id_seq_tr 

BEFORE INSERT ON usuarios FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT usuarios_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE vendas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER vendas_id_seq_tr 

BEFORE INSERT ON vendas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT vendas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
