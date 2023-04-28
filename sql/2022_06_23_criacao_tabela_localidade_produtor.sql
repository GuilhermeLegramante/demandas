CREATE TABLE agro_localidade (
    id INT(11) AUTO_INCREMENT NOT NULL COMMENT 'PK',
    idusuario INT(11) NOT NULL COMMENT 'FK, referencia hsglb_usuarios',
    datahora DATETIME NOT NULL COMMENT 'Data e hora da ultima modificacao',
    descricao VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Identificador do registro',
    CONSTRAINT fk_agro_localidade_idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
    PRIMARY KEY (id)
) ENGINE = innodb COMMENT = 'Cadastro de localidade' ROW_FORMAT = DEFAULT CHARACTER SET utf8;

CREATE TABLE agro_localidade_produtor (
    id INT AUTO_INCREMENT NOT NULL,
    idlocalidade INT NOT NULL,
    idprodutor INT NOT NULL,
    idusuario INT NOT NULL COMMENT 'FK hsglb_usuarios',
    datahora DATETIME NOT NULL COMMENT 'Ultima modificacao do registro',
    CONSTRAINT fk_idusuario_agro_localidade_produtor FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT fk_idlocalidade_agro_localidade_produtor FOREIGN KEY (idlocalidade) REFERENCES agro_localidade (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT fk_idprodutor_agro_localidade_produtor FOREIGN KEY (idprodutor) REFERENCES agro_produtor (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
    PRIMARY KEY (id)
) ENGINE = InnoDB COMMENT = 'Localidades do Produtor' ROW_FORMAT = DEFAULT;

ALTER TABLE
    agro_localidade DROP FOREIGN KEY fk_agro_localidade_idmunicipio,
    DROP FOREIGN KEY fk_agro_localidade_idusuario,
ADD
    codigo INT NOT NULL
AFTER
    datahora;

ALTER TABLE
    agro_localidade
ADD
    CONSTRAINT fk_agro_localidade_idmunicipio FOREIGN KEY (idmunicipio) REFERENCES hscad_cidades (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
ADD
    CONSTRAINT fk_agro_localidade_idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE
    agro_localidade DROP FOREIGN KEY fk_agro_localidade_idmunicipio,
    DROP FOREIGN KEY fk_agro_localidade_idusuario;

ALTER TABLE
    agro_localidade
ADD
    CONSTRAINT fk_agro_localidade_idmunicipio FOREIGN KEY (idmunicipio) REFERENCES hscad_cidades (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
ADD
    CONSTRAINT fk_agro_localidade_idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE
    agro_localidade DROP FOREIGN KEY fk_agro_localidade_idusuario,
ADD
    codigo INT NOT NULL;

ALTER TABLE
    agro_localidade
ADD
    CONSTRAINT fk_agro_localidade_idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
ADD
    CONSTRAINT fk_agro_localidade_idmunicipio FOREIGN KEY (idmunicipio) REFERENCES hscad_cidades (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE
    agro_localidade DROP FOREIGN KEY fk_agro_localidade_idusuario,
ADD
    idmunicipio INT NOT NULL
AFTER
    codigo;

ALTER TABLE
    agro_localidade
ADD
    CONSTRAINT fk_agro_localidade_idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
ADD
    CONSTRAINT fk_agro_localidade_idmunicipio FOREIGN KEY (idmunicipio) REFERENCES hscad_cidades (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE
    agro_localidade DROP FOREIGN KEY fk_agro_localidade_idusuario,
ADD
    idmunicipio INT NOT NULL
AFTER
    datahora;

ALTER TABLE
    agro_localidade
ADD
    CONSTRAINT fk_agro_localidade_idusuario FOREIGN KEY (idusuario) REFERENCES hsglb_usuarios (IDUSUARIO) ON UPDATE NO ACTION ON DELETE NO ACTION,
ADD
    CONSTRAINT fk_agro_localidade_idmunicipio FOREIGN KEY (idmunicipio) REFERENCES hscad_cidades (id) ON UPDATE RESTRICT ON DELETE RESTRICT;
