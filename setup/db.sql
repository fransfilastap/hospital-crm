/*
SQLyog Community v11.28 (64 bit)
MySQL - 5.1.36-community-log : Database - rf_crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rf_crm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rf_crm`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','superuser','dokter') NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`admin_id`,`name`,`username`,`password`,`role`) values (1,'Administrator','admin','21232f297a57a5a743894a0e4a801fc3','superuser'),(3,'Rahma Fitri','imaimarf','d88d172522b49e3a23ece53615a371a5','dokter'),(5,'tesi','tesi','6fbaf68eea51c5e311765fdb2058c0e9','admin'),(18,'dr. Rahma Fitri','NIP','2be69d2c4f6a31bb2ae7db875035037e','dokter'),(19,'dr. Frans Filasta Pratama','asd','7815696ecbf1c96e6894b779456d330e','dokter'),(21,'Tukul','123456','e10adc3949ba59abbe56e057f20f883e','dokter'),(22,'dr. Adhi Tantowi, Sp.PD','004','11364907cf269dd2183b64287156072a','dokter'),(23,'dr. Iwan Destiawan, Sp.BS, M.Kes','005','ce08becc73195df12d99d761bfbba68d','dokter'),(24,'dr. Dedy Firmansyah, Sp.OT','006','568628e0d993b1973adc718237da6e93','dokter'),(25,'dr. Heru Purwanto, Sp.B','007','9e94b15ed312fa42232fd87a55db0d39','dokter'),(26,'Mayor Ckm dr. Syamsu Rijal, Sp.A','008','a13ee062eff9d7295bfc800a11f33704','dokter'),(27,'dr. Prakanita Basyir, Sp.A','009','dc5e819e186f11ef3f59e6c7d6830c35','dokter'),(30,' dr. yang Tjik, Sp.A','010','ea20a043c08f5168d4409ff4144f32e2','dokter'),(31,'dr. Darwin Ansyori, Sp.A (K)','011','84eb13cfed01764d9c401219faa56d53','dokter'),(32,'Letnan Kolonel Ckm dr. IGP Yuliartha, Sp.KK','012','d2490f048dc3b77a457e3e450ab4eb38','dokter'),(33,' Mayor Ckm dr. Nirwan Arief, Sp.M','013','441954d29ad2a375cef8ea524a2c7e73','dokter'),(34,' Letkol Ckm dr. Dzulfadhli Daulay, Sp.OG','014','0e51011a4c4891e5c01c12d85c4dcaa7','dokter'),(37,'dr. Kms. Anhar, Sp.OG','015','af032fbcb07ffc7bd2569d86ae4ce1f5','dokter'),(38,'Kolonel Ckm dr. Toni Siguntang, Sp.THT, Mars','016','73f7634ab3f381fb40995f93740b3f8a','dokter'),(40,'. Letkol Ckm dr. Bima Wisnu Nugraha, Sp.THT, M.Kes','017','738cccd4fda172441f216712a488dca6','dokter'),(41,'. Kolonel Ckm drg. Nirwan Husni Lubis, Sp.BM, Mars','018','7658d0d2112eb265d6496cbac9de1e24','dokter'),(42,'Letnan Kolonel Ckm drg. Djamal Riza, Sp.BM','019','9c3ce93643ed68583a32f9056b0dd3b6','dokter');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id_category` int(4) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(120) DEFAULT NULL,
  `description` varchar(120) DEFAULT NULL,
  `category_parent` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_category`),
  KEY `category_parent` (`category_parent`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id_category`,`category_name`,`description`,`category_parent`) values (1,'Berita','Kelompok posting berita',NULL),(3,'Pengumuman','Kelompok Posting Pengumuman',NULL),(5,'Artikel','Kelompok Posting Artikel Kesehatan',NULL);

/*Table structure for table `daemons` */

DROP TABLE IF EXISTS `daemons`;

CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `daemons` */

/*Table structure for table `dokter` */

DROP TABLE IF EXISTS `dokter`;

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `nip_dokter` varchar(225) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `spesialisasi` varchar(225) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_dokter`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `dokter` */

insert  into `dokter`(`id_dokter`,`nip_dokter`,`nama`,`spesialisasi`,`no_telp`,`alamat`) values (1,'001','Mayor Ckm dr. Hartono, Sp.S','Syaraf','08981169578','<p>Palembang</p>'),(2,'002','dr. Budiman, Sp.S','Syaraf','08974420763','<p>Prabumulih</p>'),(5,'003','Mayor Ckm dr. Fenti Alvian Amu, Sp.P','Penyakit Dalam','0891231231','<p>Palembang</p>'),(6,'004','dr. Adhi Tantowi, Sp.PD','Jantung','081273840681','<p>Palembang</p>'),(7,'005','dr. Iwan Destiawan, Sp.BS, M.Kes','Bedah Syaraf','08192260546','<p>Palembang</p>'),(8,'006','dr. Dedy Firmansyah, Sp.OT',' Bedah Orthopedy','085377450922','<p>Palembang</p>'),(9,'007','dr. Heru Purwanto, Sp.B',' Bedah Umum','0883785334','<p>Palembang</p>'),(10,'008','Mayor Ckm dr. Syamsu Rijal, Sp.A','Anak','08873456221','<p>Palembang</p>'),(11,'009','dr. Prakanita Basyir, Sp.A','Anak','08134423576','<p>Palembang</p>'),(14,'010',' dr. yang Tjik, Sp.A','Anak','091323884321','<p>Palembang</p>'),(15,'011','dr. Darwin Ansyori, Sp.A (K)','Anak','0812223448898','<p>Palembang</p>'),(16,'012','Letnan Kolonel Ckm dr. IGP Yuliartha, Sp.KK','Kulit & Kelamin','081426785532','<p>Palembang</p>'),(17,'013',' Mayor Ckm dr. Nirwan Arief, Sp.M','Mata','087866324563','<p>Palembang</p>'),(18,'014',' Letkol Ckm dr. Dzulfadhli Daulay, Sp.OG','Obstetri dan Ginekologi','08563246789','<p>Palembang</p>'),(21,'015','dr. Kms. Anhar, Sp.OG','Obstetri dan Ginekologi','085687732412','<p>Palembang</p>'),(22,'016','Kolonel Ckm dr. Toni Siguntang, Sp.THT, Mars','THT','08156782345','<p>Palembang</p>'),(24,'017','Letkol Ckm dr. Bima Wisnu Nugraha, Sp.THT, M.Kes','THT','08215638625','<p>Palembang</p>'),(25,'018','Kolonel Ckm drg. Nirwan Husni Lubis, Sp.BM, Mars','Bedah Mulut','081267396579','<p>Palembang</p>'),(26,'019','Letnan Kolonel Ckm drg. Djamal Riza, Sp.BM','Bedah Mulut','081567829328','<p>Palembang</p>');

/*Table structure for table `gammu` */

DROP TABLE IF EXISTS `gammu`;

CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `gammu` */

insert  into `gammu`(`Version`) values (13);

/*Table structure for table `halaman` */

DROP TABLE IF EXISTS `halaman`;

CREATE TABLE `halaman` (
  `id_halaman` int(11) NOT NULL AUTO_INCREMENT,
  `judul_halaman` varchar(100) NOT NULL,
  `isi_halaman` text NOT NULL,
  `tanggal_buat` date NOT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_halaman`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `halaman` */

