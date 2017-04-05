-- MySQL dump 10.13  Distrib 5.6.15, for Linux (x86_64)
--
-- Host: localhost    Database: aomp
-- ------------------------------------------------------
-- Server version	5.6.15-log

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
-- Table structure for table `group_power`
--

DROP TABLE IF EXISTS `group_power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_power` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `GroupID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '组ID',
  `PowerID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  `Power` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '权限(4：读、2：新增或修改、1删除)',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_GroupID` (`GroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='组权限';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_power`
--

LOCK TABLES `group_power` WRITE;
/*!40000 ALTER TABLE `group_power` DISABLE KEYS */;
INSERT INTO `group_power` VALUES (39,1,7,7,'2017-03-31 02:10:57'),(38,1,6,7,'2017-03-31 02:10:57'),(3,2,1,4,'2017-03-28 09:10:49'),(4,2,2,7,'2017-03-28 09:10:49'),(5,2,3,7,'2017-03-28 09:10:49'),(37,1,5,7,'2017-03-31 02:10:57'),(36,1,4,7,'2017-03-31 02:10:57'),(35,1,3,7,'2017-03-31 02:10:57'),(34,1,2,7,'2017-03-31 02:10:57'),(33,1,1,7,'2017-03-31 02:10:57');
/*!40000 ALTER TABLE `group_power` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_log`
--

DROP TABLE IF EXISTS `login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_log` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '登陆日志ID',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_UserId` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='登陆日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_log`
--

