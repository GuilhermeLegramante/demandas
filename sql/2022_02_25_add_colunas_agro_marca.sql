ALTER TABLE agro_marca
 DROP FOREIGN KEY idmunicipe,
 DROP FOREIGN KEY idtaxaexercicio,
 DROP FOREIGN KEY idusuario,
 ADD numero INT NOT NULL AFTER idtaxaexercicio,
 ADD ano INT NOT NULL AFTER numero;
ALTER TABLE agro_marca
 ADD CONSTRAINT idmunicipe FOREIGN KEY (idmunicipe) REFERENCES hscad_cadmunicipal (inscricaomunicipal) ON UPDATE NO ACTION ON DELETE NO ACTION,
 ADD CONSTRAINT idtaxaexercicio FOREIGN KEY (idtaxaexercicio) REFERENCES agro_taxa_exercicio (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
 ADD CONSTRAINT idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION;