insert  into `halaman`(`id_halaman`,`judul_halaman`,`isi_halaman`,`tanggal_buat`,`penulis`) values (5,'Visi - Misi','<p> </p>\r\n<p><strong>Visi</strong></p>\r\n<p>        Menjadi rumah sakit kebanggaan prajurit, PNS, dan keluarga Kodam II/SWJ serta masyarakat umum.</p>\r\n<p> </p>\r\n<p><strong>Misi</strong></p>\r\n<ul>\r\n<li>Menyelenggarakan pelayanan prima</li>\r\n<li>Menyiapkan fasilitas yang representatif dan memadai</li>\r\n<li>Meningkatkan sumber daya manusia yang professional</li>\r\n</ul>\r\n<p> </p>\r\n<p><strong>Motto</strong></p>\r\n<p><strong><span>          </span></strong>Senyum Sapa Sentuh Sembuh</p>','2014-06-02','admin'),(7,'Sejarah','<p align=\"justify\"><strong>Sejarah Singkat Rumah Sakit Dr. AK Gani</strong>      </p>\r\n<p align=\"justify\"> </p>\r\n<p align=\"justify\">     RS Tk. II dr. AK Gani Palembang ( RS Dr. AK Gani ) yang mempunyai tugas pokok memberikan bantuan kesehatan berupa pelayanan kesehatan terhadap anggota TNI AD, PNS, dan keluarganya, , disamping memberikan pelayanan kesehatan bagi komando atas dan merupakan proses rujukan tertinggi bagi fasilitas kesehatan TNI AD yang ada di jajaran Kodam II / Sriwijaya.</p>\r\n<p align=\"justify\">        RS Dr. AK Gani Palembang adalah Rumah Sakit  Tingkat II di lingkungan TNI-AD. Terletak di Jalan Dr. AK Gani No. 1, Kelurahan 19 Ilir, Kecamatan Ilir Timur 1, Kota Palembang. Tugas pokok RS Dr. AK Gani Palembang adalah  memberikan dukungan dan pelayanan kesehatan kepada Prajurit TNI, PNS, dan keluarganya di wilayah Kodam II/ Sriwijaya Palembang dalam rangka mendukung tugas pokok TNI Angkatan Darat.</p>\r\n<p align=\"justify\">        Sejarah singkat RS Dr. AK Gani Palembang dikumpulkan dari data administrasi yang masih ada dan keterangan-keterangan dari para sesepuh yang kebetulan masih bermukin di daerah Sumatera Selatan umumnya, Kota Palembang khususnya. Sebelum tahun 1950 rumah sakit ini bernama Militaire Hospital sebagai bagian dari Militaire Geneskundige Dienst (MGD) yang dipimpin oleh Letkol Dr. Hordhokreht dan Kapten (Apoteker) Bouman.</p>\r\n<p align=\"justify\">     Pada tanggal 13 Mei 1950 rumah sakit yang bernama Militaire Hospital ini diserahkan oleh KL/KNIL kepada Angkatan Perang Republik Indonesia (APRI), dalam rangka serah terima ini bertindak sebagai wakil dari masing-masing pihak adalah Letnan Kolonel Dr. Nordhoekrecht mewakili KL/KNIL, dan APRI sebagai pihak yang menerima diwakili oleh Mayor Dr. Ibnu Sutowo.</p>\r\n<p align=\"justify\">     Pelaksanaan serah terima ini dilakukan secara bertahap berhubungan dengan penarikan tentara KL/KNIL dari daerah pedalaman ke Palembang, sementara itu penggunaan Rumah Sakit ini masih dilakukan secara bersama antara tentara KL/KNIL dengan APRI.</p>\r\n<p align=\"justify\">     Setelah penyerahan dari KL/KNIL maka Rumah Sakit ini dinamakan Rumah Sakit Territorium II, disingkat dengan nama RSTT. II. Kemudian sesuai dengan perubahan nama di lingkungan TNI Angkatan Darat, dimana daerah militer di seluruh Indonesia juga mengalami perubahan nama, maka rumah sakit ini dirubah namanya menjadi Rumah Sakit Kodam IV/Sriwijaya.</p>\r\n<p align=\"justify\">     Kemudian disesuaikan lagi namanya menjadi Rumah Sakit Tk. III/IV/Sriwijaya berdasarkan Keputusan Kasad No:SK/67/III/1973 tanggal 23 Maret 1973 dan Keputusan Kasad No:SK/147/VII/1973 tanggal 16 Juli 1973 ditetapkan Rumah Sakit Tk. III/IV/Sriwijaya sebagai rumah sakit tingkat IV dengan kapasitas 340 tempat tidur.</p>\r\n<p align=\"justify\">     Walaupun benerapa kali mengalami perubahan nama tapi yang dapat ditonjolkan disini yang tidak pernah luntur dari ingatan masyarakat di daerah ini suatu nama yang sejak dulu kala hingga sekarang dan sangat popular adalah Rumah Sakit Benteng. Hal ini disebabkan lokasi Rumah Sakit Tk. III/IV/Sriwijaya terletak di dalam suatu komplek Benteng Kuto Besak seperti yang masih terlihat sekarang ini.</p>\r\n<p align=\"justify\">     Pergantian nama rumah sakit berdasarkan Surat Keputusan Kasad No:Skep/1210/VIII/1976 tanggal 25 Agustus 1976 dan Surat Perintah Pangdam IV/Sriwijaya Nomor:Sprin/1328/IX/1976 tanggal 30 September 1976 Rumah Sakit Tk.III/IV/Sriwijaya diberikan nama baru yaitu Rumkit Tk.IV Dr. AK Gani, yang pada akhirnya berubah menjadi Rumkit Tk.II Dr. AK Gani seiring dengan perubahan Kodam IV/Sriwijaya menjadi Kodam II/Sriwijaya.</p>\r\n<p align=\"justify\">       RS Dr. AK Gani adalah bangunan kuno peninggalan pemerintah kolonial Belanda yang waktu itu digunakan sebagai markas pertahanan Belanda untuk menghambat  masuknya musuh mereka yaitu Angkatan Perang Republik Indonesia (APRI) terutama serangan yang datang dari arah sungai Musi.</p>\r\n<p align=\"justify\">       Pada tanggal 13 Mei 1950 rumah sakit ini diserahkan oleh pemerintah Belanda kepada pemerintah Indonesia (APRI) dan selanjutnya digunakan oleh pemerintah Indonesia sebagai Instalasi Kesehatan TNI yang waktu itu dikelola oleh Jawatan Kesehatran Angkatan Darat (Jankesad) dan seterusnya seiring dengan perkembangan organisasi TNI Angkatan Darat rumah sakit diberi nama Rumah Sakit Dr. AK Gani Kesdam II/Sriwijaya, dimana pemberian nama tersebut didasari untuk mengenang jasa-jasa dari Dr. Adenan Kapau Gani yang banyak berjuang membantu APRI saat melawan kolonial Belanda.</p>\r\n<p align=\"justify\">      Pada tanggal 22 Nopember 1976 diresmikan nama RS Dr. AK Gani Kesdam II/Sriwijaya oleh Kepala Jawatan Kesehatan Angkatan Darat Brigadir Jenderal TNI Dr. Prakosa, dengan sebutan sekarang Rumah Sakit Tingkat II dr. AK Gani.</p>','2014-06-01','admin'),(8,'Sarana dan Prasarana','<p> </p>\r\n<p>Sarana dan Prasarana yang terdapat di Rumah Sakit Tingkat II Dr. AK Gani antara lain</p>\r\n<ul>\r\n<li><strong>Layanan 24 jam</strong>, meliputi: </li>\r\n<ol>\r\n<li>Ambulance </li>\r\n<li>Farmasi</li>\r\n<li>Unit Rawat Intensif (ICU)</li>\r\n</ol></ul>\r\n<p> </p>\r\n<ul>\r\n<li><strong>Poliklinik, </strong>meliputi:</li>\r\n<ol>\r\n<li>Poliklinik Syaraf</li>\r\n<li>Poliklinik Kulit dan Kelamin</li>\r\n<li>Poliklinik Penyakit Dalam dan Jantung</li>\r\n<li>Poliklinik Anak</li>\r\n<li>Poliklinik Mata</li>\r\n<li>Poliklinik Kebidanan dan Kandungan</li>\r\n<li>Poliklinik Bedah</li>\r\n<li>Poliklinik THT</li>\r\n<li>Poliklinik Gigi</li>\r\n</ol></ul>\r\n<p> </p>\r\n<ul>\r\n<li><strong>Instalasi Rawat Inap</strong>, meliputi:</li>\r\n<ol>\r\n<li>Paviliun Anggrek</li>\r\n<li>Paviliun Mawar</li>\r\n<li>VIP Wijaya Kesuma</li>\r\n<li>Paviliun Flamboyan (Penyakit Dalam Pria)</li>\r\n<li>Paviliun Teratai (Penyakit Dalam Wanita)</li>\r\n<li>Paviliun Dahlia (Bedah Wanita)</li>\r\n<li>Paviliun Cempaka (Bedah Pria)</li>\r\n<li>Paviliun Melati (Kebidanan dan Neonatus)</li>\r\n<li>Paviliun Aster (Rawat Anak)</li>\r\n</ol></ul>\r\n<p> </p>\r\n<ul>\r\n<li><strong>Pelayanan Penunjang</strong>, meliputi:<ol>\r\n<li><em>Echo Cardiography </em>dan <em>Treadmill</em></li>\r\n<li><em>Haemodialisa</em></li>\r\n<li>Rehabilitasi Medik dan <em>Fisiotherapi</em></li>\r\n<li>Laboratorium</li>\r\n<li>Radiologi CT Scan</li>\r\n<li>Instalasi Farmasi</li>\r\n</ol></li>\r\n</ul>\r\n<p> </p>','2014-06-02','admin'),(9,'Penghargaan dan Sertifikat','<p> </p>\r\n<p><img src=\"/crm/upload/images/AKREDITASI_DASAR.jpg\" alt=\"\" /></p>\r\n<p><span><span>Rumah Sakit Dr. AK Gani telah memiliki status Akreditasi Penuh Tingkat Dasar untuk:</span></span></p>\r\n<p>1. Administrasi dan Manajemen,</p>\r\n<p>2. Pelayanan Medis,</p>\r\n<p>3. Pelayanan Gawat Darurat,</p>\r\n<p>4. Pelayanan Keperawatan dan</p>\r\n<p>5. Rekam Medis</p>\r\n<p> </p>','2014-06-02',NULL);

/*Table structure for table `inbox` */

DROP TABLE IF EXISTS `inbox`;

CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL,
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('true','false') NOT NULL DEFAULT 'false',
  `Notification` enum('push','bar','notified','hide') DEFAULT 'push',
  `Read` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

/*Data for the table `inbox` */

