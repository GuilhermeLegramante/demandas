INSERT INTO agro_aspecto (`descricao`, `idusuario`, `datahora`) VALUES
  ('FORMA LIVRE', (SELECT MIN(usr.IDUSUARIO) FROM hsglb_usuarios usr WHERE usr.`ATIVO` = 'S'), CURRENT_TIMESTAMP()),
  ('NÚMERO', (SELECT MIN(usr.IDUSUARIO) FROM hsglb_usuarios usr WHERE usr.`ATIVO` = 'S'), CURRENT_TIMESTAMP()),
  ('FORMA GEOMÉTRICA', (SELECT MIN(usr.IDUSUARIO) FROM hsglb_usuarios usr WHERE usr.`ATIVO` = 'S'), CURRENT_TIMESTAMP()),
  ('LETRA', (SELECT MIN(usr.IDUSUARIO) FROM hsglb_usuarios usr WHERE usr.`ATIVO` = 'S'), CURRENT_TIMESTAMP());
