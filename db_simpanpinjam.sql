/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.31-MariaDB : Database - db_simpanpinjam
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simpanpinjam` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_simpanpinjam`;

/*Table structure for table `tb_anggota` */

DROP TABLE IF EXISTS `tb_anggota`;

CREATE TABLE `tb_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `noktp` varchar(50) DEFAULT NULL,
  `kelamin_id` int(11) DEFAULT NULL COMMENT '1=laki, 2=perempuan',
  `status_aktif` int(11) DEFAULT '0' COMMENT '1=aktif, 2=nonaktif',
  `user_id` int(11) DEFAULT NULL COMMENT 'user operator yang menambahkan',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_anggota` */

LOCK TABLES `tb_anggota` WRITE;

insert  into `tb_anggota`(`id`,`no_anggota`,`nama`,`alamat`,`telepon`,`noktp`,`kelamin_id`,`status_aktif`,`user_id`) values (1,'2018000000001','Kadek Sastrawan','Jl. Wibisana No. 71','082103901239','510301230130',1,2,9);
insert  into `tb_anggota`(`id`,`no_anggota`,`nama`,`alamat`,`telepon`,`noktp`,`kelamin_id`,`status_aktif`,`user_id`) values (2,'2018000000002','Bayu','Jl. Sekar Tunjung No. 52, Denpasar','089234581203','5103031902970004',1,1,11);
insert  into `tb_anggota`(`id`,`no_anggota`,`nama`,`alamat`,`telepon`,`noktp`,`kelamin_id`,`status_aktif`,`user_id`) values (3,'2019000000001','Kusuma Putra','Jl. Merta Sari No. XVII, Denpasar','081391083723','5103031302980005',1,1,9);
insert  into `tb_anggota`(`id`,`no_anggota`,`nama`,`alamat`,`telepon`,`noktp`,`kelamin_id`,`status_aktif`,`user_id`) values (4,'2019000000002','krisna','Jl. Raya Gadon','087861787361','5103061901990004',1,1,11);

UNLOCK TABLES;

/*Table structure for table `tb_jenis_transaksi` */

DROP TABLE IF EXISTS `tb_jenis_transaksi`;

CREATE TABLE `tb_jenis_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi` varchar(100) DEFAULT NULL,
  `tipe` int(11) DEFAULT NULL COMMENT '1 = penambahan, -1 =pengurangan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenis_transaksi` */

LOCK TABLES `tb_jenis_transaksi` WRITE;

insert  into `tb_jenis_transaksi`(`id`,`transaksi`,`tipe`) values (1,'Simpanan',1);
insert  into `tb_jenis_transaksi`(`id`,`transaksi`,`tipe`) values (2,'Penarikan',-1);
insert  into `tb_jenis_transaksi`(`id`,`transaksi`,`tipe`) values (3,'Bunga',1);
insert  into `tb_jenis_transaksi`(`id`,`transaksi`,`tipe`) values (4,'Pajak',-1);

UNLOCK TABLES;

/*Table structure for table `tb_master_bunga_simpanan` */

DROP TABLE IF EXISTS `tb_master_bunga_simpanan`;

