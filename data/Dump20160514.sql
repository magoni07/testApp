CREATE DATABASE  IF NOT EXISTS `testdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `testdb`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: testdb
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) NOT NULL COMMENT 'id пользователя',
  `goods_id` int(11) NOT NULL COMMENT 'id товара',
  `amount` int(11) DEFAULT NULL COMMENT 'колличество',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index2` (`user_id`,`goods_id`),
  KEY `fk_user_goods_2_idx` (`goods_id`),
  CONSTRAINT `fk_cart_goods_id` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='товары пользователей';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (10,1,1,1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `price` double NOT NULL,
  `descr` longtext,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='товары';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'Lenovo Vibe S1',5999,'<p><b>Первая в мире двойная камера для Селфи</b><br>Со смартфоном <b>Vibe S1</b> вы всегда будете в центре внимания. Камера 8 Мп F2.2 с сенсором BSI гарантирует непревзойденное качество и четкость изображения и дополнена камерой 2 Мп для анализа глубины резкости, что дает пользователям беспрецедентные творческие возможности, включая функции рефокуса одним прикосновением <i>One-touch Refocus</i> и изменения фона <i>Background Swap</i>. К тому же, многочисленные режимы съемки обеспечивают вам максимальную гибкость: с функциями коррекции вы будете всегда прекрасно выглядеть, возможность управления жестами и голосом предоставляет стабильность при съемке.</p><p><b>Создан, чтобы подчеркнуть вашу индивидуальность</b><br><b>Vibe S1</b> привлекает взгляды окружающих. Стекло Gorilla Glass 3, из которого выполнен дисплей, рассеивает отражения, делает изображение более мягким. Задняя панель из изогнутого стекла и закругленная металлическая рамка из металла премиум качества придают <b>S1</b> утонченности и выразительности. Весом всего 132 г, этот стильный смартфон почти не будет ощущаться в вашем кармане.</p><p><b>Прекрасные снимки, даже в условиях недостаточного освещения</b><br>Со смартфоном <b>Vibe S1</b> вы будете получать отличные снимки даже в условиях недостаточного освещения. Благодаря основной камере 13 Мп F2.2 с датчиком недостаточного освещения BSI и системе фазового автофокуса (PDAF), которая позволяет датчику собирать больше информации и значительно повышать скорость фокусировки, ваши снимки будут отличного качество.</p><p><b>Сбалансированные оттенки цветов</b><br>Смартфон предлагает пользователям новый уровень фотосъемки: двухцветная вспышка оптимизирует оттенки цветов в зависимости от уровня освещения, яркости и температуры.</p><p><b>Яркое изображение</b><br><b>Vibe S1</b> оснащен 5-дюймовый дисплеем стандарта Full HD (440 точек на дюйм), что обеспечивает превосходное качество и четкость изображения даже при ярком солнечном свете.</p><p><b>Вместительное хранилище данных и память</b><br>Благодаря 3 ГБ оперативной памяти и встроенному хранилищу данных 32 ГБ с возможностью расширения на 128 ГБ за счет установки карты microSD, у вас всегда будет достаточно места для хранения всех ваших фото, музыки, игр и видео.</p><p><b>Android 5.0 Lollipop</b><br>Благодаря новым функциям, радикальным визуальным изменениям и многочисленным системным улучшением, операционная система <i>Android Lollipop</i> работает еще быстрее и эффективнее, а также потребляет меньше заряда аккумулятора по сравнению с прошлыми версиями. ОС также прекрасно работает со всеми вашими любимыми приложениями от Google.</p><p><b>Lenovo DOit</b><br>Приложение DOit от Lenovo расширяют возможности вашего <b>S1</b>. Приложение SHAREit позволяет передавать данные на другие устройства без подключения к сети или соединения WiFi; SYNCit позволяет делать резервные копии и восстанавливать контакты, SMS-сообщения и журналы звонков.</p><p><b>Исключительная производительность</b><br><b>Vibe S1</b> оснащен восьмиядерным 64-битным процессором MediaTek с тактовой частотой 1.7 ГГц, который обеспечивает идеальный баланс производительности и мощности. А 3 ГБ оперативной памяти гарантируют <b>Vibe S1</b> быструю передачу данных и бесперебойную работу современной ОС Android.</p><p><b>Поддержка двух SIM-карт</b><br>Смартфон поддерживает две SIM-карты: вы сможете с легкостью разделить рабочее и личное общение, сэкономить на разговорах в зарубежной поездке или просто воспользоваться наиболее выгодным тарифом.</p>',20),(2,'Samsung Galaxy J3 2016 J320H/DS',4599,'<p><b>Яркие впечатления от просмотра</b><br>Модель Samsung Galaxy J3 (2016) отличается более элегантным обновленным дизайном передней панели. Новый дизайн усиливает впечатление от просмотра. Тонкая черная рамка придает эффект глубокого погружения в изображение на экране.</p><p><b>Комфортный минимализм</b><br>При толщине 7.9 мм и ширине 71.05 мм, смартфон Samsung Galaxy J3 (2016) выглядит более изящно, приятная на ощупь текстура корпуса подчеркивает элегантность формы и ощущение комфорта при использовании смартфона.</p><p><b>Емкий аккумулятор</b><br>Аккумулятор с емкостью 2600 мА*ч позволит оставаться на связи дольше обычного. При отсутствии возможности подзарядки используйте режим максимального энергосбережения.</p><p><b>Повышенная производительность</b><br>4-ядерный процессор и 1.5 ГБ оперативная память обеспечивают мгновенную реакцию смартфона на любые ваши действия.</p><p><b>Удобное приложение Smart Manager</b><br>Простой способ управления основными функциями смартфона: уровень заряда аккумулятора, доступный объем памяти, состояние использования оперативной памяти и безопасность смартфона.</p><p><b>Дополнительные характеристики:</b></p><ul><li>Поддержка Gear Circle (Manager Support)</li><li>Датчики: Акселерометр, Датчик приближения</li><li>Поддерживаемые форматы видеофайлов: MP4, M4V, 3GP, 3G2, WMV, ASF, AVI, FLV, MKV, WEBM</li><li>Поддерживаемые форматы аудиофайлов: MP3, M4A, 3GA, AAC, OGG, OGA, WAV, WMA, AMR, AWB, FLAC, MID, MIDI, XMF, MXMF, IMY, RTTTL, RTX, OTA</li></ul>',10),(3,'Microsoft Lumia 650 Dual Sim',5777,'<p><b>Microsoft Lumia 650 Dual Sim</b><br>Откройте все преимущества смартфона, позволяющего легко работать с разными устройствами под управлением Windows 10. Благодаря отличным рабочим характеристикам, высокому качеству сборки и премиальному дизайну Lumia 650 Dual Sim — отличный выбор для вашего бизнеса.</p><p><b>Предназначен для деловых людей</b><br>Благодаря эффективным встроенным функциям безопасности и мгновенной настройке Office 365 смартфон Lumia 650 Dual Sim с Windows 10 и Qualcomm Snapdragon процессором, полностью совместим с IT-платформами Microsoft вашей компании. Поэтому этот телефон идеально подходит как для работы, так и для управления IT -отделом, ведь он полностью интегрирован с приложениями и сервисами Microsoft, предназначенными для работы, связи и любых других задач.</p><p><b>Максимальная четкость изображения</b><br>Наслаждайтесь яркой насыщенной картинкой даже при прямом солнечном освещении на защищенном покрытием Gorilla Glass 3 сверхчетком 5-дюймовом экране HD OLED, образующем единое целое с изумительно красивым металлическим корпусом. Благодаря легкой конструкции, толщине всего в 6.9 мм и 16 ГБ встроенной памяти Lumia 650 идеально сочетает в себе премиальный дизайн и великолепные рабочие характеристики.</p><p><b>Расширяемая память</b><br>Увеличьте доступную вам память до 200 ГБ с помощью карты MicroSD.</p><p><b>Энергосберегающие технологии</b><br>Настройка «Экономия заряда», помогающая максимально увеличить время работы от аккумулятора.</p><p><b>Ваш мобильный офис</b><br>На смартфоне установлены новейшие мобильные версии Word, PowerPoint, Excel, Outlook и OneNote, оптимизированные под сенсорный экран. Ваши приложения и сервисы Microsoft синхронизируются на устройствах Windows 10 посредством OneDrive. Благодаря этому все ваши фотографии и важные документы всегда с вами в нужный момент.</p>',15),(4,'Lenovo A7000',3299,'<p><b>Dolby Atmos</b><br><b>Lenovo A7000</b> — первый в мире смартфон с поддержкой новейшей технологии Dolby Atmos, обеспечивающей высочайшее качество и насыщенность звука. Благодаря объемному звуку вы сможете открыть новые грани музыки, видео, игр и даже видеочатов.</p><p><b>MediaTek 4G LTE True8Core</b><br>Процессор MediaTek 4G LTE True8Core отличается широкими мультимедийными возможностями и поддерживает функции энергосбережения, продлевающие время работы от аккумулятора. 2 ГБ оперативной памяти обеспечивают высочайшую производительность любых программ.</p><p><b>Большой 5.5-дюймовый HD-дисплей</b><br>5.5-дюймовый дисплей смартфона <b>Lenovo A7000</b> отличается кристально четким качеством изображения в играх, при обмене сообщениями, просмотре видео и веб-серфинге. Он основан на технологии IPS, обеспечивающей широчайшие (почти 180°) углы обзора, поэтому отлично подойдет для просмотра фильмов вместе с друзьями.</p><p><b>Задняя и фронтальная камеры</b><br><b>A7000</b> оснащен задней камерой 8 Мп с автоматическим фокусом и фронтальной камерой 5 Мп — вы сможете снимать отличные фотографии и селфи, а также мгновенно публиковать их.</p><p><b>Android 5.0 Lollipop</b><br>Последняя версия ОС Android обеспечивает еще более быструю и производительную работу системы. Будьте в курсе последних новостей, общайтесь с друзьями и даже управляйте энергопотреблением аккумулятора. Повышайте безопасность вашего <b>А7000</b> и наслаждайтесь множеством новых функций, которые делают жизнь еще приятнее.</p><p><b>Две SIM-карты</b><br>Смартфон поддерживает две SIM-карты: вы сможете с легкостью разделить рабочее и личное общение, сэкономить на разговорах в зарубежной поездке или просто воспользоваться наиболее выгодным тарифом. </p><p><b>Расширяемая система хранения</b><br>Вы можете с легкостью увеличить объем накопителя <b>A7000</b> на 32 ГБ для хранения фото, видео и музыки, установив карту памяти MicroSD.</p><p><b>Встроенные приложения Lenovo</b><br>Серия встроенных приложений DOit от Lenovo расширяет возможности устройства. С легкостью обменивайтесь данными с другими устройствами без подключения к сети, повышайте производительность системы, защите устройства от вирусов и вредоносного ПО, а также делайте резервные копии контактов, СМС-сообщений и журналов звонков. А специальной приложение автоматически менять фоновую графику в соответствии с текущими погодных условий.</p>',1),(5,'телефон 2',2100,'описание телефона 2',2),(6,'телефон 3',2200,'описание телефона 3',3),(7,'телефон 4',2300,'описание телефона 4',4),(8,'телефон 5',2400,'описание телефона 5',5),(9,'телефон 6',2500,'описание телефона 6',6),(10,'телефон 7',2600,'описание телефона 7',7),(11,'телефон 8',2700,'описание телефона 8',8),(12,'телефон 9',2800,'описание телефона 9',9),(13,'телефон 10',2900,'описание телефона 10',10),(14,'телефон 11',3000,'описание телефона 11',11),(15,'телефон 12',3100,'описание телефона 12',12),(16,'телефон 13',3200,'описание телефона 13',13),(17,'телефон 14',3300,'описание телефона 14',14),(18,'телефон 15',3400,'описание телефона 15',15),(19,'телефон 16',3500,'описание телефона 16',16),(20,'телефон 17',3600,'описание телефона 17',17),(21,'телефон 18',3700,'описание телефона 18',18),(22,'телефон 19',3800,'описание телефона 19',19),(23,'телефон 20',3900,'описание телефона 20',20);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_pict`
--

DROP TABLE IF EXISTS `goods_pict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_pict` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) DEFAULT NULL,
  `path` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_goods_pict_1_idx` (`goods_id`),
  CONSTRAINT `FK_272D19ECB7683595` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='содержит путь к изображения това';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_pict`
--

LOCK TABLES `goods_pict` WRITE;
/*!40000 ALTER TABLE `goods_pict` DISABLE KEYS */;
INSERT INTO `goods_pict` VALUES (1,1,'lenovo_vibe_s1/1.jpg'),(2,1,'lenovo_vibe_s1/2.jpg'),(3,1,'lenovo_vibe_s1/3.jpg'),(4,2,'samsung_sm_j320/1.jpg'),(5,2,'samsung_sm_j320/2.jpg'),(6,2,'samsung_sm_j320/3.jpg'),(7,3,'microsoft_lumia_650/1.jpg'),(8,3,'microsoft_lumia_650/2.jpg'),(9,3,'microsoft_lumia_650/3.jpg'),(30,4,'lenovo_A7000/1.jpg'),(31,4,'lenovo_A7000/2.jpg'),(32,4,'lenovo_A7000/3.jpg');
/*!40000 ALTER TABLE `goods_pict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_prop`
--

DROP TABLE IF EXISTS `goods_prop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_prop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) DEFAULT NULL,
  `props_id` int(11) DEFAULT NULL,
  `value` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index2` (`goods_id`,`props_id`),
  KEY `fk_goods_prop_2_idx` (`props_id`),
  CONSTRAINT `FK_9C86DE68527FC1EB` FOREIGN KEY (`props_id`) REFERENCES `props` (`id`),
  CONSTRAINT `FK_9C86DE68B7683595` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='связь товаров и свойств';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_prop`