insert  into `inbox`(`UpdatedInDB`,`ReceivingDateTime`,`Text`,`SenderNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`RecipientID`,`Processed`,`Notification`,`Read`) values ('2014-07-09 01:14:08','2014-07-08 22:30:47','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',1,'','false','bar','true'),('2014-07-09 01:15:40','2014-07-08 22:30:57','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',2,'','false','bar','true'),('2014-07-09 01:15:32','2014-07-08 22:31:05','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',3,'','false','bar','true'),('2014-07-09 01:15:17','2014-07-08 22:31:09','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',4,'','false','bar','true'),('2014-07-09 01:15:10','2014-07-08 22:31:14','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',5,'','false','bar','true'),('2014-07-09 01:15:02','2014-07-08 22:31:27','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',6,'','false','bar','true'),('2014-07-09 00:25:57','2014-07-08 22:31:34','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',7,'','false','bar','true'),('2014-07-09 00:31:14','2014-07-08 22:31:46','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',8,'','false','bar','true'),('2014-07-09 00:31:11','2014-07-08 22:31:52','005300670061006700610067006100670061006700610067','+628974420763','Default_No_Compression','','+628964011092',-1,'Sgagagagagag',9,'','false','bar','true'),('2014-07-09 00:31:09','2014-07-08 22:32:08','005400650065006500720065006100730073007300740074','+628974420763','Default_No_Compression','','+628964011092',-1,'Teeereassstt',10,'','false','bar','true'),('2014-07-09 00:25:51','2014-07-08 22:53:52','00430069007500650065','+628974420763','Default_No_Compression','','+6289644000001',-1,'Ciuee',11,'','false','bar','true'),('2014-07-09 01:14:12','2014-07-09 00:26:01','005400650073007400200061007000700065006E0064','+628974420763','Default_No_Compression','','+6289644000001',-1,'Test append',12,'','false','bar','true'),('2014-07-09 01:14:16','2014-07-09 00:27:03','005400650073007400200061007000700065006E0064','+628974420763','Default_No_Compression','','+628964011092',-1,'Test append',13,'','false','bar','true'),('2014-07-09 01:46:40','2014-07-09 00:32:03','00520045004700230050004100530030003000300030003500230050004F004C0049003000300033','+628974420763','Default_No_Compression','','+6289644000001',-1,'REG#PAS00005#POLI003',14,'','false','bar','true'),('2014-07-09 01:46:44','2014-07-09 00:34:39','00520045004700230050004100530030003000300030003500230050004F004C0049003000300033','+628974420763','Default_No_Compression','','+6289644000001',-1,'REG#PAS00005#POLI003',15,'','false','bar','true'),('2014-07-09 01:14:26','2014-07-09 00:38:19','00520045004700230050004100530030003000300030003500230050004F004C0049003000300033','+628974420763','Default_No_Compression','','+6289644000001',-1,'REG#PAS00005#POLI003',16,'','false','bar','true'),('2014-07-09 01:14:30','2014-07-09 00:39:17','00500065006C0061006E006700670061006E0020005900740068002C00200073006D00730020006B00650020006E006F006D006F0072002000360032003800390037003400340032003000370036003300200067006100670061006C0020006B006100720065006E0061002000700075006C0073006100200061006E0064006100200074006900640061006B0020006D0065006E00630075006B007500700069002C002000730069006C0061006B0061006E0020006D0065006C0061006B0075006B0061006E002000700065006E00670069007300690061006E002000700075006C00730061002E00200049006E0066006F0020006B00610072007400750020005400720069002000740065006B0061006E0020002A0031003200330023','3','Default_No_Compression','','+628964011092',-1,'Pelanggan Yth, sms ke nomor 628974420763 gagal karena pulsa anda tidak mencukupi, silakan melakukan pengisian pulsa. Info kartu Tri tekan *123#',17,'','false','bar','true'),('2014-07-09 01:14:34','2014-07-09 00:41:02','004D0065006E0067006100700061002E002E002E0020004B007500200062006500670069006E0069002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Mengapa... Ku begini...',18,'','false','bar','true'),('2014-07-09 01:14:45','2014-07-09 00:44:39','00480069006C0061006E0067006B0061006E002E002E002E00200052006100730061002000730061006B00690074006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Hilangkan... Rasa sakitku...',19,'','false','bar','true'),('2014-07-09 01:14:39','2014-07-09 01:13:12','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',20,'','false','bar','true'),('2014-07-09 01:18:23','2014-07-09 01:18:09','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',21,'','false','bar','true'),('2014-07-09 01:20:57','2014-07-09 01:20:43','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',22,'','false','bar','true'),('2014-07-09 01:24:30','2014-07-09 01:24:04','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',23,'','false','bar','true'),('2014-07-09 01:25:51','2014-07-09 01:25:25','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',24,'','false','bar','true'),('2014-07-09 01:44:18','2014-07-09 01:29:51','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',25,'','false','bar','true'),('2014-07-09 01:52:14','2014-07-09 01:51:56','004900440020005400720061006E00730061006B0073006900200030003700300037003000370032003600320031003100370039003700390033003300300031002E0020004E006F006D006F007200200041006E00640061002000740065006C00610068002000640069002D0074006F0070002000750070002000310030002C00300030003000200070006100640061002000300037002D00300037002D0032003000310034002000300037003A00320036003A00320031','+628974420763','Default_No_Compression','','+6289644000001',-1,'ID Transaksi 0707072621179793301. Nomor Anda telah di-top up 10,000 pada 07-07-2014 07:26:21',26,'','false','bar','true'),('2014-07-09 01:54:31','2014-07-09 01:54:12','004900440020005400720061006E00730061006B0073006900200030003700300037003000370032003600320031003100370039003700390033003300300031002E0020004E006F006D006F007200200041006E00640061002000740065006C00610068002000640069002D0074006F0070002000750070002000310030002C00300030003000200070006100640061002000300037002D00300037002D0032003000310034002000300037003A00320036003A00320031','+628974420763','Default_No_Compression','','+6289644000001',-1,'ID Transaksi 0707072621179793301. Nomor Anda telah di-top up 10,000 pada 07-07-2014 07:26:21',27,'','false','bar','true'),('2014-07-09 02:00:59','2014-07-09 02:00:12','004900440020005400720061006E00730061006B0073006900200030003700300037003000370032003600320031003100370039003700390033003300300031002E0020004E006F006D006F007200200041006E00640061002000740065006C00610068002000640069002D0074006F0070002000750070002000310030002C00300030003000200070006100640061002000300037002D00300037002D0032003000310034002000300037003A00320036003A00320031','+628974420763','Default_No_Compression','','+6289644000001',-1,'ID Transaksi 0707072621179793301. Nomor Anda telah di-top up 10,000 pada 07-07-2014 07:26:21',28,'','false','bar','true'),('2014-07-09 03:52:23','2014-07-09 03:52:00','004900440020005400720061006E00730061006B0073006900200030003700300037003000370032003600320031003100370039003700390033003300300031002E0020004E006F006D006F007200200041006E00640061002000740065006C00610068002000640069002D0074006F0070002000750070002000310030002C00300030003000200070006100640061002000300037002D00300037002D0032003000310034002000300037003A00320036003A00320031','+628974420763','Default_No_Compression','','+6289644000001',-1,'ID Transaksi 0707072621179793301. Nomor Anda telah di-top up 10,000 pada 07-07-2014 07:26:21',29,'','false','bar','true'),('2014-07-09 04:24:41','2014-07-09 03:52:51','004900440020005400720061006E00730061006B0073006900200030003700300037003000370032003600320031003100370039003700390033003300300031002E0020004E006F006D006F007200200041006E00640061002000740065006C00610068002000640069002D0074006F0070002000750070002000310030002C00300030003000200070006100640061002000300037002D00300037002D0032003000310034002000300037003A00320036003A00320031','+628974420763','Default_No_Compression','','+628964011092',-1,'ID Transaksi 0707072621179793301. Nomor Anda telah di-top up 10,000 pada 07-07-2014 07:26:21',30,'','false','bar','true'),('2014-07-09 04:24:37','2014-07-09 03:55:53','00520045004700230050004100530030003000300030003300230050004F004C0049003000300031','+628974420763','Default_No_Compression','','+6289644000001',-1,'REG#PAS00003#POLI001',31,'','false','bar','true'),('2014-07-09 04:24:32','2014-07-09 03:57:29','004D0061006D00610020006200750073006F006B','+628974420763','Default_No_Compression','','+6289644000001',-1,'Mama busok',32,'','false','bar','true'),('2014-07-09 04:08:15','2014-07-09 04:03:46','004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+628964011092',-1,'Mama busok nian',33,'','false','bar','true'),('2014-07-09 04:34:25','2014-07-09 04:31:16','004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Mama busok nian',34,'','false','bar','true'),('2014-07-09 04:31:40','2014-07-09 04:31:21','004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Mama busok nian',35,'','false','bar','true'),('2014-07-09 04:37:04','2014-07-09 04:35:08','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+6289644000001',-1,'QhejsjsndMama busok nianMama busok nian',36,'','false','bar','true'),('2014-07-09 04:40:24','2014-07-09 04:35:25','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+6289644000001',-1,'QhejsjsndMama busok nianMama busok nian',37,'','false','bar','true'),('2014-07-09 04:36:37','2014-07-09 04:35:32','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+6289644000001',-1,'QhejsjsndMama busok nianMama busok nian',38,'','false','bar','true'),('2014-07-09 04:36:59','2014-07-09 04:35:37','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+6289644000001',-1,'QhejsjsndMama busok nianMama busok nian',39,'','false','bar','true'),('2014-07-09 04:40:20','2014-07-09 04:35:50','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+628964011092',-1,'QhejsjsndMama busok nianMama busok nian',40,'','false','bar','true'),('2014-07-09 04:38:02','2014-07-09 04:35:54','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+628964011092',-1,'QhejsjsndMama busok nianMama busok nian',41,'','false','bar','true'),('2014-07-09 04:36:43','2014-07-09 04:35:58','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+628964011092',-1,'QhejsjsndMama busok nianMama busok nian',42,'','false','bar','true'),('2014-07-09 04:36:28','2014-07-09 04:36:06','005100680065006A0073006A0073006E0064004D0061006D00610020006200750073006F006B0020006E00690061006E004D0061006D00610020006200750073006F006B0020006E00690061006E','+628974420763','Default_No_Compression','','+6289644000001',-1,'QhejsjsndMama busok nianMama busok nian',43,'','false','bar','true'),('2014-07-09 04:49:04','2014-07-09 04:44:06','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',44,'','false','bar','true'),('2014-07-09 04:49:00','2014-07-09 04:44:10','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',45,'','false','bar','true'),('2014-07-09 04:45:02','2014-07-09 04:44:14','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',46,'','false','bar','true'),('2014-07-10 09:51:01','2014-07-10 09:50:45','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',47,'','false','bar','true'),('2014-07-10 09:55:36','2014-07-10 09:53:13','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',48,'','false','bar','true'),('2014-07-10 09:55:24','2014-07-10 09:55:06','00540061006B0020006B0061006E0020006100640061002000630069006E00740061002000790061006E00670020006400610070006100740020006D006500720061006E0067006B0075006C00200068006100740069006B0075002E002E002E','+628974420763','Default_No_Compression','','+6289644000001',-1,'Tak kan ada cinta yang dapat merangkul hatiku...',49,'','false','bar','true'),('2014-07-10 12:57:23','2014-07-10 10:26:24','002000520045004700230050004100530030003000300030003500230050004F004C0049003000300032','+628974420763','Default_No_Compression','','+6289644000001',-1,' REG#PAS00005#POLI002',50,'','false','bar','true'),('2014-07-10 22:38:05','2014-07-10 10:26:29','002000520045004700230050004100530030003000300030003500230050004F004C0049003000300032','+628974420763','Default_No_Compression','','+6289644000001',-1,' REG#PAS00005#POLI002',51,'','false','bar','true'),('2014-07-10 22:37:45','2014-07-10 10:28:02','002000520045004700230050004100530030003000300030003500230050004F004C0049003000300032','+628974420763','Default_No_Compression','','+6289644000001',-1,' REG#PAS00005#POLI002',52,'','false','bar','true'),('2014-07-10 12:57:19','2014-07-10 10:29:39','002000520045004700230050004100530030003000300030003500230050004F004C0049003000300021','+628974420763','Default_No_Compression','','+6289644000001',-1,' REG#PAS00005#POLI00!',53,'','false','bar','true'),('2014-07-10 12:41:28','2014-07-10 10:31:25','00500065006C0061006E006700670061006E0020005900740068002C00200073006D00730020006B00650020006E006F006D006F0072002000360032003800390037003400340032003000370036003300200067006100670061006C0020006B006100720065006E0061002000700075006C0073006100200061006E0064006100200074006900640061006B0020006D0065006E00630075006B007500700069002C002000730069006C0061006B0061006E0020006D0065006C0061006B0075006B0061006E002000700065006E00670069007300690061006E002000700075006C00730061002E00200049006E0066006F0020006B00610072007400750020005400720069002000740065006B0061006E0020002A0031003200330023','3','Default_No_Compression','','+628964011092',-1,'Pelanggan Yth, sms ke nomor 628974420763 gagal karena pulsa anda tidak mencukupi, silakan melakukan pengisian pulsa. Info kartu Tri tekan *123#',54,'','false','bar','true'),('2014-07-10 22:45:49','2014-07-10 22:39:26','00420061006E00790061006B002000700061007300740069002000640069006F002000740075002E002E002000470065007400700075007300680069006E0062006F007800200074007500200070006500720020003100200064006500740069006B0020006D0065006D0061006E00670020006E0069006D00620075006C002E002E000D0059006700200070006100730020006B006C0069006B0020006B006900720069006D0020006E00690061006E002000790067002000640069006C006900610074002C002000700072006F007300650073005F006B006900720069006D','+628974420763','Default_No_Compression','','+6289644000001',-1,'Banyak pasti dio tu.. Getpushinbox tu per 1 detik memang nimbul..\rYg pas klik kirim nian yg diliat, proses_kirim',55,'','false','bar','true'),('2014-07-10 22:45:43','2014-07-10 22:41:09','00420061006E00790061006B002000700061007300740069002000640069006F002000740075002E002E002000470065007400700075007300680069006E0062006F007800200074007500200070006500720020003100200064006500740069006B0020006D0065006D0061006E00670020006E0069006D00620075006C002E002E000D0059006700200070006100730020006B006C0069006B0020006B006900720069006D0020006E00690061006E002000790067002000640069006C006900610074002C002000700072006F007300650073005F006B006900720069006D','+628974420763','Default_No_Compression','','+628964011092',-1,'Banyak pasti dio tu.. Getpushinbox tu per 1 detik memang nimbul..\rYg pas klik kirim nian yg diliat, proses_kirim',56,'','false','bar','true'),('2014-07-10 22:47:32','2014-07-10 22:47:24','00590061006E0067003F','+628974420763','Default_No_Compression','','+6289644000001',-1,'Yang?',57,'','false','bar','true'),('2014-07-10 22:48:41','2014-07-10 22:48:35','00420061006E00790061006B002000700061007300740069002000640069006F002000740075002E002E002000470065007400700075007300680069006E0062006F007800200074007500200070006500720020003100200064006500740069006B0020006D0065006D0061006E00670020006E0069006D00620075006C002E002E000D0059006700200070006100730020006B006C0069006B0020006B006900720069006D0020006E00690061006E002000790067002000640069006C006900610074002C002000700072006F007300650073005F006B006900720069006D','+628974420763','Default_No_Compression','','+6289644000001',-1,'Banyak pasti dio tu.. Getpushinbox tu per 1 detik memang nimbul..\rYg pas klik kirim nian yg diliat, proses_kirim',58,'','false','bar','true'),('2014-07-10 23:01:01','2014-07-10 22:54:46','00500065006C0061006E006700670061006E0020005900740068002C00200073006D00730020006B00650020006E006F006D006F007200200030003800390037003400340032003000370036003300200067006100670061006C0020006B006100720065006E0061002000700075006C0073006100200061006E0064006100200074006900640061006B0020006D0065006E00630075006B007500700069002C002000730069006C0061006B0061006E0020006D0065006C0061006B0075006B0061006E002000700065006E00670069007300690061006E002000700075006C00730061002E00200049006E0066006F0020006B00610072007400750020005400720069002000740065006B0061006E0020002A0031003200330023','3','Default_No_Compression','','+628964011092',-1,'Pelanggan Yth, sms ke nomor 08974420763 gagal karena pulsa anda tidak mencukupi, silakan melakukan pengisian pulsa. Info kartu Tri tekan *123#',59,'','false','bar','true');

/*Table structure for table `jadwal_dokter` */

DROP TABLE IF EXISTS `jadwal_dokter`;

CREATE TABLE `jadwal_dokter` (
  `id_waktu` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_akhir` time DEFAULT NULL,
  PRIMARY KEY (`id_waktu`,`id_dokter`),
  KEY `id_dokter` (`id_dokter`),
  CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`id_waktu`) REFERENCES `waktu_jadwal` (`id_waktu_jadwal`),
  CONSTRAINT `jadwal_dokter_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwal_dokter` */

