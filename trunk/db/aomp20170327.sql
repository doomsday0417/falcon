# Host: 192.168.106.128  (Version 5.6.15-log)
# Date: 2017-03-27 18:07:24
# Generator: MySQL-Front 6.0  (Build 1.88)


#
# Structure for table "group_power"
#

DROP TABLE IF EXISTS `group_power`;
CREATE TABLE `group_power` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `GroupID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '组ID',
  `PowerID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  `Power` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '权限(4：读、2：新增或修改、1删除)',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_GroupID` (`GroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='组权限';

#
# Data for table "group_power"
#

/*!40000 ALTER TABLE `group_power` DISABLE KEYS */;
INSERT INTO `group_power` VALUES (1,1,1,7,'2017-03-27 17:16:56'),(2,1,2,7,'2017-03-27 17:17:07');
/*!40000 ALTER TABLE `group_power` ENABLE KEYS */;

#
# Structure for table "login_log"
#

DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '登陆日志ID',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_UserId` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='登陆日志表';

#
# Data for table "login_log"
#

INSERT INTO `login_log` VALUES (1,1,'2017-03-20 14:53:57'),(2,1,'2017-03-20 14:55:08'),(3,1,'2017-03-20 15:11:10'),(4,1,'2017-03-20 15:12:19'),(5,1,'2017-03-20 15:12:28'),(6,1,'2017-03-20 15:13:07'),(7,1,'2017-03-20 15:15:57'),(8,1,'2017-03-20 15:21:44'),(9,1,'2017-03-20 15:32:24'),(10,1,'2017-03-20 15:58:51'),(11,1,'2017-03-20 15:59:15'),(12,1,'2017-03-20 16:00:20'),(13,1,'2017-03-20 16:02:37'),(14,1,'2017-03-20 16:02:54'),(15,1,'2017-03-20 16:25:26'),(16,1,'2017-03-20 16:25:51'),(17,1,'2017-03-20 16:26:37'),(18,1,'2017-03-20 17:28:13'),(19,1,'2017-03-21 09:25:01'),(20,1,'2017-03-21 10:01:14');

#
# Structure for table "power"
#

DROP TABLE IF EXISTS `power`;
CREATE TABLE `power` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `PowerName` varchar(30) NOT NULL DEFAULT '' COMMENT '权限名',
  `PowerClass` char(30) NOT NULL DEFAULT '' COMMENT '对应的controller',
  `Sort` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序(高到低)',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_ID_Sort` (`ID`,`Sort`),
  KEY `idx_Sort` (`Sort`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='权限表';

#
# Data for table "power"
#

INSERT INTO `power` VALUES (1,'权限表管理','power',0,'2017-03-24 10:49:17'),(2,'组管理','group',1,'2017-03-24 15:35:10');

#
# Structure for table "remote"
#

DROP TABLE IF EXISTS `remote`;
CREATE TABLE `remote` (
  `ID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `TypeID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机类型',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `Name` varchar(25) NOT NULL DEFAULT '' COMMENT '主机名',
  `IP` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '主机IP',
  `IsDisable` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_UserID` (`UserID`),
  KEY `idx_IP` (`IP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='主机表';

#
# Data for table "remote"
#


#
# Structure for table "remote_admin"
#

DROP TABLE IF EXISTS `remote_admin`;
CREATE TABLE `remote_admin` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理ID',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '管理者ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_UserID` (`UserID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='主机管理表';

#
# Data for table "remote_admin"
#


#
# Structure for table "remote_dba"
#

DROP TABLE IF EXISTS `remote_dba`;
CREATE TABLE `remote_dba` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `DbState` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '数据库状态',
  `QPS` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'QPS',
  `Select` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '查询',
  `Insert` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '添加',
  `Update` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '更新',
  `Delete` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '删除',
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
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主机数据库监控';

#
# Data for table "remote_dba"
#


#
# Structure for table "remote_dba_backup"
#

DROP TABLE IF EXISTS `remote_dba_backup`;
CREATE TABLE `remote_dba_backup` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `RemoteID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '主机ID',
  `LastBackupTime` timestamp NULL DEFAULT NULL COMMENT '最后备份时间',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`),
  KEY `idx_RemoteID` (`RemoteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据库备份记录';

#
# Data for table "remote_dba_backup"
#


#
# Structure for table "remote_dba_logs"
#

DROP TABLE IF EXISTS `remote_dba_logs`;
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

#
# Data for table "remote_dba_logs"
#


#
# Structure for table "remote_dba_threads"
#

DROP TABLE IF EXISTS `remote_dba_threads`;
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

#
# Data for table "remote_dba_threads"
#


#
# Structure for table "remote_disk"
#

DROP TABLE IF EXISTS `remote_disk`;
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

#
# Data for table "remote_disk"
#


#
# Structure for table "remote_monitor"
#

DROP TABLE IF EXISTS `remote_monitor`;
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

#
# Data for table "remote_monitor"
#


#
# Structure for table "remote_type"
#

DROP TABLE IF EXISTS `remote_type`;
CREATE TABLE `remote_type` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主机类型ID',
  `UserID` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建者',
  `Name` char(10) NOT NULL DEFAULT 'server' COMMENT '类型名称',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='主机类型表';

#
# Data for table "remote_type"
#


#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'doomsday','doomsday','程惠铭','e10adc3949ba59abbe56e057f20f883e','13432499704','365448848@qq.com',0,'2017-03-20 16:38:18');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

#
# Structure for table "user_group"
#

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `Name` varchar(20) NOT NULL DEFAULT '' COMMENT '组名',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户组';

#
# Data for table "user_group"
#

/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,'自动化运维组','2017-03-27 17:16:28');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