--

LOCK TABLES `goods_prop` WRITE;
/*!40000 ALTER TABLE `goods_prop` DISABLE KEYS */;
INSERT INTO `goods_prop` VALUES (1,1,1,'2х'),(2,1,2,'Android'),(3,1,3,'Восьмиядерный MediaTek MT6752 (1.7 ГГц), 64 бит'),(4,1,4,'143.3 x 70.8 x 7.8 мм, 132 г'),(5,1,5,'Сенсорный моноблок'),(6,1,6,'5\" IPS, сенсорный емкостный, Multitouch<br> Разрешение: 1920 х 1080 пикселей'),(7,1,7,'Вибровызов<br> Полифонические мелодии<br> MP3 в качестве звонка'),(8,1,8,'<b>Основная:</b> 13 Мп<br> Двухцветная вспышка<br> Автофокус<br><br> <b>Фронтальная:</b> 8 Мп, 2 Мп'),(9,2,1,'2x'),(10,2,2,'Android'),(11,2,3,'Четырёхъядерный (1.5 ГГц)'),(12,2,4,'142.3 x 71.05 x 7.9 мм, 138 г'),(13,2,5,'Сенсорный моноблок'),(14,2,6,'5” Super AMOLED, сенсорный<br> Разрешение: 1280x720<br> 16 млн. цветов'),(15,2,7,'Вибровызов<br> MP3 в качестве звонка'),(16,2,8,'<b>Основная:</b> 8 Мп, CMOS<br><br> <b>Фронтальная камера:</b> 5 Мп, CMOS'),(17,3,1,'2x'),(18,3,2,'Windows 10 Mobile'),(19,3,3,'Четырехъядерный Qualcomm Snapdragon 212 (1.3 ГГц)'),(20,3,4,'142 x 70.9 x 6.9 мм<br> Вес: 122 г'),(21,3,5,'Сенсорный моноблок'),(22,3,6,'5\" OLED, сенсорный<br> Разрешение: 1280x720 пикселей<br> Плотность пикселей: 297 пикс/дюйм<br> Gorilla Glass 3<br> TrueColor (24-bit/16M)<br> Lumia Color profile<br> ClearBlack'),(23,3,7,'Виброзвонок<br> МР3 мелодии вызова'),(24,3,8,'<b>Основная камера:</b> 8 Мпикс<br>  Автофокус<br> LED вспышка<br> Цифровое увеличение камеры: 2x<br> Размер датчика: 1/4\"<br> Фокусное расстояние камеры: 28 мм<br> Минимальный диапазон фокусировки камеры: 10 см<br> Видеоразрешение основной камеры: 720p (HD, 1280 x 720), 30 кадров/с<br> Форматы записи видео: MP4 / H.264<br> <b>Фронтальная камера:</b> 5 Мпикс<br> Видеоразрешение фронтальной камеры: 720p (HD, 1280 x 720)'),(25,4,1,'2х'),(26,4,2,'Android'),(27,4,3,'64-битный восьмиядерный MediaTek MT6752 (1.5 ГГц)'),(28,4,4,'152.6 x76.2 x 7.99 мм<br>Вес: 140 г'),(29,4,5,'Сенсорный моноблок'),(30,4,7,'>5.5” IPS, сенсорный емкостный, Multitouch<br>Разрешение: 1280 х 720 точек<br>16 млн цветов, 267 ppi<br>'),(31,4,8,'Вибровызов<br>Полифонические мелодии<br>MP3 в качестве звонка</dd>');
/*!40000 ALTER TABLE `goods_prop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `props`
--

DROP TABLE IF EXISTS `props`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `props` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='свойства товаров';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `props`
--

LOCK TABLES `props` WRITE;
/*!40000 ALTER TABLE `props` DISABLE KEYS */;
INSERT INTO `props` VALUES (1,'Поддержка нескольких СИМ-карт'),(2,'Операционная система'),(3,'Процессор'),(4,'Размеры и вес'),(5,'Форм-фактор телефона'),(6,'Дисплей'),(7,'Сигналы вызова'),(8,'Камера');
/*!40000 ALTER TABLE `props` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `roleId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_57698A6AB8C2FD88` (`roleId`),
  KEY `IDX_57698A6A727ACA70` (`parent_id`),
  CONSTRAINT `FK_57698A6A727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'guest'),(2,1,'user');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_linker`
--

DROP TABLE IF EXISTS `user_role_linker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role_linker` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_61117899A76ED395` (`user_id`),
  KEY `IDX_61117899D60322AC` (`role_id`),
  CONSTRAINT `FK_61117899A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_61117899D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_linker`
--

LOCK TABLES `user_role_linker` WRITE;
/*!40000 ALTER TABLE `user_role_linker` DISABLE KEYS */;
INSERT INTO `user_role_linker` VALUES (1,2),(2,2);
/*!40000 ALTER TABLE `user_role_linker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `displayName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'magoni0786@gmail.com',NULL,'$2y$14$J.yneh818f82CbbhbeNlI.GtRjbas0w0dGe62d9AAmMVc04fDqVyG'),(2,NULL,'user@user.ru',NULL,'$2y$14$OdqY6jWXXQXQ/lsoEITSnuIw2DXulufO4DgbbR3LmWdbtJAUnTaKe');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-14 21:46:38