insert  into `jadwal_dokter`(`id_waktu`,`id_dokter`,`waktu_mulai`,`waktu_akhir`) values (1,1,'10:22:30','11:22:30'),(1,2,'08:30:00','11:47:45'),(2,1,'10:22:30','11:22:30'),(5,1,'12:55:15','13:55:15');

/*Table structure for table `konsultasi` */

DROP TABLE IF EXISTS `konsultasi`;

CREATE TABLE `konsultasi` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `Jawaban` text,
  `author` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tampilkan` tinyint(1) DEFAULT '0',
  `id_dokter` int(5) NOT NULL,
  `read` enum('true','false') DEFAULT 'false',
  `Notification` enum('push','notified','bar','hide') DEFAULT 'push',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `konsultasi` */

insert  into `konsultasi`(`id`,`title`,`content`,`Jawaban`,`author`,`email`,`timestamp`,`tampilkan`,`id_dokter`,`read`,`Notification`) values (1,'ASDASD','Dokter yth. Ibu saya (77 Tahun) baru saja dirawat karena detak jantungnya lemah dan tdk beraturan, dokter menyarankan di ablasi, yg ingin saya tanyakan : 1. Apakah Ablasi itu? 2. Apakah efek yg dapat ditimbulkan?? 3. Amankan untuk ibu saya yg usianya sdh 77 tahun?? 4. Ada cara pengobatan lain? - See more at: http://kardioipdrscm.com/6305/konsultasi-kesehatan-jantung/efek-samping-ablasi-jantung-untuk-detak-jantung-lemah-dan-tidak-beraturan/#sthash.1UxcktKb.dpuf','Entah lah','ASDASD','ASDASD','2014-07-09 03:33:13',1,0,'true','hide'),(13,'Pengaruh Kejang Pada Kesehatan Bayi','Mau tanya anak saya umur 10 bulan, sekitar 2 minggu yang lalu anak saya mengalami kejang akibat panas dari jam 1 siang s/d 11 malam tanpa penangan medis. Saat ini kondisinya normal, tapi saya tetap cemas mengenai pengaruh kejang pada kesehatannya. Bagaimana cara mengetahuinya dok, perlukah saya bawa ke dokter?','ejeje','Rohisnawati','rohisnawati@gmail.com','2014-07-09 03:33:29',1,0,'true','hide'),(14,'Meluapkan Emosi dengan Memukuli Diri Sendiri','Dok, Saya nggak tahu apa yang terjadi pada diri saya. Setiap kali ada seseorang yang mengeluarkan kata-kata Keras seperti teriakan atau bentakan saya ngerasa langsung emosi mendengarnya dan balik menyerang mereka dengan Kata kata emosi yang tiba tiba keluar.\r\n \r\nKalau seseorang itu tidak terima saya membentaknya kembali, saya lebih sering langsung pergi menyediri karena tidak ingin mendengar suara suara bentakan yang lain dan disaat pergi menyendiri itu disana saya menyadari hal yang aneh terjdi pada diri saya.\r\n \r\nSaya meluapkan emosi tadi dengan memukuli diri saya sendiri dan mengambil barang apapun yang ada untuk alat memukul diri saya sendiri. Tapi anehnya dok, saat saya memukuli diri saya tidak merasakan sakit namun seminggu kemudiannya tubuh saya penuh dengan luka memar kebiruan .\r\n \r\nSampai sekarang saya menulis hal ini, menyakiti diri sendiri masih saya lakukan. Apa yang harus saya lakukan untuk dapat meredam emosi berlebihan pada diri saya yang mengakibatkan tindakan buruk yg saya lakukan pada diri saya ini. Saya tidak dapat mengontrol emosi saat seseorang berbicara keras dan kasar kepada saya. saya akan terpancng emosinya saat itu juga dok.\r\n \r\nDok jujur saya takut tidak dapat mengontrol batas emosi saya saat memukuli badan saya sendiri. Terima kasih dok.','asdasd','Siti Ruhmana','ruhmanas@yahoo.com','2014-07-09 03:33:44',1,0,'true','hide'),(15,'Sendawa Bisa Jadi Pertanda Kanker?','Dok, saya sering sekali bersendawa. Meski lapar, kenyang, atau dalam keadaan biasa saja sering bersendawa. Apakah ini berbahaya? Saya pernah melihat informasi di dr. Oz trans tv yang membahas tentang seringnya bersendawa. Dalam tayangan tersebut disebutkan jika sering bersendawa itu bisa jadi pertanda terkena kanker atau tumor. Mohon penjelasannya. Terimakasih.',NULL,'Aninda Dwi Rahayu','AnindaRahayu@yahoo.com','2014-07-09 04:16:28',0,0,'true','bar'),(16,'Kempret','ahud',NULL,'Frans Filasta Pratama','ffilasta@gmail.com','2014-07-09 03:30:54',0,0,'true','bar'),(17,'asdasd','asdasdsadasd',NULL,'Test','tekno@live.com','2014-07-09 04:57:51',0,0,'true','bar'),(18,'asdasd','asdasdsadasffffd',NULL,'Testffff','tekno@live.com','2014-07-09 04:57:48',0,0,'true','bar'),(19,'asdasdddddd','asdasdsadasffffdddd',NULL,'Testffffasss','tekno@live.com','2014-07-09 04:57:45',0,0,'true','bar'),(20,'Kenapa saya kurapan dok?','Kenapa saya kurapan dok?',NULL,'Rahma Fitri Binti Syariful Ahdarudin','rahmafitri92@gmail.com','2014-07-10 09:52:37',0,0,'true','bar'),(21,'Kenapa saya kurapan dok?','Kenapa saya kurapan dok?',NULL,'Rahma Fitri Binti Syariful Ahdarudin','rahmafitri92@gmail.com','2014-07-10 09:53:34',0,0,'true','bar');

/*Table structure for table `kritik_saran` */

DROP TABLE IF EXISTS `kritik_saran`;

CREATE TABLE `kritik_saran` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `perihal` varchar(225) DEFAULT NULL,
  `isi` text,
  `type` enum('kritik','saran') DEFAULT NULL,
  `via` enum('web','sms') DEFAULT 'web',
  `time` date DEFAULT NULL,
  `read` enum('true','false') DEFAULT 'false',
  `Notification` enum('push','notified','bar') DEFAULT 'push',
  PRIMARY KEY (`id_feedback`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kritik_saran` */

insert  into `kritik_saran`(`id_feedback`,`email`,`perihal`,`isi`,`type`,`via`,`time`,`read`,`Notification`) values (1,'asd','asd','asdasd','kritik','web','2014-06-13','false',''),(2,'asd','ssss','asdasd','saran','web','2014-06-13','false',''),(3,'ffilasta4@gmail.com','theumber1','asdasd','kritik','web','2014-06-19','false',''),(4,'rahmafitri92@gmail.com','Website Rumah Sakit','Menurut saya, website','saran','web','2014-06-29','false',''),(5,'ffilasta@gmail.com','Kenapa anda begitu?','nggak tahu','kritik','web','2014-07-08','false','');

/*Table structure for table `kunjungan_poli` */

DROP TABLE IF EXISTS `kunjungan_poli`;

