--
-- Banco de dados: polvo
--
CREATE DATABASE IF NOT EXISTS `polvo` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `polvo`;

--
-- Tabela polvo_adm
--
CREATE TABLE `polvo_adm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `polvo_usuario` varchar(100) NOT NULL,
  `polvo_senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tabela socios
--
CREATE TABLE `socios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `rg` varchar(100) NOT NULL,
  `orgao` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nasc_cidade` varchar(255) NOT NULL,
  `nacionalidade` varchar(100) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `civil` varchar(100) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `economic` varchar(100) NOT NULL,
  `instrucao` varchar(100) NOT NULL,
  `pai` varchar(255) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `conjuge` varchar(255) NOT NULL,
  `nasc_conjuge` date NOT NULL,
  `fone_recado` varchar(255) NOT NULL,
  `acomp` varchar(255) NOT NULL,
  `tipo_sang` varchar(2) NOT NULL,
  `rh` varchar(10) NOT NULL,
  `pcd` varchar(100) NOT NULL,
  `alergias` text NOT NULL,
  `stat` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tabela endereco_socios
--
CREATE TABLE `endereco_socios` (
  `id_socio` int(11) NOT NULL,
  `cep` varchar(100) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `moradia` varchar(15) NOT NULL,
  KEY `id_socio` (`id_socio`),
  CONSTRAINT `fk_endereco_socios_id` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tabela pagamento
--
CREATE TABLE `pagamento` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_socio` int(11) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `forma_pg` varchar(15) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `parcelas` int(11) NOT NULL,
  `data_pg` date NOT NULL,
  `vencimento` date DEFAULT NULL,
  `obs` text NOT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `fk_pagamento_socio` (`id_socio`),
  CONSTRAINT `fk_pagamento_socio` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;