LOCK TABLES `login_log` WRITE;
/*!40000 ALTER TABLE `login_log` DISABLE KEYS */;
INSERT INTO `login_log` VALUES (1,1,'2017-04-01 06:05:39');
/*!40000 ALTER TABLE `login_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `power`
--

DROP TABLE IF EXISTS `power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `power` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `PowerName` varchar(30) NOT NULL DEFAULT '' COMMENT '权限名',
  `PowerClass` char(30) NOT NULL DEFAULT '' COMMENT '对应的controller',
  `Sort` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序(高到低)',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_ID_Sort` (`ID`,`Sort`),
  KEY `idx_Sort` (`Sort`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `power`
--

LOCK TABLES `power` WRITE;
/*!40000 ALTER TABLE `power` DISABLE KEYS */;
INSERT INTO `power` VALUES (1,'权限表管理','power',0,'2017-03-24 02:49:17'),(2,'组管理','group',1,'2017-03-24 07:35:10'),(3,'服务器列表','index',10,'2017-03-28 08:52:05'),(4,'管理员中心','user',2,'2017-03-28 09:29:34'),(5,'数据库','db',5,'2017-03-30 06:16:31'),(6,'数据库日志','dblog',4,'2017-03-30 06:19:48'),(7,'类型','type',3,'2017-03-30 07:01:23');
/*!40000 ALTER TABLE `power` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote`
--

DROP TABLE IF EXISTS `remote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主机ID',
  `TypeID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机类型',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `Name` varchar(25) NOT NULL DEFAULT '' COMMENT '主机名',
  `IP` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '主机IP',
  `IsDisable` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_UserID` (`UserID`),
  KEY `idx_IP` (`IP`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='主机表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote`
--

LOCK TABLES `remote` WRITE;
/*!40000 ALTER TABLE `remote` DISABLE KEYS */;
INSERT INTO `remote` VALUES (1,2,1,'本地开发环境',3232262784,0,'2017-03-31 06:37:14');
/*!40000 ALTER TABLE `remote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_admin`
--

DROP TABLE IF EXISTS `remote_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_admin` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理ID',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '管理者ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `Type` char(10) NOT NULL DEFAULT 'server' COMMENT '管理员类型(server：服务器管理员， db：数据库管理员)',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_UserID` (`UserID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='主机管理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_admin`
--

LOCK TABLES `remote_admin` WRITE;
/*!40000 ALTER TABLE `remote_admin` DISABLE KEYS */;
INSERT INTO `remote_admin` VALUES (4,1,6,'server','2017-04-05 07:26:34'),(3,1,1,'server','2017-04-05 06:58:48'),(5,3,6,'server','2017-04-05 07:26:34');
/*!40000 ALTER TABLE `remote_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_db`
--

DROP TABLE IF EXISTS `remote_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_db` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建者ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `TypeID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `Name` char(20) NOT NULL DEFAULT '' COMMENT '数据库名',
  `Port` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '端口',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_TypeID` (`TypeID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='数据库表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_db`
--

LOCK TABLES `remote_db` WRITE;
/*!40000 ALTER TABLE `remote_db` DISABLE KEYS */;
INSERT INTO `remote_db` VALUES (1,1,1,1,'本地开发数据库',3306,'2017-04-05 09:29:31');
/*!40000 ALTER TABLE `remote_db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_dba`
--

DROP TABLE IF EXISTS `remote_dba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_dba` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `Ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'IP（以防插入数据的时候找不到主机）',
  `QPS` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'QPS',
  `Select` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '查询',
  `Insert` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '添加',
  `Update` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '更新',
  `Delete` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '删除',
  `InnodbRowsRead` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Innodb row read',
  `InnodbRowsInserted` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Innodb rows inserted',
  `InnodbRowsUpdated` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Innodb rows updated',
  `InnodbRowsDeleted` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Innodb rows deleted',
  `InnodbLor` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Buffer Pool Read logical',
  `InnodbPhr` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Buffer Pool Read physical',
  `Client` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '客户端',
  `Conn` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '链接数',
  `TmpDiskTables` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '磁盘临时表',
  `TmpTables` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '内存临时表',
  `TmpFiles` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '临时文件',
  `HandlerDelete` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '删除占用',
  `HandlerReadKey` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '读取key占用',
  `HandlerReadRnd` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '读取随机占用',
  `HandlerUpdate` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '更新占用',
  `HandlerWrite` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '写占用',
  `InnodbDataFsyncs` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'fsyncs',
  `InnodbDataReads` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Innodb pending reads',
  `InnodbDataWrites` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'Innodb pending write',
  `TableLocksImmediate` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '正在执行的表锁',
  `TableLocksWait` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '正在排队的表锁',
  `SendTime` timestamp NULL DEFAULT NULL COMMENT '发送时间',
  `Remarks` varchar(255) DEFAULT '' COMMENT '备注',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='主机数据库监控';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_dba`
--

LOCK TABLES `remote_dba` WRITE;
/*!40000 ALTER TABLE `remote_dba` DISABLE KEYS */;
INSERT INTO `remote_dba` VALUES (1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'2017-04-01 08:13:41','','2017-04-01 08:24:07'),(2,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'2017-04-01 08:13:41','','2017-04-01 08:50:51'),(3,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 08:51:08'),(4,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:33:46'),(5,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:35:55'),(6,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:40:32'),(7,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:41:40'),(8,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:43:26'),(9,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:56:13'),(10,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:56:50'),(11,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 09:57:02'),(12,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 10:00:49'),(13,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 10:04:05'),(14,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 10:05:39'),(15,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-01 10:17:44'),(16,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 01:19:50'),(17,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 01:24:52'),(18,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 01:32:03'),(19,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 01:34:36'),(20,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 01:39:46'),(21,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 01:43:39'),(22,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 01:43:41'),(23,1,0,0,1,1,0,0,0,1,0,0,112,0,0,0,0,1,0,0,0,344,0,342,14,0,29,3,0,'0000-00-00 00:00:00','','2017-04-05 01:43:43'),(24,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:43:45'),(25,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:43:47'),(26,1,0,0,3,1,0,0,48,1,0,0,27,0,0,0,0,1,0,0,2,344,0,342,2,0,2,5,0,'0000-00-00 00:00:00','','2017-04-05 01:43:49'),(27,1,0,0,3,1,0,0,50,1,0,0,27,0,0,0,0,1,0,0,2,344,0,342,2,0,2,5,0,'0000-00-00 00:00:00','','2017-04-05 01:43:51'),(28,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,9,3,0,'0000-00-00 00:00:00','','2017-04-05 01:43:53'),(29,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:43:55'),(30,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:43:57'),(31,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:43:59'),(32,1,0,0,1,1,0,0,0,1,0,0,1598,0,0,0,0,1,0,0,0,344,0,342,15,0,31,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:01'),(33,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:03'),(34,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:05'),(35,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:07'),(36,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:09'),(37,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:11'),(38,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:13'),(39,1,0,0,2,1,0,0,37,1,0,0,19,0,0,0,0,1,0,0,1,344,0,342,3,0,3,4,0,'0000-00-00 00:00:00','','2017-04-05 01:44:15'),(40,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,5,0,6,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:17'),(41,1,0,0,1,1,0,0,0,1,0,0,112,0,0,0,0,1,0,0,0,344,0,342,16,0,31,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:19'),(42,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:21'),(43,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:23'),(44,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:25'),(45,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:27'),(46,1,0,0,1,1,0,0,0,1,0,0,114,0,0,0,0,1,0,0,0,344,0,342,15,0,32,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:29'),(47,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:31'),(48,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:33'),(49,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:35'),(50,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:37'),(51,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:39'),(52,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:41'),(53,1,0,0,1,1,0,0,0,1,0,0,114,0,0,0,0,1,0,0,0,344,0,342,15,0,30,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:43'),(54,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:45'),(55,1,0,0,1,1,0,0,0,1,0,0,9,0,0,0,0,1,0,0,0,344,0,342,6,0,7,3,0,'0000-00-00 00:00:00','','2017-04-05 01:44:47'),(56,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 07:50:21'),(57,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,342,0,341,0,0,0,0,0,'0000-00-00 00:00:00','','2017-04-05 07:50:23');
/*!40000 ALTER TABLE `remote_dba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_dba_backup`
--

DROP TABLE IF EXISTS `remote_dba_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_dba_backup` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `LastBackupTime` timestamp NULL DEFAULT NULL COMMENT '最后备份时间',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据库备份记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_dba_backup`
--

LOCK TABLES `remote_dba_backup` WRITE;
/*!40000 ALTER TABLE `remote_dba_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `remote_dba_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_dba_logs`
--

DROP TABLE IF EXISTS `remote_dba_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_dba_logs` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `Type` char(10) NOT NULL DEFAULT 'slow' COMMENT '类型(error,slow)',
  `QueryTime` decimal(11,6) unsigned NOT NULL DEFAULT '0.000000' COMMENT '执行时间',
  `RowsSent` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '返回行数',
  `RowsRxamined` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '查询行数',
  `Content` text NOT NULL COMMENT '日志内容',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据库日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_dba_logs`
--

LOCK TABLES `remote_dba_logs` WRITE;
/*!40000 ALTER TABLE `remote_dba_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `remote_dba_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_dba_threads`
--

DROP TABLE IF EXISTS `remote_dba_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_dba_threads` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `ThreadsCached` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '线程缓存',
  `ThreadsConnected` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '线程链接',
  `ThreadsCreated` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '线程创建',
  `ThreadsRunning` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '线程执行',
  `MaxUsedConnections` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '使用链接数',
  `MaxUsedConnectionsTime` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '使用链接时间',
  `SendTime` timestamp NULL DEFAULT NULL COMMENT '发送时间',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据库线程监控表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_dba_threads`
--

LOCK TABLES `remote_dba_threads` WRITE;
/*!40000 ALTER TABLE `remote_dba_threads` DISABLE KEYS */;
/*!40000 ALTER TABLE `remote_dba_threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_disk`
--

DROP TABLE IF EXISTS `remote_disk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_disk` (
  `ID` tinyint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `Disk` varchar(50) NOT NULL DEFAULT '' COMMENT '硬盘',
  `RIO` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '每秒完成的读IO',
  `WIO` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '每秒完成的写IO',
  `RSect` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '每秒读扇区数',
  `WSect` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '每秒写扇区数',
  `Space` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '硬盘大小',
  `USpace` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '已使用硬盘大小',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主机分区表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_disk`
--

LOCK TABLES `remote_disk` WRITE;
/*!40000 ALTER TABLE `remote_disk` DISABLE KEYS */;
/*!40000 ALTER TABLE `remote_disk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remote_monitor`
--

DROP TABLE IF EXISTS `remote_monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remote_monitor` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `Memory` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '内存',
  `UMemory` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '已使用内存',
  `CPU` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'CPU使用情况',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主机监控表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remote_monitor`
--

LOCK TABLES `remote_monitor` WRITE;
/*!40000 ALTER TABLE `remote_monitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `remote_monitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主机类型ID',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `Type` char(10) NOT NULL DEFAULT 'server' COMMENT '主机类型（服务器或数据库）',
  `Name` char(10) NOT NULL DEFAULT 'server' COMMENT '类型名称',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_Type` (`Type`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='主机类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,1,'db','mysql','2017-03-30 09:44:47'),(2,1,'server','centos','2017-03-31 01:28:46'),(3,1,'server','windows','2017-04-05 03:08:00');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `GroupID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '组ID',
  `Account` char(16) NOT NULL DEFAULT '' COMMENT '帐号',
  `Nick` varchar(20) DEFAULT NULL COMMENT '昵称',
  `Name` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名',
  `Password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `Mobile` char(11) DEFAULT '' COMMENT '手机',
  `Email` varchar(50) DEFAULT '' COMMENT '邮箱',
  `IsDisable` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_Account` (`Account`),
  KEY `idx_GroupID` (`GroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'doomsday','doomsday','程惠铭','e10adc3949ba59abbe56e057f20f883e','13432499704','365448848@qq.com',0,'2017-03-20 08:38:18'),(3,1,'test','测试','测试','e10adc3949ba59abbe56e057f20f883e','13432499704','365448848@qq.com',0,'2017-04-05 03:32:31');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `Name` varchar(20) NOT NULL DEFAULT '' COMMENT '组名',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,'自动化运维组','2017-03-27 09:16:28'),(2,'运维组','2017-03-28 05:53:43'),(3,'测试组','2017-03-28 06:13:13'),(5,'开发组','2017-03-28 06:23:49'),(6,'管理组','2017-03-28 06:24:26');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_logs`
--

DROP TABLE IF EXISTS `web_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_logs` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `Domain` varchar(255) DEFAULT NULL COMMENT '域名',
  `Message` text COMMENT '错误信息',
  `Severity` varchar(255) DEFAULT NULL COMMENT '严重程度',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `Domain` (`Domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='网站日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_logs`
--

LOCK TABLES `web_logs` WRITE;
/*!40000 ALTER TABLE `web_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-05 18:20:16
