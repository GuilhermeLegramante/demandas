CREATE TABLE agro_aspecto_marca (
   id INT AUTO_INCREMENT NOT NULL,
   idaspecto INT NOT NULL,
   idmarca INT NOT NULL,
   idusuario INT NOT NULL,
   datahora DATETIME NOT NULL,
  CONSTRAINT fk_idusuario_agro_aspecto_marca FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_idaspecto_agro_aspecto_marca FOREIGN KEY (idaspecto) REFERENCES agro_aspecto (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_idmarca_agro_aspecto_marca FOREIGN KEY (idmarca) REFERENCES agro_marca (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  PRIMARY KEY (id)
) ENGINE = InnoDB COMMENT = 'Relação de aspectos da marca' ROW_FORMAT = DEFAULT;