CREATE TABLE `kunjungan_poli` (
  `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasien` varchar(11) DEFAULT NULL,
  `id_poli` varchar(11) DEFAULT NULL,
  `tanggal_kunjungan` date DEFAULT NULL,
  `confirmation` varchar(10) DEFAULT NULL,
  `no_urut` int(3) DEFAULT NULL,
  `isConfirmed` tinyint(1) DEFAULT '0',
  `isDone` tinyint(1) DEFAULT '0',
  `notified` enum('true','false') DEFAULT 'false',
  `read` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id_kunjungan`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `kunjungan_poli` */

insert  into `kunjungan_poli`(`id_kunjungan`,`id_pasien`,`id_poli`,`tanggal_kunjungan`,`confirmation`,`no_urut`,`isConfirmed`,`isDone`,`notified`,`read`) values (1,'PAS00001','POLI001','2014-05-30','asdasd',1,1,0,'false','true'),(2,'PAS00002','POLI001','2014-05-30','mnmn',2,1,0,'false','true'),(3,'PAS00001','POLI001','2017-08-04','67357',1,1,0,'false','true'),(17,'PAS00001','POLI002','2014-06-09','35346',1,1,0,'false','true'),(18,'PAS00001','POLI001','2014-06-10','27427',1,1,1,'false','true'),(19,'PAS00002','POLI002','2014-06-10','49792',2,1,1,'false','true'),(21,'PAS00002','POLI001','2014-06-18','54321',1,1,1,'false','true'),(26,'PAS00003','POLI002','2014-06-18','5907',1,1,1,'false','true'),(27,'PAS00003','POLI002','2014-06-19','2496',1,1,1,'false','true'),(28,'PAS00002','POLI002','2014-06-19','7787',2,1,1,'false','true'),(29,'PAS00003','POLI001','2014-06-20','22780',1,1,1,'false','true'),(32,'PAS00002','POLI001','2014-06-20','26498',2,1,1,'false','true'),(33,'PAS00004','POLI001','2014-06-20','48057',3,1,1,'false','true'),(34,'PAS00003','POLI005','2014-06-24','32901',1,1,1,'false','true'),(35,'PAS00003','POLI005','2014-06-29','23994',1,1,1,'false','true'),(36,'PAS00004','POLI001','2014-06-29','63794',1,1,1,'false','true'),(37,'PAS00003','POLI005','2014-06-30','25607',1,0,0,'false','true'),(38,'PAS00005','POLI002','2014-07-07','35346',1,1,1,'false','true'),(39,'PAS00004','POLI002','2014-07-08','08987',1,1,1,'false','true'),(40,'PAS00005','POLI003','2014-07-09','8619',1,1,1,'false','false'),(41,'PAS00003','POLI001','2014-07-09','6664',1,0,0,'false','false'),(42,'PAS00003','POLI006','2014-09-18','77740',1,0,0,'false','false');

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `module_id` int(3) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) DEFAULT NULL,
  `module_controller` varchar(150) NOT NULL,
  `module_mode` tinyint(1) DEFAULT '0',
  `access` enum('superuser','admin','dokter') NOT NULL DEFAULT 'superuser',
  `group` int(3) DEFAULT NULL,
  PRIMARY KEY (`module_id`),
  KEY `group` (`group`),
  CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`group`) REFERENCES `modules` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `modules` */

insert  into `modules`(`module_id`,`module_name`,`module_controller`,`module_mode`,`access`,`group`) values (13,'Web Portal','',1,'admin',NULL),(14,'Master Data','',1,'admin',NULL),(16,'SMS Gateaway','',1,'admin',NULL),(17,'Control Panel','',1,'superuser',NULL),(21,'e-Konsultasi','ekonsultasi',1,'dokter',NULL),(22,'Layanan','',1,'dokter',NULL),(23,'Kunjungan Poli','kunjungan_poli',1,'admin',NULL),(24,'Promosi','promosi',1,'admin',NULL),(25,'Jadwal Dokter','jadwal_dokter',1,'admin',NULL),(26,'Kirtik & Saran','feedback',1,'admin',NULL),(27,'Data Pasien','pasiens',1,'admin',NULL),(28,'Poliklinik','polikliniks',1,'admin',NULL),(29,'Dokter','dokters',1,'admin',NULL),(30,'Kirim SMS','',1,'admin',NULL),(31,'Kotak Masuk','',1,'admin',NULL),(32,'Pesan Terkirim','',1,'admin',NULL),(33,'Posting','',1,'admin',NULL),(34,'Halaman','',1,'admin',NULL),(35,'Kategori Posting','',1,'admin',NULL),(36,'Menu','',1,'admin',NULL),(37,'Laporan','report',1,'superuser',NULL);

/*Table structure for table `outbox` */

DROP TABLE IF EXISTS `outbox`;

CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `outbox` */

insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`SendBefore`,`SendAfter`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2014-09-18 09:58:38','2014-09-18 09:58:38','2014-09-18 09:58:38','23:59:59','00:00:00',NULL,'08981169578','Default_No_Compression',NULL,-1,'No. Urut Anda : 1\nKode Konfirmasi : 77740',17,'false',-1,NULL,'2014-09-18 09:58:38','default','CRM');

/*Table structure for table `outbox_multipart` */

DROP TABLE IF EXISTS `outbox_multipart`;

CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `outbox_multipart` */

/*Table structure for table `pasien` */

DROP TABLE IF EXISTS `pasien`;

CREATE TABLE `pasien` (
  `id_pasien` varchar(11) NOT NULL,
  `no_ktp` varchar(100) DEFAULT NULL,
  `nama_pasien` varchar(225) DEFAULT NULL,
  `jenis_kelamin` enum('P','L') DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(225) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `agama` enum('islam','protestan','katholik','hindu','budha') DEFAULT 'islam',
  `tanggal_daftar` date DEFAULT NULL,
  PRIMARY KEY (`id_pasien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pasien` */

insert  into `pasien`(`id_pasien`,`no_ktp`,`nama_pasien`,`jenis_kelamin`,`no_telp`,`alamat`,`tanggal_lahir`,`tempat_lahir`,`username`,`password`,`email`,`agama`,`tanggal_daftar`) values ('PAS00003','09101003026','Rahma Fitri','P','08981169578','Palembang','1992-11-19','Palembang','rahmafitri','thenumber1',NULL,NULL,'2014-06-23'),('PAS00004','09101003044','Tias Tahrirulwathan','L','085764520052','Indralaya','1992-11-20','Prabumulih','ttwathan','thenumber1',NULL,NULL,'2014-06-23'),('PAS00005','0909002014','Nisa Isnaini','P','08980838494','Prabumulih','1995-05-16','Paembang','ichanisa','mn',NULL,'islam','2014-06-23'),('PAS00006','09101003004','Frans Filasta Pratama','L','08974420763','Prabumulih','1993-01-07','Sungai Liat','ffilasta','thenumber1',NULL,'islam','2014-06-23');

/*Table structure for table `pbk` */

DROP TABLE IF EXISTS `pbk`;

CREATE TABLE `pbk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `pbk` */

insert  into `pbk`(`ID`,`GroupID`,`Name`,`Number`) values (1,1,'Rahma Fitri','08981169578'),(2,1,'Tias Tahrirulwathan','085764520052'),(3,2,'Mayor Ckm dr. Fenti Alvian Amu, Sp.P','0891231231'),(6,1,'Nisa Isnaini','08980838494'),(7,1,'Frans Filasta Pratama','08974420763'),(8,1,'pasien','0898219391823'),(9,1,'asdasdxmxmxmx','asd'),(10,2,'dr. Adhi Tantowi, Sp.PD','081273840681'),(11,2,'dr. Iwan Destiawan, Sp.BS, M.Kes','08192260546'),(12,2,'dr. Dedy Firmansyah, Sp.OT','085377450922'),(13,2,'dr. Heru Purwanto, Sp.B','0883785334'),(14,2,'Mayor Ckm dr. Syamsu Rijal, Sp.A','08873456221'),(15,2,'dr. Prakanita Basyir, Sp.A','08134423576'),(16,2,'dr. Vivi Septriyani, Sp.A','081323876675'),(17,2,'dr. Vivi Septriyani, Sp.A','081323876675'),(18,2,' dr. yang Tjik, Sp.A','091323884321'),(19,2,'dr. Darwin Ansyori, Sp.A (K)','0812223448898'),(20,2,'Letnan Kolonel Ckm dr. IGP Yuliartha, Sp.KK','081426785532'),(21,2,' Mayor Ckm dr. Nirwan Arief, Sp.M','087866324563'),(22,2,' Letkol Ckm dr. Dzulfadhli Daulay, Sp.OG','08563246789'),(23,2,'dr. Aryani Azis, Sp.OG','08238343278'),(24,2,'dr. Aryani Azis, Sp.OG','08238343278'),(25,2,'dr. Kms. Anhar, Sp.OG','085687732412'),(26,2,'Kolonel Ckm dr. Toni Siguntang, Sp.THT, Mars','08156782345'),(27,2,'. Letkol Ckm dr. Bima Wisnu Nugraha, Sp.THT, M.Kes','08132633821'),(28,2,'Letkol Ckm dr. Bima Wisnu Nugraha, Sp.THT, M.Kes','08215638625'),(29,2,'Kolonel Ckm drg. Nirwan Husni Lubis, Sp.BM, Mars','081267396579'),(30,2,'Letnan Kolonel Ckm drg. Djamal Riza, Sp.BM','081567829328');

/*Table structure for table `pbk_groups` */

DROP TABLE IF EXISTS `pbk_groups`;

CREATE TABLE `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pbk_groups` */

insert  into `pbk_groups`(`Name`,`ID`) values ('Pasien',1),('Dokter',2);

/*Table structure for table `phones` */

DROP TABLE IF EXISTS `phones`;

CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `phones` */

insert  into `phones`(`ID`,`UpdatedInDB`,`InsertIntoDB`,`TimeOut`,`Send`,`Receive`,`IMEI`,`Client`,`Battery`,`Signal`,`Sent`,`Received`) values ('','2014-07-11 06:47:48','2014-07-10 22:39:25','2014-07-11 06:47:58','yes','yes','359755022475244','Gammu 1.33.0, Windows Server 2007, GCC 4.7, MinGW 3.11',0,57,9,5);

/*Table structure for table `poliklinik` */

DROP TABLE IF EXISTS `poliklinik`;

CREATE TABLE `poliklinik` (
  `id_poliklinik` varchar(11) NOT NULL,
  `nama_poliklinik` varchar(225) DEFAULT NULL,
  `deskripsi` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_poliklinik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `poliklinik` */

insert  into `poliklinik`(`id_poliklinik`,`nama_poliklinik`,`deskripsi`) values ('POLI001','Poliklinik Syaraf',NULL),('POLI002','Poliklinik Kulit dan Kelamin',NULL),('POLI003','Poliklinik Penyakit Dalam dan Jantung',NULL),('POLI004','Poliklinik Anak',NULL),('POLI005','Poliklinik Mata',NULL),('POLI006','Poliklinik Bedah',NULL),('POLI007','Poliklinik THT',NULL),('POLI008','Poliklinik Gigi',NULL);

/*Table structure for table `portal_menu` */

DROP TABLE IF EXISTS `portal_menu`;

CREATE TABLE `portal_menu` (
  `menu_id` int(4) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(100) DEFAULT NULL,
  `menu_content` varchar(100) DEFAULT NULL,
  `menu_parent` int(4) DEFAULT NULL,
  `menu_status` tinyint(1) DEFAULT '1',
  `menu_type` enum('halaman','post','kategori','link','modul') DEFAULT NULL,
  `menu_order` int(2) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_order` (`menu_order`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `portal_menu` */

insert  into `portal_menu`(`menu_id`,`menu_title`,`menu_content`,`menu_parent`,`menu_status`,`menu_type`,`menu_order`) values (34,'Registrasi Ulang','http://localhost/crm/site/visit_poliklinik',37,1,'modul',5),(25,'Home','http://localhost/crm',0,1,'link',1),(33,'E-Konsultasi','http://localhost/crm/site/ekonsultasi',37,1,'modul',4),(35,'Jadwal Dokter','http://localhost/crm/site/jadwal_dokter',37,1,'modul',6),(38,'Promo','http://localhost/crm/site/promosi',37,1,'modul',7),(37,'Services','#',0,1,'link',3),(39,'Kritik & Saran','http://localhost/crm/site/feedback',37,1,'modul',9),(44,'Blog','http://localhost/crm/blog',0,1,'modul',2),(48,'Sejarah','http://localhost/crm/page/7',43,1,'halaman',12),(43,'About Us','http://localhost/crm/page/6',0,1,'halaman',10),(47,'Visi Misi','http://localhost/crm/page/5',43,1,'halaman',11),(49,'Sarana Prasarana','http://localhost/crm/page/8',43,1,'halaman',13),(50,'Penghargaan dan Sertifikat','http://localhost/crm/page/9',43,1,'halaman',14),(51,'Artikel','http://localhost/crm/category/5',0,1,'kategori',8);

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `blog_id` int(6) NOT NULL AUTO_INCREMENT,
  `category` int(4) NOT NULL DEFAULT '0',
  `blog_title` varchar(200) NOT NULL,
  `blog_content` text NOT NULL,
  `blog_author` varchar(100) NOT NULL,
  `blog_date` date NOT NULL,
  `blog_status` enum('langsung publish','simpan sebagai konsep') NOT NULL DEFAULT 'langsung publish',
  `blog_feature_image` text,
  `blog_type` enum('post','page') NOT NULL DEFAULT 'post',
  `blog_url` varchar(100) DEFAULT NULL,
  `blog_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`blog_id`),
  UNIQUE KEY `blog_title` (`blog_title`),
  KEY `category` (`category`),
  KEY `blog_author` (`blog_author`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `posts` */

insert  into `posts`(`blog_id`,`category`,`blog_title`,`blog_content`,`blog_author`,`blog_date`,`blog_status`,`blog_feature_image`,`blog_type`,`blog_url`,`blog_timestamp`) values (28,5,'Manfaat Minum Kopi Sebelum Olahraga','<p> </p>\r\n<p><img src=\"/crm/upload/images/1400202-minum-teh-atau-kopi-780x390.jpg\" alt=\"\" /></p>\r\n<p style=\"text-align: justify;\">Bagi sebagian orang, memulai hari tidaklah lengkap bila belum menyeruput secangkir kopi. Mereka percaya, kopi bisa membuat hari mereka lebih bersemangat dan mengurangi rasa lelah. Ternyata manfaat kopi juga bisa dirasakan jika diminum sebelum olahraga.</p>\r\n<p style=\"text-align: justify;\">Sebuah penelitian yang dipublikasikan dalam International<em> Journal of Sport Nutrition and Exercise</em> <em>Metabolism</em> mengungkapkan, minum kopi sebelum berolahraga akan mengoptimalkan pembakaran lemak. Studi menemukan, atlet yang mengonsumsi kafein sebelum olahraga membakar 15 persen kalori lebih banyak hingga tiga jam setelah olahraga. Ini dibandingkan dengan mereka yang hanya diberi plasebo.</p>\r\n<p style=\"text-align: justify;\">Peneliti mengatakan, dosis yang dibutuhkan untuk menghasilkan dampak tersebut adalah 4,5 miligram kafein per kilogram berat badan. Sehingga bagi wanita dengan berat badan 68 kilogram, kira-kira membutuhkan 300 mg kafein atau sekitar 355 mililiter kopi seduh.</p>\r\n<p style=\"text-align: justify;\">Selain membantu tubuh untuk membakar lemak lebih banyak, kopi juga diketahui dapat memberikan beberapa keuntungan lainnya. Berikut di antaranya.</p>\r\n<p style=\"text-align: justify;\"><strong>1. Memperbaiki sirkulasi</strong><br />Baru-baru ini, penelitian asal Jepang mempelajari efek kopi pada sistem sirkulasi pada orang yang tidak terbiasa minum kopi. Setiap peserta diminta minum 148 ml kopi baik yang biasa maupun yang ditambah kafein. Kemudian peneliti menghitung aliran darah pada tubuh masing-masing peserta. Ternyata peserta yang minum kopi yang diperkaya kafein memiliki aliran darah lebih cepat 30 persen selama 75 menit dibandingkan peserta lainnya.</p>\r\n<p style=\"text-align: justify;\"><strong>2. Lebih sedikit nyeri</strong><br />Peneliti dari University of Illinois menemukan, mengonsumsi kafein yang sama dengan dua hingga tiga kali cangkir kopi satu jam sebelum berolahraga akan mengurangi nyeri otot pascaolahraga intensitas tinggi. Kafein bekerja untuk mendorong otot lebih kuat selama berolahraga sehingga kekuatan dan ketahanan otot pun menjadi lebih baik.</p>\r\n<p style=\"text-align: justify;\"><strong>3. Ingatan lebih baik</strong><br />Studi yang dipublikasi dalam Johns Hopkins University menemukan, kafein mampu meningkatkan ingatan hingga 24 jam setelah dikonsumsi. Dalam olahraga, ingatan yang baik juga diperlukan untuk mengingat gerakan tertentu.</p>\r\n<p style=\"text-align: justify;\"><strong>4. Menjaga otot awet muda</strong><br />Peneliti asal Coventry University menemukan kekuatan otot menurun karena penuaan. Namun ternyata dalam moderasi, konsumsi kafein dapat membantu mengurangi cedera otot karena penuaan saat berolahraga.</p>\r\n<p style=\"text-align: justify;\"><strong>5. Otot lebih bertenaga</strong><br />Studi baru dalam<em> Journal of Applied Physiology</em> menemukan, sedikit kafein sesudah olahraga juga dapat bermanfaatkan, khususnya untuk menjaga daya tahan orang yang berlatih setiap hari, seperti atlet.</p>','admin','2014-06-29','langsung publish',NULL,'post',NULL,'2014-06-29 21:22:40'),(26,1,'Launching Website Rumah Sakit dr. AK Gani','<p>Selamat dan sukses atas dilaunchingnya website resmi Rumah Sakit dr. AK Gani. Semoga website ini dpat memberikan manfaat bagi pihak rumah sakit dan masyarakat umum.</p>\r\n<p> </p>','admin','2014-06-26','langsung publish',NULL,'post',NULL,'2014-06-26 10:30:50'),(22,3,'DONOR DARAH DAN ANJANGSANA DALAM RANGKA HUT ke 68 PERSIT KARTIKA CHANDRA KIRANA','<p>Untuk memperingati HUT ke-68 Persit Kartika Chandra, banyak susunan acara yang disusun untuk memeriahkannya, salah satunya adalah Aksi Donor Darah. Tidak hanya pegawai rumah sakit saja yang ikut acara ini, namun juga kami mengundang masyarakat umum untuk ikut serta mengikuti acara donor darah ini.</p>\r\n<p>Adapun acaranya diselenggarakan pada tanggal  30 Juli 2014 di Rumah Sakit dr. AK Gani. Untuk informasi pendaftaran donor darah, bisa menghubungi (0811) 4530404.</p>','admin','2014-06-24','langsung publish','a6ba0-snsd.jpg','post',NULL,'2014-06-02 10:17:02'),(27,1,'Kunjungan Dirkes Ditjen Kuathan','<p>RS dr. AK Gani mendapat kehormatan kunjungan dari Direktur Kesehatan Ditjen Kuathan Kemenhan RI Brigadir Jenderal TNI dr. Robert Hutauruk, Sp.OT. Dirkes menyempatkan mengunjungi rumah sakit di sela-sela kesibukan beliau mengadakan penandatanganan MoU antara Kementerian Pertahanan dengan Fakultas Kedokteran Universitas Sriwijaya dalam hal Pendidikan Perwira Tugas Belajar (Patubel) khususnya pendidikan kedokteran para perwira di FK Unsri.</p>\r\n<p>Dalam kunjungan tersebut Dirkes Ditjen Kuathan didampingi oleh Ka RS dr. AK Gani Kolonel CKM drg. Nirwan Husni Lubis Sp.BM, Mars dan seluruh perwira RS dr. AK Gani.</p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_554.JPG\" alt=\"\" width=\"400\" height=\"302\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5467.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img title=\"Meninjau Rumah Sakit\" src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5472.JPG\" alt=\"\" width=\"400\" height=\"600\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5489.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5508.JPG\" alt=\"\" width=\"400\" height=\"283\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5515.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5523.JPG\" alt=\"\" width=\"400\" height=\"304\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5537.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5538.JPG\" alt=\"\" width=\"400\" height=\"302\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5539.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5544.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5549.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p> <img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5550.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5553.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>\r\n<p><img src=\"http://www.rsdrakgani.com/UserFiles/Image/DIRKESKUATHAN/IMG_5556.JPG\" alt=\"\" width=\"400\" height=\"267\" /></p>','admin','2014-06-26','langsung publish',NULL,'post',NULL,'2014-06-26 10:32:43'),(29,5,'Agar Obat Lebih Cepat Sembuhkan Penyakit','<div class=\"isi_berita2011 pt_5 arial font14 lh18\">\r\n<div class=\"isi_berita pt_5\"> </div>\r\n<div class=\"isi_berita pt_5\"><img src=\"/crm/upload/images/0607410shutterstock-10213672780x390.jpg\" alt=\"\" /></div>\r\n<div class=\"isi_berita pt_5\"> </div>\r\n<div class=\"isi_berita pt_5\">Dari sekian ragam pilihan metode dan bentuk pengobatan yang beredar, tak jarang masyarakat memilih pengobatan termurah, demi segera meraih kesehatan seperti sedia kala.<br /><br />Namun menurut Drs. Nurul Falah Eddy Pariang, Apt, Ketua Ikatan Apoteker Indonesia (IAI) menegaskan, korelasi antara harga dan keampuhan obat tak bisa disamaratakan.<br /><br />“Tak bisa disebut bahwa obat A itu lebih mahal, berarti lebih ampuh. Karena itu memerlukan evidence based tergantung kasusnya,” ujarnya.<br /><br />Di sisi lain, efisiensi biaya pengobatan juga tak melulu dengan cara memilih obat murah. Intinya, efisiensi pengobatan tak selalu masalah kuantitas, melainkan juga kualitas. Apa saja yang dapat dilakukan agar obat lebih mempercepat penyembuhan ? Berikut saran Nurul Falah.<br /><br /><strong>1. Tahu Obat yang Cocok</strong><br />Pasien harus mengetahui obat yang cocok untuknya  dengan cara menandai senyawa aktif dalam obat, dan bagaimana pengaruhnya untuk tubuh.<br /><br />Pasalnya, obat seperti parasetamol saja diproduksi oleh banyak produsen, dan bisa saja ada satu produsen yang paling cocok untuk pasien . Produsen ini, bisa juga berhubungan dengan harga jual obat tersebut. Sehingga jika pasien mengetahui obat yang sesuai untuknya , maka pengobatan bisa lebih efektif karena obat yang tepat pun mempercepat atau memaksimalkan kesembuhan .<br /><br /><strong>2.  Patuh Konsumsi Obat</strong><br />Saat dikonsumsi, obat akan memberikan reaksi darah pada reseptor. Sehingga saat konsumsi obat tidak disiplin , maka kondisi darah pun tak seperti yang seharusnya. Lebih lanjut, obat itu bisa dikatakan tak manjur karena tak berpengaruh terhadap kesembuhan pasien.<br /><br />Oleh karena itu, Nurul Falah menegaskan, berhemat saat pengobatan tak hanya dengan cara memilih obat berdasarkan harga semata. “Jika kita memilih obat yang ampuh dan mahal, tapi justru tak dikonsumsi dengan disiplin , maka percuma. Keampuhannya tak bermanfaat secara maksimal bagi tubuh.”<br /><br /><strong>3.  Rekaman Pengobatan</strong><br />Biasakan membuat <em>medical record</em> untuk mencatat obat apa saja yang dikonsumsi  dan bagaimana pengaruhnya pada tubuh. Lebih lanjut, catatan ini akan sangat berguna bagi pemberian obat di kemudian hari. Pemberian obat yang salah atau tak cocok akan memperpanjang waktu pengobatan sekaligus menambah biaya penyembuhan.</div>\r\n</div>\r\n<div class=\"clearit pb_30\"> </div>\r\n<div class=\"left w650\">\r\n<div class=\"left pr_5 pt_5 font11 c_abu\"><strong>Sumber :</strong></div>\r\n<div class=\"left pt_5 c_abu01_kompas2011 font12\"><a href=\"http://www.tabloidnova.com/\" target=\"_blank\">www.tabloidnova.com</a></div>\r\n<p> </p>\r\n</div>','admin','2014-06-29','langsung publish',NULL,'post',NULL,'2014-06-29 21:29:24'),(30,1,'Peresmian Pemakaian Ruangan Paviliun Mawar Baru','<p> </p>\r\n<p>Selasa, 3 September 2013. Karumkit TK II dr.AK Gani dr.Made Wirayasa Tusan,MM.MH.Kes,Melakukan Peresmian Pemakaian Ruangan Paviliun Mawar Baru Yang ditandai dengan Pemotongan Nasi Tumpeng. Ruangan Mawar Ini dilengkapi dengan Fasilitas Vip Classroom Standard Rumah sakit.</p>\r\n<p><span><strong> </strong></span></p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P5.jpg\" alt=\"\" /></p>\r\n<p><span><strong>dr.Made Wirayasa Tusan,MM.MH.Kes</strong></span><strong> Sedang Memberikan Kata Sambutan</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P4.jpg\" alt=\"\" width=\"350\" height=\"300\" /></p>\r\n<p><strong>  Para perwira dan Undangan Sedang Menyimak KarumkitTK II dr.AK Gani yang Sedang Memberikan Kata Sambutan</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P0.jpg\" alt=\"\" /></p>\r\n<p><strong>Nasi Tumpeng Sebagai Tanda Peresmian</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P6.jpg\" alt=\"\" /></p>\r\n<p> <span><strong>dr.Made Wirayasa Tusan,MM.MH.Kes</strong></span> <strong>Memotong Nasi Tumpeng Sebagai Tanda Peresmian Pengunaan Ruangan Paviliun Mawar</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P7.jpg\" alt=\"\" /></p>\r\n<p> <strong>Karumkit TK II dr.AK.gani Memberikan Nasi Tumpeng kepada WaKaru Paviliun</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p> <img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P9.jpg\" alt=\"\" width=\"350\" height=\"300\" /></p>\r\n<p> <strong><span>dr.Hadi Hariono</span> selaku Wakarumkit TK II dr.AK Gani Beserta Perwira dalam Peresmian Tersebut</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P11.jpg\" alt=\"\" width=\"350\" height=\"300\" /></p>\r\n<p> <strong>Paurdal dan Para PNS Rumkit beserta Undangan dalam Acara Peresmian</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P1.jpg\" alt=\"\" width=\"350\" height=\"300\" /></p>\r\n<p> <strong>Suasana Ruangan Paviliun Mawar yang Baru Diresmikan</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P2.jpg\" alt=\"\" /></p>\r\n<p><strong> Suasana Ruangan Paviliun Mawar yang Baru Diresmikan</strong></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><img src=\"http://rsdrakgani.com/UserFiles/Image/Paviliun/P3.jpg\" alt=\"\" width=\"350\" height=\"300\" /></p>\r\n<p><strong> Suasana Ruangan Paviliun Mawar yang Baru Diresmikan</strong></p>\r\n<p> </p>','admin','2014-06-29','langsung publish',NULL,'post',NULL,'2014-06-29 21:33:27');

/*Table structure for table `promosi` */

DROP TABLE IF EXISTS `promosi`;

CREATE TABLE `promosi` (
  `id_promosi` int(11) NOT NULL AUTO_INCREMENT,
  `sms_promosi` text,
  `tgl_promosi` date DEFAULT NULL,
  `judul_promosi` varchar(150) DEFAULT NULL,
  `web_promosi` varchar(160) DEFAULT NULL,
  `tampil` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_promosi`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `promosi` */

insert  into `promosi`(`id_promosi`,`sms_promosi`,`tgl_promosi`,`judul_promosi`,`web_promosi`,`tampil`) values (9,'Selamat Sore, ini adalah pesan promosi yang dikirim menggunakan SMSGateway. Pemilihan target promosi dilakukan dengan memperhatikan beberapa kriteria seperti umur,gender, dan juga berdasarkan kunjungan pada poliklinik. \r\n\r\nTerima kasih, ','2014-06-04','Promosi SMS','Selamat Sore, ini adalah pesan promosi yang dikirim menggunakan SMSGateway. Pemilihan target promosi dilakukan dengan memperhatikan beberapa kriteria seperti um',1),(11,'Dalam rangka hari anak, RS Dr AK Gani memberikan vaksin polio gratis pada hari minggu 13 Juli 2014. Acara juga akan dimeriahkan dengan games menarik untuk anda dan buah hati. Peserta dibatasi sebanyak 100 orang. Daftarkan diri anda dgn format namaibu#namaanak#umur#alamat#tlp','2014-06-29','Vaksin Polio','Dalam rangka hari anak, Rumah Sakit Dr. AK Gani&nbsp;memberikan vaksin polio secara gratis pada hari minggu 13 Juli 2014. <br>Acara juga akan dimeriahkan dengan',1);

/*Table structure for table `sentitems` */

DROP TABLE IF EXISTS `sentitems`;

CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL,
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `sentitems` */

insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2014-07-10 22:42:28','2014-07-10 22:42:28','2014-07-10 22:42:28',NULL,'00740065007300740069','+628974420763','Default_No_Compression','','+6289644000001',-1,'testi',8,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 22:46:30','2014-07-10 22:46:30','2014-07-10 22:46:30',NULL,'0074006500730074','+628974420763','Default_No_Compression','','+6289644000001',-1,'test',9,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 22:48:33','2014-07-10 22:48:33','2014-07-10 22:48:33',NULL,'00790061006E0067003F','+628974420763','Default_No_Compression','','+6289644000001',-1,'yang?',10,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 22:49:36','2014-07-10 22:49:36','2014-07-10 22:49:36',NULL,'00690079006F002000610070006F003F','+628974420763','Default_No_Compression','','+6289644000001',-1,'iyo apo?',11,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 22:53:08','2014-07-10 22:53:08','2014-07-10 22:53:08',NULL,'00530065006C0061006D0061007400200053006F00720065002C00200069006E00690020006100640061006C0061006800200070006500730061006E002000700072006F006D006F00730069002000790061006E0067002000640069006B006900720069006D0020006D0065006E006700670075006E0061006B0061006E00200053004D00530047006100740065007700610079002E002000500065006D0069006C006900680061006E0020007400610072006700650074002000700072006F006D006F00730069002000640069006C0061006B0075006B0061006E002000640065006E00670061006E0020006D0065006D0070006500720068006100740069006B0061006E0020006200650062006500720061007000610020006B00720069007400650072006900610020007300650070','08981169578','Default_No_Compression','050003A70201','+6289644000001',-1,'Selamat Sore, ini adalah pesan promosi yang dikirim menggunakan SMSGateway. Pemilihan target promosi dilakukan dengan memperhatikan beberapa kriteria sep',12,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 22:53:40','2014-07-10 22:53:40','2014-07-10 22:53:40',NULL,'00530065006C0061006D0061007400200053006F00720065002C00200069006E00690020006100640061006C0061006800200070006500730061006E002000700072006F006D006F00730069002000790061006E0067002000640069006B006900720069006D0020006D0065006E006700670075006E0061006B0061006E00200053004D00530047006100740065007700610079002E002000500065006D0069006C006900680061006E0020007400610072006700650074002000700072006F006D006F00730069002000640069006C0061006B0075006B0061006E002000640065006E00670061006E0020006D0065006D0070006500720068006100740069006B0061006E0020006200650062006500720061007000610020006B00720069007400650072006900610020007300650070','08974420763','Default_No_Compression','050003A70201','+6289644000001',-1,'Selamat Sore, ini adalah pesan promosi yang dikirim menggunakan SMSGateway. Pemilihan target promosi dilakukan dengan memperhatikan beberapa kriteria sep',13,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 22:54:12','2014-07-10 22:54:12','2014-07-10 22:54:12',NULL,'00530065006C0061006D0061007400200053006F00720065002C00200069006E00690020006100640061006C0061006800200070006500730061006E002000700072006F006D006F00730069002000790061006E0067002000640069006B006900720069006D0020006D0065006E006700670075006E0061006B0061006E00200053004D00530047006100740065007700610079002E002000500065006D0069006C006900680061006E0020007400610072006700650074002000700072006F006D006F00730069002000640069006C0061006B0075006B0061006E002000640065006E00670061006E0020006D0065006D0070006500720068006100740069006B0061006E0020006200650062006500720061007000610020006B00720069007400650072006900610020007300650070','085764520052','Default_No_Compression','050003A70201','+6289644000001',-1,'Selamat Sore, ini adalah pesan promosi yang dikirim menggunakan SMSGateway. Pemilihan target promosi dilakukan dengan memperhatikan beberapa kriteria sep',14,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 22:54:44','2014-07-10 22:54:44','2014-07-10 22:54:44',NULL,'00530065006C0061006D0061007400200053006F00720065002C00200069006E00690020006100640061006C0061006800200070006500730061006E002000700072006F006D006F00730069002000790061006E0067002000640069006B006900720069006D0020006D0065006E006700670075006E0061006B0061006E00200053004D00530047006100740065007700610079002E002000500065006D0069006C006900680061006E0020007400610072006700650074002000700072006F006D006F00730069002000640069006C0061006B0075006B0061006E002000640065006E00670061006E0020006D0065006D0070006500720068006100740069006B0061006E0020006200650062006500720061007000610020006B00720069007400650072006900610020007300650070','08974420763','Default_No_Compression','050003A70201','+6289644000001',-1,'Selamat Sore, ini adalah pesan promosi yang dikirim menggunakan SMSGateway. Pemilihan target promosi dilakukan dengan memperhatikan beberapa kriteria sep',15,'',1,'SendingError',-1,-1,255,'CRM'),('2014-07-10 23:11:17','2014-07-10 23:11:17','2014-07-10 23:11:17',NULL,'00530065006C0061006D0061007400200053006F00720065002C00200069006E00690020006100640061006C0061006800200070006500730061006E002000700072006F006D006F00730069002000790061006E0067002000640069006B006900720069006D0020006D0065006E006700670075006E0061006B0061006E00200053004D00530047006100740065007700610079002E002000500065006D0069006C006900680061006E0020007400610072006700650074002000700072006F006D006F00730069002000640069006C0061006B0075006B0061006E002000640065006E00670061006E0020006D0065006D0070006500720068006100740069006B0061006E0020006200650062006500720061007000610020006B00720069007400650072006900610020007300650070','085764520052','Default_No_Compression','050003A70201','+6289644000001',-1,'Selamat Sore, ini adalah pesan promosi yang dikirim menggunakan SMSGateway. Pemilihan target promosi dilakukan dengan memperhatikan beberapa kriteria sep',16,'',1,'SendingError',-1,-1,255,'CRM');

/*Table structure for table `spesialisiasi` */

DROP TABLE IF EXISTS `spesialisiasi`;

CREATE TABLE `spesialisiasi` (
  `id_spesialis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_spesialis` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_spesialis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `spesialisiasi` */

/*Table structure for table `target_promosi` */

DROP TABLE IF EXISTS `target_promosi`;

CREATE TABLE `target_promosi` (
  `id_promosi` int(11) NOT NULL,
  `id_pasien` varchar(11) NOT NULL,
  `nomor_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `target_promosi` */

insert  into `target_promosi`(`id_promosi`,`id_pasien`,`nomor_telp`) values (9,'PAS00004','085764520052');

/*Table structure for table `template_sms` */

DROP TABLE IF EXISTS `template_sms`;

CREATE TABLE `template_sms` (
  `id_template` int(5) NOT NULL AUTO_INCREMENT,
  `template` text,
  PRIMARY KEY (`id_template`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `template_sms` */

/*Table structure for table `waktu_jadwal` */

DROP TABLE IF EXISTS `waktu_jadwal`;

CREATE TABLE `waktu_jadwal` (
  `id_waktu_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_waktu_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `waktu_jadwal` */

insert  into `waktu_jadwal`(`id_waktu_jadwal`,`hari`) values (1,'Senin'),(2,'Selasa'),(3,'Rabu'),(4,'Kamis'),(5,'Jumat'),(6,'Sabtu'),(7,'Minggu');

/* Trigger structure for table `dokter` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `auto_dokter_pbk` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `auto_dokter_pbk` AFTER INSERT ON `dokter` FOR EACH ROW BEGIN
	insert into pbk VALUES(NULL,2,new.`nama`,new.`no_telp`);
	INSERT INTO admin VALUES(NULL,new.nama,new.nip_dokter,md5(new.nip_dokter),"dokter");
    END */$$


DELIMITER ;

/* Trigger structure for table `dokter` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update` AFTER UPDATE ON `dokter` FOR EACH ROW BEGIN
	UPDATE `pbk` SET Number = new.no_telp, NAME = new.nama WHERE number = old.no_telp;
    END */$$


DELIMITER ;

/* Trigger structure for table `inbox` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `inbox_timestamp` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox` FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `inbox` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `daftar_kunjungan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `daftar_kunjungan` AFTER INSERT ON `inbox` FOR EACH ROW BEGIN
	DECLARE job VARCHAR(20);
	DECLARE pasien VARCHAR(30);
	DECLARE poli VARCHAR(30);
	DECLARE nomor_urut INT(4);
	DECLARE kode INT(6);
	declare feedback text;
	
	SET job = upper(SUBSTRING_INDEX(new.TextDecoded, '#', 1));
	
	IF( job = "REG" ) THEN
		
		SET pasien 	= SUBSTR(SUBSTRING_INDEX(new.TextDecoded,"#",2),-8);
		SET poli 	= SUBSTR(SUBSTRING_INDEX(new.TextDecoded,"#",3),-7);
		
		/* CHECK ID PASIEN */
		SELECT COUNT(*) INTO @check_pasien FROM pasien WHERE id_pasien = pasien;
		
		IF @check_pasien = 0 THEN
			INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES (new.SenderNumber,"Maaf, ID Pasien salah", 'CRM');
		ELSE
			SELECT COUNT(*) INTO @check_poliklinik FROM poliklinik WHERE id_poliklinik = poli;
			
			IF @check_poliklinik = 0 THEN
				INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES (new.SenderNumber,"Maaf, ID POLI salah", 'CRM');
			ELSE
				
				SELECT COUNT(*) INTO @check_daftar FROM kunjungan_poli WHERE tanggal_kunjungan = DATE(NOW()) AND id_poli = poli AND id_pasien = pasien;
				
				IF @check_daftar > 0 THEN
					INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES (new.SenderNumber,CONCAT("pasien : ",pasien," telah terdaftar"), 'CRM');
				ELSE
					SELECT MAX(no_urut) INTO nomor_urut FROM kunjungan_poli WHERE tanggal_kunjungan = DATE( NOW() ) AND id_poli = poli;
				
					IF nomor_urut IS NULL THEN
						SET nomor_urut = 1;
					ELSE
						SET nomor_urut = nomor_urut +1;
					END IF;
					
					SET kode = ROUND(RAND() * 10000);
					/*INSERT INTO kunjungan_poli VALUES(NULL,pasien,poli,DATE(NOW()),kode, nomor_urut,0);*/
					INSERT INTO kunjungan_poli(`id_pasien`,`id_poli`,`tanggal_kunjungan`,`confirmation`,`no_urut`,`isConfirmed`,`isDone`) 
						VALUES(pasien,poli,DATE(NOW()),kode, nomor_urut,0,0);
					
					INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES (new.SenderNumber,
								CONCAT("Anda sudah didaftarkan, Nomor antrian : ",nomor_urut," kode konfirmasi : ",kode), 'CRM');
					
				
				END IF;
			END IF;
		END IF;
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `outbox` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `outbox_timestamp` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox` FOR EACH ROW BEGIN
	declare total_part int(3);
	declare message text;
	declare splitted_message varchar(153);
	declare first_part_message varchar(153);
	declare newID int(4);
	declare udhHeader varchar(8);
	declare messageUDH varchar(20);
	DECLARE loop_counter INT(3);
	IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
		SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
	END IF;
	IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
		SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
	END IF;
	IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
		SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
	END IF;
	
	set message = new.TextDecoded;
	set total_part = ceil(char_length(message)/153);
	SELECT AUTO_INCREMENT into newID FROM information_schema.tables WHERE table_name = 'outbox' AND table_schema = DATABASE() ;
	
	if total_part > 1 then
	
		set udhHeader = "050003A7";
		set loop_counter = 1;
		
		/*050003A7 10 02.*/
		/*         total nomor*/
	
		multipart_loop : loop
			
			if loop_counter > total_part then
				leave multipart_loop;
			end if;
			
			set splitted_message = SUBSTRING(message FROM (loop_counter-1)*153 FOR 153);
			
			SET messageUDH = CONCAT(udhHeader,LPAD(total_part,2,'0'),LPAD(loop_counter,2,'0'));
			
			if loop_counter = 1 then
			
				SET first_part_message = SUBSTRING(message FROM 1 FOR 153);
				
				set new.UDH = messageUDH;
				set new.TextDecoded = first_part_message;
				set new.ID = newID;
				set new.MultiPart = "true";
				set new.CreatorID = "CRM";
			else
				INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
				VALUES (messageUDH, splitted_message, newID, loop_counter);
				
			end if;
			
			set loop_counter = loop_counter + 1;
		end loop;
	
	
	
	end if;
    
    
END */$$


DELIMITER ;

/* Trigger structure for table `pasien` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `auto_pbk` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `auto_pbk` AFTER INSERT ON `pasien` FOR EACH ROW BEGIN
		
	insert into `pbk` values(NULL,1,new.`nama_pasien`,new.`no_telp`);
	
    END */$$


DELIMITER ;

/* Trigger structure for table `pasien` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `auto_update_pbk` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `auto_update_pbk` AFTER UPDATE ON `pasien` FOR EACH ROW BEGIN
	update `pbk` set Number = new.no_telp, Name = new.nama_pasien where number = old.no_telp;
	
    END */$$


DELIMITER ;

/* Trigger structure for table `phones` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `phones_timestamp` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `phones_timestamp` BEFORE INSERT ON `phones` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `portal_menu` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `auto_order` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `auto_order` BEFORE INSERT ON `portal_menu` FOR EACH ROW BEGIN
	SELECT menu_order INTO @id FROM portal_menu ORDER BY menu_order DESC LIMIT 1;
	set new.menu_order = @id+1;
    END */$$


DELIMITER ;

/* Trigger structure for table `sentitems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sentitems_timestamp` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    
    END IF;
END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
