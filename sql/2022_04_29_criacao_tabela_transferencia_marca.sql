CREATE TABLE agro_transferencia_marca (
   id INT(11) AUTO_INCREMENT NOT NULL,
   id_marca INT NOT NULL,
   id_origem INT NOT NULL COMMENT 'Produtor que detém a marca',
   id_destino INT NOT NULL COMMENT 'Produtor que está recebendo a marca',
   observacao LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
   idusuario INT(11) NOT NULL COMMENT 'FK hsglb_usuarios',
   datahora DATETIME NOT NULL COMMENT 'ultima modificacao do registro',
  CONSTRAINT fk_idusuario_agro_transferencia_marca FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_id_origem_agro_transferencia_marca FOREIGN KEY (id_origem) REFERENCES agro_produtor (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_id_destino_agro_transferencia_marca FOREIGN KEY (id_destino) REFERENCES agro_produtor (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_id_marca_agro_transferencia_marca FOREIGN KEY (id_marca) REFERENCES agro_marca (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  PRIMARY KEY (id)
) ENGINE = innodb COMMENT = 'Taxas referentes as Marcas' ROW_FORMAT = DEFAULT CHARACTER SET latin1;


CREATE TABLE agro_movimento_marca (
   id INT(11) AUTO_INCREMENT NOT NULL,
   id_marca INT(11) NOT NULL,
   observacao LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
   idusuario INT(11) NOT NULL COMMENT 'FK hsglb_usuarios',
   datahora DATETIME NOT NULL COMMENT 'ultima modificacao do registro',
  CONSTRAINT fk_idusuario_agro_movimento_marca FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_id_marca_agro_movimento_marca FOREIGN KEY (id_marca) REFERENCES agro_marca (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  PRIMARY KEY (id)
) ENGINE = innodb COMMENT = 'Movimentos das Marcas' ROW_FORMAT = DEFAULT CHARACTER SET latin1;