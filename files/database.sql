-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.17 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para sistemadeestag
DROP DATABASE IF EXISTS `sistemadeestag`;
CREATE DATABASE IF NOT EXISTS `sistemadeestag` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistemadeestag`;


-- Copiando estrutura para tabela sistemadeestag.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `nome` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.admin: ~0 rows (aproximadamente)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `email`, `senha`, `nome`) VALUES
	(1, 'lipe_safreire@hotmail.com', '22d37df62796713c130af7dc582d9f89', 'Felipe Sá Freire'),
	(2, 'admin@fatec.sp.gov.br', '21232f297a57a5a743894a0e4a801fc3', 'Administrador');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ra` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 - aluno ativo, 0 - inativo',
  `id_curso` bigint(20) NOT NULL,
  `id_periodo_curso` bigint(20) NOT NULL,
  `id_estagio` bigint(20) NOT NULL,
  `id_empresa` bigint(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `senha_temporaria` varchar(40) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) NOT NULL,
  `sexo` char(1) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `dt_nascimento` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_curso_aluno` (`id_curso`),
  KEY `fk_periodo_curso_aluno` (`id_periodo_curso`),
  KEY `fk_estagio_aluno` (`id_estagio`),
  KEY `fk_empresa_aluno` (`id_empresa`),
  CONSTRAINT `fk_curso_aluno` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_empresa_aluno` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_estagio_aluno` FOREIGN KEY (`id_estagio`) REFERENCES `estagio` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_periodo_curso_aluno` FOREIGN KEY (`id_periodo_curso`) REFERENCES `periodo_curso` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.aluno: ~1 rows (aproximadamente)
DELETE FROM `aluno`;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.curso: ~3 rows (aproximadamente)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`id`, `titulo`, `status`) VALUES
	(1, 'Análise e Desenvolvimento de Sistemas', 1),
	(2, 'Gestão Empresarial', 1),
	(3, 'Mecatrônica', 1);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.diretor
CREATE TABLE IF NOT EXISTS `diretor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `senha_temporaria` varchar(40) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.diretor: ~0 rows (aproximadamente)
DELETE FROM `diretor`;
/*!40000 ALTER TABLE `diretor` DISABLE KEYS */;
/*!40000 ALTER TABLE `diretor` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.documento_curricular
CREATE TABLE IF NOT EXISTS `documento_curricular` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_aluno` bigint(20) NOT NULL,
  `convenio_concessao_estagio` int(1) DEFAULT '0',
  `termo_compromisso_estagio` int(1) DEFAULT '0',
  `plano_ativ_estagio` int(1) DEFAULT '0',
  `apolice_seguro` int(1) DEFAULT '0',
  `relatorio_final_simplificado` int(1) DEFAULT '0',
  `relatorio_supervisao_estagio` int(1) DEFAULT '0',
  `modelo_relatorio_final` int(1) DEFAULT '0',
  `avaliacao_desempenho_estagio` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_aluno_doc_curricular` (`id_aluno`),
  CONSTRAINT `fk_aluno_doc_curricular` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.documento_curricular: ~0 rows (aproximadamente)
DELETE FROM `documento_curricular`;
/*!40000 ALTER TABLE `documento_curricular` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento_curricular` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.documento_equivalencia
CREATE TABLE IF NOT EXISTS `documento_equivalencia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_aluno` bigint(20) NOT NULL,
  `processo_equivalencia` int(11) DEFAULT '0',
  `plano_ativ_equivalencia` int(11) DEFAULT '0',
  `relatorio_final` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_aluno_doc_equivalencia` (`id_aluno`),
  CONSTRAINT `fk_aluno_doc_equivalencia` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.documento_equivalencia: ~0 rows (aproximadamente)
DELETE FROM `documento_equivalencia`;
/*!40000 ALTER TABLE `documento_equivalencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento_equivalencia` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.empresa: ~0 rows (aproximadamente)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.endereco_aluno
CREATE TABLE IF NOT EXISTS `endereco_aluno` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_aluno` bigint(20) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cep` varchar(20) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_aluno` (`id_aluno`),
  CONSTRAINT `fk_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.endereco_aluno: ~0 rows (aproximadamente)
DELETE FROM `endereco_aluno`;
/*!40000 ALTER TABLE `endereco_aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco_aluno` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.endereco_empresa
CREATE TABLE IF NOT EXISTS `endereco_empresa` (
  `id_empresa` bigint(20) DEFAULT NULL,
  `rua` varchar(100) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cep` varchar(20) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  KEY `fk_empresa` (`id_empresa`),
  CONSTRAINT `fk_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.endereco_empresa: ~0 rows (aproximadamente)
DELETE FROM `endereco_empresa`;
/*!40000 ALTER TABLE `endereco_empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco_empresa` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.estagio
CREATE TABLE IF NOT EXISTS `estagio` (
  `id` bigint(20) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.estagio: ~2 rows (aproximadamente)
DELETE FROM `estagio`;
/*!40000 ALTER TABLE `estagio` DISABLE KEYS */;
INSERT INTO `estagio` (`id`, `titulo`) VALUES
	(1, 'Estágio Curricular'),
	(2, 'Estágio com Equivalência');
/*!40000 ALTER TABLE `estagio` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.periodo_curso
CREATE TABLE IF NOT EXISTS `periodo_curso` (
  `id` bigint(20) NOT NULL,
  `periodo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.periodo_curso: ~3 rows (aproximadamente)
DELETE FROM `periodo_curso`;
/*!40000 ALTER TABLE `periodo_curso` DISABLE KEYS */;
INSERT INTO `periodo_curso` (`id`, `periodo`) VALUES
	(1, 'Manhã'),
	(2, 'Tarde'),
	(3, 'Noite');
/*!40000 ALTER TABLE `periodo_curso` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.supervisor
CREATE TABLE IF NOT EXISTS `supervisor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_curso` bigint(20) DEFAULT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `senha_temporaria` varchar(40) DEFAULT NULL,
  `periodo_manha` int(11) DEFAULT NULL,
  `periodo_tarde` int(11) DEFAULT NULL,
  `periodo_noite` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_curso` (`id_curso`),
  CONSTRAINT `fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.supervisor: ~1 rows (aproximadamente)
DELETE FROM `supervisor`;
/*!40000 ALTER TABLE `supervisor` DISABLE KEYS */;
INSERT INTO `supervisor` (`id`, `id_curso`, `nome`, `email`, `senha`, `senha_temporaria`, `periodo_manha`, `periodo_tarde`, `periodo_noite`, `status`) VALUES
	(1, 1, 'Felipe', 'lipe_safreire@hotmail.com', '22d37df62796713c130af7dc582d9f89', NULL, 1, NULL, NULL, 1);
/*!40000 ALTER TABLE `supervisor` ENABLE KEYS */;


-- Copiando estrutura para tabela sistemadeestag.vaga_estagio
CREATE TABLE IF NOT EXISTS `vaga_estagio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `html` text NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url_vaga` text NOT NULL,
  `periodo_id` bigint(20) NOT NULL,
  `curso_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_curso_estagio` (`curso_id`),
  KEY `fk_periodo_estagio` (`periodo_id`),
  CONSTRAINT `fk_curso_estagio` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_periodo_estagio` FOREIGN KEY (`periodo_id`) REFERENCES `periodo_curso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistemadeestag.vaga_estagio: ~0 rows (aproximadamente)
DELETE FROM `vaga_estagio`;
/*!40000 ALTER TABLE `vaga_estagio` DISABLE KEYS */;
/*!40000 ALTER TABLE `vaga_estagio` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