CREATE TABLE `tb_master_bunga_simpanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persentase` double DEFAULT NULL,
  `tanggal_mulai_berlaku` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_master_bunga_simpanan` */

LOCK TABLES `tb_master_bunga_simpanan` WRITE;

insert  into `tb_master_bunga_simpanan`(`id`,`persentase`,`tanggal_mulai_berlaku`) values (1,3,'2019-02-08');
insert  into `tb_master_bunga_simpanan`(`id`,`persentase`,`tanggal_mulai_berlaku`) values (2,2,'2019-01-01');
insert  into `tb_master_bunga_simpanan`(`id`,`persentase`,`tanggal_mulai_berlaku`) values (3,1.5,'2019-01-02');
insert  into `tb_master_bunga_simpanan`(`id`,`persentase`,`tanggal_mulai_berlaku`) values (4,1.7,'2018-12-24');

UNLOCK TABLES;

/*Table structure for table `tb_simpanan` */

DROP TABLE IF EXISTS `tb_simpanan`;

CREATE TABLE `tb_simpanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_id` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jenis_transaksi` int(11) DEFAULT NULL COMMENT 'lihat tabel tb_jenis_transaksi',
  `nominal_transaksi` double DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anggota_id` (`anggota_id`),
  KEY `jenis_transaksi` (`jenis_transaksi`),
  CONSTRAINT `tb_simpanan_ibfk_2` FOREIGN KEY (`jenis_transaksi`) REFERENCES `tb_jenis_transaksi` (`id`),
  CONSTRAINT `tb_simpanan_ibfk_3` FOREIGN KEY (`anggota_id`) REFERENCES `tb_anggota` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `tb_simpanan` */

LOCK TABLES `tb_simpanan` WRITE;

insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (1,1,'2018-12-10 11:00:52',1,300000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (2,1,'2018-12-10 11:01:34',1,200000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (3,1,'2018-12-10 11:01:47',2,-100000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (4,1,'2018-12-10 11:02:06',1,500000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (5,1,'2018-12-10 11:02:18',1,250000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (6,1,'2018-12-10 11:04:58',2,-300000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (7,1,'2018-12-31 22:06:33',1,150000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (8,1,'2018-12-31 22:19:21',2,-500000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (9,1,'2018-12-31 22:29:32',1,300000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (10,3,'2019-01-02 22:32:05',1,250000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (11,3,'2019-01-02 22:32:36',1,750000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (16,1,'2019-02-28 16:04:20',3,24000,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (17,3,'2019-02-28 16:04:20',3,0,9);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (18,1,'2019-01-09 20:04:03',1,100000,11);
insert  into `tb_simpanan`(`id`,`anggota_id`,`tanggal`,`jenis_transaksi`,`nominal_transaksi`,`id_user`) values (19,3,'2019-01-10 20:05:06',1,100000,9);

UNLOCK TABLES;

/*Table structure for table `tb_trx_perhitungan_bunga_simpanan` */

DROP TABLE IF EXISTS `tb_trx_perhitungan_bunga_simpanan`;

CREATE TABLE `tb_trx_perhitungan_bunga_simpanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_bulan` int(11) DEFAULT NULL,
  `trx_tahun` int(11) DEFAULT NULL,
  `tanggal_proses` datetime DEFAULT NULL,
  `persentase_bunga` double DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_trx_perhitungan_bunga_simpanan` */

LOCK TABLES `tb_trx_perhitungan_bunga_simpanan` WRITE;

insert  into `tb_trx_perhitungan_bunga_simpanan`(`id`,`trx_bulan`,`trx_tahun`,`tanggal_proses`,`persentase_bunga`,`id_user`) values (3,2,2019,'2019-02-28 16:04:20',3,9);

UNLOCK TABLES;

/*Table structure for table `tb_users` */

DROP TABLE IF EXISTS `tb_users`;

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL COMMENT '1 = user pengelola simpanan, 2=user pengelola pinjaman, 3=user admin',
  `status_aktif` int(11) DEFAULT NULL COMMENT '1 = aktif, 0 = nonaktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tb_users` */

LOCK TABLES `tb_users` WRITE;

insert  into `tb_users`(`id`,`nik`,`nama`,`username`,`password`,`user_role`,`status_aktif`) values (9,'5103031411990003','Kadek Sastrawan','sastrawanikadek','$2y$10$ArJwLSL0hnX9aebVlTad1er6dtGYv7BfMHvFZbEJAqtBasdlCwaOK',3,1);
insert  into `tb_users`(`id`,`nik`,`nama`,`username`,`password`,`user_role`,`status_aktif`) values (10,'5103033112990003','Ryoga Kusnanda','ryogakusnanda','$2y$10$7UvOg8TZzY9uwgb/5/jahuco6y1N62SifItMi275/yG0JAKs3G.JW',1,1);
insert  into `tb_users`(`id`,`nik`,`nama`,`username`,`password`,`user_role`,`status_aktif`) values (11,'5103061901990004','I Nyoman Krisna Bayu','krisna_bayu','$2y$10$pMyTPSt.URgQ1QlW2GwrQePAxHexKXQfL50UnXT.bAh1Usg81EuM.',3,1);

