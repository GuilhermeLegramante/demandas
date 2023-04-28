CREATE TABLE agro_aspecto (
   id INT(11) AUTO_INCREMENT NOT NULL,
   descricao VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
   idusuario INT(11) NOT NULL COMMENT 'FK hsglb_usuarios',
   datahora DATETIME NOT NULL COMMENT 'ultima modificacao do registro',
  CONSTRAINT fk_idusuario_agro_aspecto FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
  PRIMARY KEY (id)
) ENGINE = innodb COMMENT = 'Aspectos referentes as Marcas' ROW_FORMAT = DEFAULT CHARACTER SET latin1;