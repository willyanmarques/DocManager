-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: docmanager_db
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `advogado`
--

DROP TABLE IF EXISTS `advogado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advogado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oab` int(10) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `sexo` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `arquivo` varchar(45) DEFAULT NULL,
  `dataCadastro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advogado`
--

LOCK TABLES `advogado` WRITE;
/*!40000 ALTER TABLE `advogado` DISABLE KEYS */;
INSERT INTO `advogado` VALUES (17,231111,'123.124.432-23','Izaque','Leite','izaque@live.com','12345',1,1,'bbe3f91ae1da8289e8a62b4014e9b4f7.jpg','2016-10-07 13:41:40'),(22,231313,'109.741.394-24','Alvaro','Uchoa','alvaro@live.com','fefedfedfd',1,1,'4329b9774fbc9dd0c0cc248b5b7ba39a.jpg','2016-10-07 13:53:48'),(47,235232,'234.143.214-21','Abel','Scarpa','abel@outlook.com','123',1,1,'cf6084818f620208a07d794eadd0987d.jpg','2016-10-07 14:27:47'),(48,234345,NULL,'Jose','Maria','willyanmarquesti@gmail.com','344543544',1,1,'2c08b125f723d2f0dd2a630aec6363f3.png','2016-10-22 10:12:20'),(50,123132,'123.124.432-23','Alfredo','Pedroza','alfredo@cin.ufpe.br','asdefrrrrf',1,1,'44983c035f1fe079f9cd28d8f35d8a60.jpg','2016-10-31 23:28:52'),(51,234521,'357.246.765-78','Bruna','Carla','bruna@hotmail.com','345434rfef',2,0,'857f9938710def4c0d6444d718695f45.jpg','2016-10-31 23:31:04');
/*!40000 ALTER TABLE `advogado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advogado_detento`
--

DROP TABLE IF EXISTS `advogado_detento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advogado_detento` (
  `detento_id` int(11) NOT NULL,
  `advogado_id` int(11) NOT NULL,
  `dataVinculo` datetime NOT NULL,
  PRIMARY KEY (`detento_id`,`advogado_id`),
  KEY `fk_detento_has_advogado_advogado1_idx` (`advogado_id`),
  KEY `fk_detento_has_advogado_detento_idx` (`detento_id`),
  CONSTRAINT `fk_detento_has_advogado_advogado1` FOREIGN KEY (`advogado_id`) REFERENCES `advogado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detento_has_advogado_detento` FOREIGN KEY (`detento_id`) REFERENCES `detento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advogado_detento`
--

LOCK TABLES `advogado_detento` WRITE;
/*!40000 ALTER TABLE `advogado_detento` DISABLE KEYS */;
INSERT INTO `advogado_detento` VALUES (2,22,'2016-11-12 23:40:37'),(2,50,'2016-11-18 10:57:42'),(3,17,'2016-11-12 23:40:45'),(3,50,'2016-11-17 23:36:27'),(5,47,'2016-11-17 23:38:38'),(6,22,'2016-11-17 23:38:49');
/*!40000 ALTER TABLE `advogado_detento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advogado_instituicao`
--

DROP TABLE IF EXISTS `advogado_instituicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advogado_instituicao` (
  `instituicao_id` int(11) NOT NULL,
  `advogado_id` int(11) NOT NULL,
  `dataVinculo` datetime DEFAULT NULL,
  PRIMARY KEY (`instituicao_id`,`advogado_id`),
  KEY `fk_instituicao_has_advogado_advogado1_idx` (`advogado_id`),
  KEY `fk_instituicao_has_advogado_instituicao1_idx` (`instituicao_id`),
  CONSTRAINT `fk_instituicao_has_advogado_advogado1` FOREIGN KEY (`advogado_id`) REFERENCES `advogado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_instituicao_has_advogado_instituicao1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advogado_instituicao`
--

LOCK TABLES `advogado_instituicao` WRITE;
/*!40000 ALTER TABLE `advogado_instituicao` DISABLE KEYS */;
INSERT INTO `advogado_instituicao` VALUES (1,47,'2016-11-12 21:04:10'),(11,50,'2016-11-15 16:33:41');
/*!40000 ALTER TABLE `advogado_instituicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detento`
--

DROP TABLE IF EXISTS `detento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prontuario` int(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_mae` varchar(45) NOT NULL,
  `sexo` int(1) NOT NULL,
  `regime` varchar(45) NOT NULL,
  `instituicao_id` int(11) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  PRIMARY KEY (`id`,`instituicao_id`),
  KEY `fk_detento_instituicao1_idx` (`instituicao_id`),
  CONSTRAINT `fk_detento_instituicao1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detento`
--

LOCK TABLES `detento` WRITE;
/*!40000 ALTER TABLE `detento` DISABLE KEYS */;
INSERT INTO `detento` VALUES (1,213811,'Fernando Beira Mar da Silva','Maria da Praia da Silva',1,'fechado',3,'2016-09-16 16:03:14'),(2,138509,'Pablo Escobar de Nogrega','Maria Farinha de Nobrega',1,'s_aberto',3,'2016-09-16 16:27:15'),(3,653490,'Manoel Carlos de Souza','Joana da Silva Pereira',1,'aberto',3,'2016-09-16 16:32:08'),(4,231354,'Willyan Marques Viana da Silva','Elizabeth Viana da Silva Pereira',1,'s_aberto',4,'2016-09-16 16:35:45'),(5,233456,'Ana Beatriz Viana da Silva','Maria de Lourdes da Silva',2,'aberto',4,'2016-09-16 16:52:05'),(6,234512,'Andre Lopes Pereira','Ana Maria da Silva',1,'aberto',3,'2016-09-16 17:08:41');
/*!40000 ALTER TABLE `detento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_detento`
--

DROP TABLE IF EXISTS `documento_detento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_detento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataDocumento` varchar(10) DEFAULT NULL,
  `origem` varchar(45) NOT NULL,
  `destinatario` varchar(45) NOT NULL,
  `assunto` varchar(45) NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `arquivo` varchar(45) NOT NULL,
  `cod_validacao` varchar(45) DEFAULT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  `instituicao_id` int(11) NOT NULL,
  `detento_id` int(11) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  PRIMARY KEY (`id`,`tipo_documento_id`,`instituicao_id`,`detento_id`),
  KEY `fk_documento_detento_tipo_documento1_idx` (`tipo_documento_id`),
  KEY `fk_documento_detento_instituicao1_idx` (`instituicao_id`),
  KEY `fk_documento_detento_detento1_idx` (`detento_id`),
  CONSTRAINT `fk_documento_detento_detento1` FOREIGN KEY (`detento_id`) REFERENCES `detento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_detento_instituicao1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_detento_tipo_documento1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_detento`
--

LOCK TABLES `documento_detento` WRITE;
/*!40000 ALTER TABLE `documento_detento` DISABLE KEYS */;
INSERT INTO `documento_detento` VALUES (1,'11/09/2016','2','11','tsefefeefee','','','VtTfL-2Xc39-MYx1m-AYmzi',2,4,5,'2016-11-18 19:56:38'),(2,'11/02/2016','1','1','teste','teeddewdw','','0RIlF-FurdN-JpiUM-lkSA3',1,4,6,'2016-11-18 20:07:49'),(3,'11/07/2016','2','11','tetfrfe','efefefe','','Drfhb-oc4sQ-rJDbC-BI2oq',2,4,6,'2016-11-19 12:08:11'),(4,'11/09/2016','1','11','wdwdd','edede','ef5b42c2af369248c8d2913c34417a46','zZiNE-Ifbth-K2wUC-6RCds',1,4,5,'2016-11-19 12:24:47');
/*!40000 ALTER TABLE `documento_detento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_img`
--

DROP TABLE IF EXISTS `documento_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cod_seguranca` varchar(45) NOT NULL,
  `tamanho` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `imagem` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_img`
--

LOCK TABLES `documento_img` WRITE;
/*!40000 ALTER TABLE `documento_img` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_instituicao`
--

DROP TABLE IF EXISTS `documento_instituicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_instituicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataDocumento` varchar(10) DEFAULT NULL,
  `origem` varchar(45) NOT NULL,
  `destinatario` varchar(45) NOT NULL,
  `assunto` varchar(45) NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `arquivo` varchar(45) NOT NULL,
  `cod_validacao` varchar(45) DEFAULT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  `instituicao_id` int(11) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  PRIMARY KEY (`id`,`tipo_documento_id`,`instituicao_id`),
  KEY `fk_documento_instituicao_tipo_documento1_idx` (`tipo_documento_id`),
  KEY `fk_documento_instituicao_instituicao1_idx` (`instituicao_id`),
  CONSTRAINT `fk_documento_instituicao_instituicao1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_instituicao_tipo_documento1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_instituicao`
--

LOCK TABLES `documento_instituicao` WRITE;
/*!40000 ALTER TABLE `documento_instituicao` DISABLE KEYS */;
INSERT INTO `documento_instituicao` VALUES (1,'11/02/2016','Pedro Borba','2','efefef','ewfefe','08474456949a90f6a8863e04181cc3f7','GOOGLE',2,12,'2016-11-19 12:13:25'),(2,'11/16/2016','Pedro Borba','2','eeee','efefef','7c147ad52e45c85543774983ba04b768.png','x9Q5q-vjTmN-EP6oE-f9ute',1,12,'2016-11-19 12:23:09');
/*!40000 ALTER TABLE `documento_instituicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instituicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituicao`
--

LOCK TABLES `instituicao` WRITE;
/*!40000 ALTER TABLE `instituicao` DISABLE KEYS */;
INSERT INTO `instituicao` VALUES (1,'Centro de Monitoramento','Tavares Gomes','CTTG','tavares@gmail.com','53610090','Av. Tancredo Neves','Cidade Universitaria','Recife','PE','',1,'2016-09-16 15:05:01'),(2,'Centro de Monitoramento','Pedro Borba','CMPB','ctpedro@live.com','31434545','Av. Mario Melo','Beira Mar II','Igarassu','AC','',1,'2016-09-16 15:27:35'),(3,'Unidade Prisional','Anibal Bruno de Oliveira Firmo','UPAB','upan@gmail.com','87894-484','Rua Guilherme Jorge Paes Barreto','Igarassu','Recife','MA','',1,'2016-09-16 16:02:42'),(4,'Unidade Prisional','Carandiru','UPCD','carandiru@gmail.com','0','Rua dos detentos','Sao Paulo','Sao Paulo','DF','',0,'2016-09-16 16:34:56'),(11,'Centro de Monitoramento','Bruno Arvoredo','UPABM','abmelo@gmail.com','42313982','Rua dos pombos','Mumbaba','Abreu e Lima','RJ','Teste de cadastro via array',1,'2016-10-07 12:06:22'),(12,'Unidade Prisional','Castelo Ratimbum','UPCR','casteloratimbum@outlook.com','84848-918','Av.  dos programas antigos','Sao Vicente','Castelandia','GO',NULL,1,'2016-11-08 15:06:32');
/*!40000 ALTER TABLE `instituicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacao`
--

DROP TABLE IF EXISTS `notificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `usuario_instituicao_id` int(11) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  PRIMARY KEY (`id`,`usuario_id`,`usuario_instituicao_id`),
  KEY `fk_notificacao_usuario1_idx` (`usuario_id`,`usuario_instituicao_id`),
  CONSTRAINT `fk_notificacao_usuario1` FOREIGN KEY (`usuario_id`, `usuario_instituicao_id`) REFERENCES `usuario` (`id`, `instituicao_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacao`
--

LOCK TABLES `notificacao` WRITE;
/*!40000 ALTER TABLE `notificacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES (1,'Atestado'),(2,'Requerimento');
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `sexo` int(1) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `status` int(1) NOT NULL,
  `arquivo` varchar(45) DEFAULT NULL,
  `instituicao_id` int(11) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  PRIMARY KEY (`id`,`instituicao_id`),
  KEY `fk_usuario_instituicao1_idx` (`instituicao_id`),
  CONSTRAINT `fk_usuario_instituicao1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (155,'Andre','Luiz','andre@gmail.com','000.000.000-00','123456',1,'adm_instituicao',0,'484c702b6ffd119367b8a033dc2692ee.png',11,'2016-10-28 16:15:33'),(168,'Pedro','Marques','pedro@gmail.com','109.741.394-24','123456',1,'consulta',1,'da1a2e8665dc2af159dff1edd6b30c2e.jpg',2,'2016-10-30 18:59:27'),(169,'Joao','Moutinho','joao@gmail.com','546.665.567-67','123456',1,'adm',1,'9e89442f34d808ae670ebdcd7afba0fb.jpg',2,'2016-10-30 18:59:36'),(177,'Marcio','Araujo','marcio@gmail.com','213.545.465-65','123456',1,'adm_instituicao',0,'ac82623551cf703d63d22f0146d7cf8b.jpg',2,'2016-10-30 19:02:57'),(178,'Marcia','Felipe','marciaf@gmail.com','000.000.000-00','123456',1,'adm_instituicao',1,'809c54f5a0d8fbbc8119e4527b8f81a9.jpg',2,'2016-10-30 19:03:04'),(181,'Ronaldinho','Gaucho','gaucho@gmail.com','000.000.000-00','123456',1,'adm_instituicao',1,'16ab8303f3811b22b08af3fd40d9d6f0.jpg',2,'2016-10-30 19:04:56'),(182,'Jose','de Alencar','jose@gmail.com','234.143.214-21','okoko',1,'adm',1,'8db9966f7fb6279ffc1f0d05ef7eb87d.jpg',2,'2016-10-30 22:05:27'),(183,'Ana Maria','dos Santos','ana@gmail.com','123.143.232-12','33256576',2,'consulta',0,'1fdedd29a6289ddf8bef16bb8418a443.jpg',11,'2016-10-30 22:35:52'),(184,'Walter','Fernando','walter@cin.ufpe.br','213.545.465-65','23',1,'adm',1,'3b8465f23ab0f677d5cf83a1715d1225.jpg',1,'2016-10-30 22:42:15'),(185,'Caio','Ribeiro','caio@globo.com','109.741.394-24','effewfwe',1,'adm',1,'d1a81151f1675fcd114075501a8fc8b1.jpg',1,'2016-10-30 23:39:36'),(186,'Mauricio','Ventura','mau@gmail.com','346.565.674-57','fefdsfdff',1,'adm_instituicao',1,'868f2d8b9f56c8c62eaee087ef8a076a.jpg',2,'2016-11-10 17:03:48');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-20 23:10:54
