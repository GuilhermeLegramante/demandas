ALTER TABLE agro_movimento_marca
 DROP FOREIGN KEY fk_idusuario_agro_movimento_marca,
 DROP FOREIGN KEY fk_id_marca_agro_movimento_marca,
 ADD tipo ENUM('B','S') NOT NULL COMMENT 'B = BAIXA, S = SUSPENSAO' AFTER id_marca;
ALTER TABLE agro_movimento_marca
 ADD CONSTRAINT fk_idusuario_agro_movimento_marca FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
 ADD CONSTRAINT fk_id_marca_agro_movimento_marca FOREIGN KEY (id_marca) REFERENCES agro_marca (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

 ALTER TABLE agro_marca
 DROP FOREIGN KEY idmunicipe,
 DROP FOREIGN KEY idtaxaexercicio,
 DROP FOREIGN KEY idusuario,
 ADD situacao ENUM('L','B','S') NOT NULL DEFAULT 'L' COMMENT 'L = Liberada B = Baixada S = Suspensa' AFTER visivel;
ALTER TABLE agro_marca
 ADD CONSTRAINT idmunicipe FOREIGN KEY (idmunicipe) REFERENCES hscad_cadmunicipal (inscricaomunicipal) ON UPDATE NO ACTION ON DELETE NO ACTION,
 ADD CONSTRAINT idtaxaexercicio FOREIGN KEY (idtaxaexercicio) REFERENCES agro_taxa_exercicio (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
 ADD CONSTRAINT idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION;

