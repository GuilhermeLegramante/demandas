CREATE TABLE agro_taxa (
  id INT AUTO_INCREMENT NOT NULL,
  codigo INT NOT NULL,
  descricao VARCHAR(100) NOT NULL,
  idusuario INT NOT NULL COMMENT 'FK hsglb_usuarios',
  datahora DATETIME NOT NULL COMMENT 'Ultima modificacao do registro',
  CONSTRAINT fk_idusuario_agro_taxa FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
  PRIMARY KEY (id)
) ENGINE = InnoDB COMMENT = 'Taxas referentes as Marcas' ROW_FORMAT = DEFAULT;

CREATE TABLE agro_taxa_exercicio (
  id INT NOT NULL,
  idtaxa INT NOT NULL COMMENT 'FK agro_taxa',
  exercicio INT NOT NULL,
  idusuario INT NOT NULL,
  datahora DATETIME COMMENT 'Ultima modificacao do registro',
  CONSTRAINT fk_idusuario_agro_taxa_exercicio FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_idtaxa_agro_taxa_exercicio FOREIGN KEY (idtaxa) REFERENCES agro_taxa (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
  PRIMARY KEY (id)
) ENGINE = InnoDB COMMENT = 'Relacao de Taxas por Exercicio' ROW_FORMAT = DEFAULT;

CREATE TABLE agro_marca (
  id INT NOT NULL,
  idmunicipe INT NOT NULL,
  idtaxaexercicio INT,
  path VARCHAR(500) NOT NULL COMMENT 'Localizacao do arquivo da marca',
  visivel TINYINT NOT NULL DEFAULT '1' COMMENT 'Visibilidade da marca',
  idusuario INT NOT NULL,
  datahora DATETIME NOT NULL,
  CONSTRAINT idmunicipe FOREIGN KEY (idmunicipe) REFERENCES hscad_cadmunicipal (inscricaomunicipal) ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idtaxaexercicio FOREIGN KEY (idtaxaexercicio) REFERENCES agro_taxa_exercicio (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
  PRIMARY KEY (id)
) ENGINE = InnoDB COMMENT = 'Cadastro de Marcacao Animal' ROW_FORMAT = DEFAULT;

ALTER TABLE
  agro_taxa_exercicio DROP FOREIGN KEY fk_idusuario_agro_taxa_exercicio,
  DROP FOREIGN KEY fk_idtaxa_agro_taxa_exercicio,
ADD
  valor DOUBLE NOT NULL COMMENT 'Valor da taxa'
AFTER
  exercicio;

ALTER TABLE
  agro_taxa_exercicio
ADD
  CONSTRAINT fk_idusuario_agro_taxa_exercicio FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
ADD
  CONSTRAINT fk_idtaxa_agro_taxa_exercicio FOREIGN KEY (idtaxa) REFERENCES agro_taxa (id) ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE
  agro_taxa_exercicio
ADD
  UNIQUE INDEX idx_agro_taxa_exercicio_taxa (idtaxa, exercicio);

CREATE TABLE hslog.marcas (
   id INT(10) UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'PK',
   idusuario INT(10) UNSIGNED NOT NULL COMMENT 'FK, referencia hsglb_usuarios.idusuario',
   datahora DATETIME NOT NULL COMMENT 'Data e hora do movimento',
   tabela VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Nome da tabela que foi movimentada',
   operacao ENUM('I', 'U', 'D') NOT NULL COMMENT 'Insert, Update ou Delete',
   original VARCHAR(10000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Json dos dados originais',
   modificado VARCHAR(10000) CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Json dos dados modificados',
  PRIMARY KEY (id)
) ENGINE = innodb ROW_FORMAT = DEFAULT CHARACTER SET latin1;

ALTER TABLE agro_marca
 DROP FOREIGN KEY idmunicipe,
 DROP FOREIGN KEY idtaxaexercicio,
 DROP FOREIGN KEY idusuario,
 CHANGE id id INT(11) AUTO_INCREMENT NOT NULL;
ALTER TABLE agro_marca
 ADD CONSTRAINT idmunicipe FOREIGN KEY (idmunicipe) REFERENCES hscad_cadmunicipal (inscricaomunicipal) ON UPDATE NO ACTION ON DELETE NO ACTION,
 ADD CONSTRAINT idtaxaexercicio FOREIGN KEY (idtaxaexercicio) REFERENCES agro_taxa_exercicio (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
 ADD CONSTRAINT idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION;

 ALTER TABLE agro_taxa_exercicio
 DROP FOREIGN KEY fk_idtaxa_agro_taxa_exercicio,
 DROP FOREIGN KEY fk_idusuario_agro_taxa_exercicio,
 CHANGE id id INT(11) AUTO_INCREMENT NOT NULL;
ALTER TABLE agro_taxa_exercicio
 ADD CONSTRAINT fk_idtaxa_agro_taxa_exercicio FOREIGN KEY (idtaxa) REFERENCES agro_taxa (id) ON UPDATE CASCADE ON DELETE CASCADE,
 ADD CONSTRAINT fk_idusuario_agro_taxa_exercicio FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION;