UNLOCK TABLES;

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `mutasi_simpanan_event` */

/*!50106 DROP EVENT IF EXISTS `mutasi_simpanan_event`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `mutasi_simpanan_event` ON SCHEDULE EVERY 5 MINUTE STARTS '2018-11-30 23:59:00' ON COMPLETION PRESERVE ENABLE DO begin
	DECLARE i INT DEFAULT 0;
	DECLARE id_anggota INT;
	DECLARE total_anggota INT;
	DECLARE total_data INT;
	DECLARE saldo DOUBLE DEFAULT 0;
	DECLARE pajak DOUBLE DEFAULT 0;
	DECLARE bunga DOUBLE DEFAULT 0;
	DECLARE persentase_bunga_simpanan DOUBLE;
	DECLARE persentase_pajak_simpanan DOUBLE DEFAULT 0.15;
	
	IF DAY(CURDATE()) = DAY(LAST_DAY(CURDATE())) THEN
		IF HOUR(NOW()) = 23 THEN
			IF MINUTE(NOW()) >= 50 THEN
				SELECT COUNT(*) INTO total_data FROM tb_trx_perhitungan_bunga_simpanan WHERE tb_trx_perhitungan_bunga_simpanan.`trx_bulan` = MONTH(CURDATE()) AND tb_trx_perhitungan_bunga_simpanan.`trx_tahun` = YEAR(CURDATE());
				
				IF total_data = 0 THEN
					SELECT COUNT(*) INTO total_anggota FROM tb_anggota WHERE tb_anggota.`status_aktif` = 1;
					
					WHILE i < total_anggota DO
						SELECT tb_anggota.`id` INTO id_anggota FROM tb_anggota WHERE tb_anggota.`status_aktif` = 1 LIMIT i,1;
						
						SELECT MAX(tb_master_bunga_simpanan.`persentase`) INTO persentase_bunga_simpanan FROM tb_master_bunga_simpanan WHERE MONTH(tb_master_bunga_simpanan.`tanggal_mulai_berlaku`) = MONTH(CURDATE()) AND YEAR(tb_master_bunga_simpanan.`tanggal_mulai_berlaku`) = YEAR(CURDATE());
						
						SELECT SUM(tb_simpanan.`nominal_transaksi`) into saldo FROM tb_simpanan WHERE tb_simpanan.`anggota_id` = id_anggota AND DATE(tb_simpanan.`tanggal`) <= DATE_SUB(curdate(), INTERVAL DAY(LAST_DAY(curdate())) + DAY(LAST_DAY(DATE_SUB(curdate(), INTERVAL DAY(LAST_DAY(curdate())) DAY))) DAY);
						
						if saldo is null then
							set saldo = 0;
						end if;
						
						SET bunga = saldo * persentase_bunga_simpanan / 100;
						
						INSERT INTO tb_simpanan VALUES (NULL, id_anggota, NOW(), 3, bunga, 0);
						
						SELECT SUM(tb_simpanan.`nominal_transaksi`) INTO saldo FROM tb_simpanan WHERE tb_simpanan.`anggota_id` = id_anggota;
						
						IF saldo IS NULL THEN
							SET saldo = 0;
						END IF;
						
						SET pajak = saldo * persentase_pajak_simpanan / 100;
						
						INSERT INTO tb_simpanan VALUES (NULL, id_anggota, NOW(), 4, -1 * pajak, 0);
						
						SET saldo = 0;
						SET pajak = 0;
						SET bunga = 0;
						SET i = i + 1;
					END WHILE;
					INSERT INTO tb_trx_perhitungan_bunga_simpanan VALUES (NULL, MONTH(CURDATE()), YEAR(CURDATE()), NOW(), persentase_bunga_simpanan, 0);
				END IF;
			END IF;
		END IF;
	END IF;
end */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
