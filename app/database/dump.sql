-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: kaonph
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `restaurant_id` int(10) unsigned NOT NULL,
  `date_visited` datetime NOT NULL,
  `rating` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_user_id_foreign` (`user_id`),
  KEY `customers_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `customers_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_specialties`
--

DROP TABLE IF EXISTS `food_specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_specialties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(10) unsigned NOT NULL,
  `food_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `food_specialties_restaurant_id_foreign` (`restaurant_id`),
  KEY `food_specialties_food_id_foreign` (`food_id`),
  CONSTRAINT `food_specialties_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  CONSTRAINT `food_specialties_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_specialties`
--

LOCK TABLES `food_specialties` WRITE;
/*!40000 ALTER TABLE `food_specialties` DISABLE KEYS */;
/*!40000 ALTER TABLE `food_specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_types`
--

DROP TABLE IF EXISTS `food_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_types`
--

LOCK TABLES `food_types` WRITE;
/*!40000 ALTER TABLE `food_types` DISABLE KEYS */;
INSERT INTO `food_types` VALUES (1,'Salad'),(2,'Appetizer'),(3,'Main Dish'),(4,'Desert'),(5,'Pasta'),(6,'Soup'),(7,'Seafoods'),(8,'Wine'),(9,'Beverages'),(10,'Shakes');
/*!40000 ALTER TABLE `food_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `foods_restaurant_id_foreign` (`restaurant_id`),
  KEY `foods_type_id_foreign` (`type_id`),
  CONSTRAINT `foods_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `food_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `foods_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foods`
--

LOCK TABLES `foods` WRITE;
/*!40000 ALTER TABLE `foods` DISABLE KEYS */;
INSERT INTO `foods` VALUES (1,1,2,'flo',443.08,NULL,'recusandae qui ipsum tempore ut veritatis optio. quidem est dolore aut. dolores recusandae vel voluptas voluptatem. quia eos provident voluptatum at.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(2,1,7,'michaela',367.30,NULL,'eos totam dolor omnis ut nulla et. non dignissimos exercitationem dolorem omnis deleniti. quis iste aut omnis hic saepe aspernatur voluptate cum. facilis quia voluptates dolore iusto et.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(3,1,8,'melvin',226.35,NULL,'reprehenderit cupiditate ut asperiores recusandae est atque inventore. quis at porro dolorem.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(4,1,3,'ryder',494.85,NULL,'animi non corrupti et. iusto itaque ea sit quis. et occaecati similique doloribus aperiam. autem quia itaque perspiciatis quo fugiat.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(5,1,6,'louvenia',374.71,NULL,'adipisci inventore saepe consequuntur aspernatur temporibus dolorem. fugiat dolores est quam saepe ullam eos et. sit quia illum temporibus explicabo aut ullam. aut pariatur eos voluptates. similique perferendis tenetur ut architecto qui quos.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(6,1,3,'hope',162.79,NULL,'ad debitis pariatur nisi temporibus consequatur veniam aliquam. voluptatem ut architecto ut veniam aut. possimus sint debitis temporibus. dolorem nisi in nulla eveniet id iure. architecto rerum aut quis ut rerum aut aspernatur possimus.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(7,1,10,'kallie',205.48,NULL,'rem autem ad fugit eum suscipit. veniam magni ea omnis et eum tempore. atque ab incidunt qui error.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(8,1,5,'maye',421.67,NULL,'libero quia dolorem tenetur et molestiae. velit beatae et sapiente sed voluptates ad. sequi illo iste fugit quis. neque magni eius est quidem eaque ad.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(9,1,3,'deion',461.33,NULL,'laborum corrupti placeat quo repellendus quas minus. cum eos quia quia atque tempora maxime non. hic sunt molestiae maiores ex molestiae et.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(10,1,3,'april',206.08,NULL,'illum eos ullam voluptatem inventore porro omnis. voluptate ducimus qui molestiae nobis qui ut eaque. sequi a magnam maxime ut molestias.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(11,1,7,'erwin',176.94,NULL,'dolor enim est sint aut beatae ad sunt. libero qui a ut voluptates et optio nostrum. exercitationem consequatur porro maiores est nesciunt.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(12,1,1,'jamel',307.47,NULL,'sit est aspernatur est vel necessitatibus tenetur possimus. possimus sunt possimus rerum vel voluptas amet. voluptas sunt tenetur distinctio debitis sit dolorem. eveniet hic atque voluptas.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(13,1,10,'thomas',459.24,NULL,'neque voluptatem alias occaecati nobis enim aut molestias. eos quos odio ullam eos repudiandae qui. dolorum aspernatur aut corrupti voluptas iusto consequuntur.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(14,1,6,'bessie',171.57,NULL,'ut amet rerum dolor dolorem quisquam rem. qui qui id aut expedita consequatur ut. et velit ut non saepe at temporibus. odit a est consequuntur ut voluptas illo.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(15,1,4,'marian',149.96,NULL,'perferendis nam dolore consequatur molestiae. repellat dolores aliquid architecto vitae fuga. quaerat ad ut saepe libero enim et quisquam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(16,2,7,'scot',81.94,NULL,'in odit voluptatem enim aut veniam ut tempore. aperiam nihil totam molestiae magni sunt cum iste. id saepe consequuntur fuga praesentium debitis ipsum facere laudantium. consequatur expedita possimus est.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(17,2,3,'fabiola',220.26,NULL,'vitae rerum et illum similique. voluptatem sequi ullam ducimus rem. ducimus nihil quam voluptas sed consequuntur nulla molestiae. numquam magni unde officiis recusandae quo qui.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(18,2,8,'bryce',90.20,NULL,'ipsam ut rem ipsum modi ullam. repellat et provident nobis sit libero ipsam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(19,2,3,'zelma',110.36,NULL,'est quia voluptate rerum quisquam. aut voluptatem magni sed velit. iste cumque sapiente perferendis odio libero.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(20,2,6,'katelyn',114.89,NULL,'eaque alias tempora quae quia eum quo deserunt. qui qui eos soluta laudantium illo nihil. ea et aut rerum est reiciendis.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(21,2,3,'viva',215.42,NULL,'quia a sapiente nostrum aspernatur. aliquid est perferendis nostrum. dignissimos doloribus est cupiditate quo tempore aut dolor.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(22,2,5,'aurelie',311.67,NULL,'autem a expedita nihil consequuntur dolorum. eum similique facere nulla consequuntur. voluptatem omnis quasi sunt placeat ea culpa.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(23,2,9,'laurence',323.64,NULL,'quia accusamus dicta hic id autem consectetur. voluptate incidunt optio numquam est facere odio. odio iusto vel eos sequi expedita aperiam alias expedita.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(24,2,8,'jermaine',432.49,NULL,'eius harum aut sapiente. quis aliquid quaerat sint voluptates quibusdam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(25,2,8,'doris',499.23,NULL,'recusandae et ab incidunt exercitationem qui temporibus veniam. animi quia itaque consequuntur omnis ex itaque qui. autem nobis vel necessitatibus inventore maiores quo. occaecati et saepe quaerat ut.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(26,2,6,'emerald',357.12,NULL,'quibusdam veritatis veritatis optio molestiae. maxime quis eos consequatur molestiae rerum suscipit. sint dignissimos laudantium corporis ut doloribus nam magni. soluta omnis nam modi quis eligendi. molestias expedita ad nostrum quas quia beatae corrupti.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(27,2,5,'gillian',139.01,NULL,'commodi veritatis labore quasi odit aperiam optio aliquam cumque. voluptas necessitatibus deserunt inventore dolores et ea odit. ab quisquam vitae eligendi enim esse et eos cupiditate.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(28,2,3,'lloyd',208.27,NULL,'occaecati corporis ea asperiores dicta itaque similique dolor dolores. ab non consequuntur minus quisquam et. et commodi unde reprehenderit omnis et.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(29,2,2,'eula',212.72,NULL,'a sed recusandae aut illum. et aut cupiditate nemo voluptates odit consequatur. dolor ut tempore quis unde totam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(30,2,10,'kasandra',140.80,NULL,'est consequatur exercitationem veritatis omnis. consequuntur sed consequatur beatae iste consectetur.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(31,3,3,'aliza',50.72,NULL,'commodi alias saepe corporis qui. rerum dignissimos eius repudiandae. nulla assumenda incidunt voluptatem.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(32,3,9,'zion',438.39,NULL,'sint a autem repellendus et. omnis nihil optio quae rerum consectetur. impedit magnam itaque voluptas vitae voluptas rem. dolores doloribus illo ut repellat.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(33,3,3,'maida',401.85,NULL,'saepe voluptatem architecto dignissimos qui itaque. placeat eligendi repellat aut quos aperiam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(34,3,5,'elmore',334.36,NULL,'rerum sequi repellat velit velit itaque dolorem ut. eum corporis maxime illum ipsum et commodi dolor. et molestiae maxime ullam animi aliquid. vero totam et quam voluptatum ea error.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(35,3,9,'aurore',243.87,NULL,'quas necessitatibus aut pariatur provident in quas vel. dolores perspiciatis dignissimos nobis unde. voluptate sed qui veritatis. sed tempora voluptatem neque non aut quos quibusdam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(36,3,6,'jaydon',249.70,NULL,'natus mollitia eos doloribus suscipit vel odio. asperiores quia pariatur voluptatem quasi sit dolorem eligendi consequatur. eveniet magnam quia et quo atque. animi et aut et deserunt quasi cumque.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(37,3,10,'tessie',162.09,NULL,'assumenda impedit distinctio harum reprehenderit hic natus architecto quia. eligendi sit repellendus officiis et non voluptate. id ratione soluta fugit.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(38,3,9,'nickolas',290.78,NULL,'recusandae saepe cumque consequatur rerum odit. sint ab quam iure cum reprehenderit laboriosam delectus. voluptatem vel molestiae voluptatum aut.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(39,3,8,'osborne',306.98,NULL,'sit aperiam mollitia quaerat provident mollitia ut. quo doloribus itaque tempore sapiente. similique rerum quaerat voluptate commodi ut.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(40,3,8,'shakira',238.83,NULL,'eveniet maxime corporis odit quis ad voluptas rerum repudiandae. sed rerum animi repellat. aliquam recusandae quo mollitia vitae consequatur.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(41,3,5,'camden',461.74,NULL,'voluptas sit nulla expedita laborum. distinctio neque explicabo qui non veniam cumque odit. sunt quibusdam voluptas consequatur omnis suscipit excepturi.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(42,3,3,'antonette',129.01,NULL,'ea delectus voluptatum repellendus id. et voluptate ad sequi et rem iusto. vero dolorem quia mollitia tenetur aut aut. dolorem esse qui totam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(43,3,5,'carson',344.40,NULL,'voluptatem voluptatem autem sed. aut qui dolor aut et. unde saepe beatae pariatur expedita aperiam dicta. quia nihil nulla pariatur voluptatem excepturi.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(44,3,4,'mazie',154.79,NULL,'et tempore nihil voluptas mollitia iure assumenda. rerum voluptas est qui rerum numquam omnis.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(45,3,10,'jared',155.44,NULL,'eius perferendis accusamus voluptatem velit. et quasi ut nesciunt aut consequatur dolorem. iste nostrum ut perspiciatis consequatur corporis. possimus libero totam odit harum earum.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(46,4,4,'weldon',53.20,NULL,'laborum laudantium quia sed molestiae accusantium beatae rerum odit. beatae quo cumque cum quasi. recusandae doloremque aperiam non voluptatem harum.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(47,4,8,'fleta',273.08,NULL,'porro eius nesciunt a voluptatem. autem veniam officia nisi eos a veniam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(48,4,10,'israel',76.07,NULL,'excepturi est quam aut quasi quae beatae quae. ullam dolorem eum aperiam exercitationem. laboriosam placeat qui veritatis totam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(49,4,4,'nadia',458.16,NULL,'ut recusandae sed laboriosam non sequi et. odio sit itaque dolorum qui. minus dicta eum modi doloribus dicta et natus. quia sapiente tenetur facilis provident culpa voluptates quibusdam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(50,4,8,'malachi',78.60,NULL,'deleniti laboriosam similique sit corporis quisquam. nam veniam aut voluptatem iste. laborum dicta maiores perspiciatis corporis.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(51,4,5,'brycen',183.70,NULL,'voluptatem non non recusandae incidunt. minus officia animi provident. atque tenetur deleniti sed sunt eveniet fugiat id.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(52,4,10,'graham',467.75,NULL,'magni voluptates expedita asperiores distinctio adipisci. debitis perspiciatis in perspiciatis quo reprehenderit. quod vitae sed quos magnam amet non est nam.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(53,4,10,'torrance',385.02,NULL,'a et error fugit. voluptate voluptatem laboriosam assumenda et at dolores numquam. quibusdam deleniti at sequi accusantium vel. ea mollitia distinctio ut asperiores et facere.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(54,4,1,'jayme',279.47,NULL,'cumque sed sunt eum. soluta deleniti libero excepturi numquam fuga accusantium. autem quia eligendi aut et ipsum. praesentium id ad ducimus dolores optio enim. doloribus tenetur nesciunt sequi dicta aliquid optio.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(55,4,8,'joanie',186.36,NULL,'fuga non adipisci officiis. aliquid omnis culpa commodi at facilis necessitatibus quo. explicabo explicabo facere dignissimos in amet.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(56,4,9,'gregg',155.24,NULL,'officia modi id labore veritatis laudantium quas veniam. rerum ipsa voluptates sint. nihil excepturi incidunt quibusdam sit iste natus aspernatur.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(57,4,2,'amina',393.37,NULL,'fuga at ut dolores optio. illo voluptas rem totam ea. consequuntur perspiciatis quo distinctio facere exercitationem possimus. sit qui quisquam fuga magni pariatur maiores.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(58,4,10,'jacinthe',273.88,NULL,'dolor non quia quod tempore nemo. quis eius sint dolor consequatur consequatur at illo. aut quod dolor corrupti nam dolores in facere. a cumque aliquam neque.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(59,4,2,'laron',93.68,NULL,'deserunt id qui iure ut. dolorem qui quis consequuntur dolorum.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(60,4,7,'aletha',148.06,NULL,'placeat soluta est quas molestiae. possimus suscipit quis laborum saepe aut iusto. quibusdam eaque rem unde a temporibus non qui.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(61,5,10,'tanya',121.30,NULL,'tempore aspernatur ipsam praesentium quod tempore repellendus maiores nulla. dolorem ratione et vitae qui in. temporibus reprehenderit et quis corrupti ipsam porro ratione.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(62,5,1,'alan',109.40,NULL,'similique fuga ut aut corporis id animi. rerum dicta possimus et est et et. dicta quo qui quisquam maxime. voluptatem vel repudiandae deserunt aut suscipit et.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(63,5,8,'jeremie',231.35,NULL,'soluta qui sunt autem nemo. qui id praesentium ut qui perspiciatis porro. quod est alias et expedita quia vel.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(64,5,9,'yvonne',204.42,NULL,'ut commodi ut consequuntur. doloremque voluptatum qui magni magni. dolore voluptatum eveniet omnis est doloribus atque. quos aliquid totam consectetur et magnam tenetur.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(65,5,4,'stuart',226.57,NULL,'sint rem qui id aliquid eum. sit omnis praesentium nostrum quis facere. at inventore modi perferendis enim nulla deserunt.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(66,5,7,'citlalli',277.76,NULL,'perferendis et atque iste fugit quas ea sint harum. et sed laudantium tempore in. debitis id doloribus alias omnis in.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(67,5,5,'newton',216.71,NULL,'qui nisi incidunt quia consequatur ut. nihil id voluptas in magni sapiente. a qui qui nisi voluptatem autem porro earum. non ut dolorem quod adipisci veniam molestiae assumenda. est qui enim possimus ex molestiae.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(68,5,4,'enos',404.54,NULL,'id distinctio sunt non. perspiciatis eos omnis est sit. iure veniam similique architecto dolorem et iste voluptas. doloremque aut hic doloremque.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(69,5,5,'jaleel',283.73,NULL,'fuga unde fuga vero molestiae. harum quibusdam amet voluptatem ut aliquid eos. voluptatem nulla dolore quam qui.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(70,5,7,'vernon',256.24,NULL,'nihil et rerum porro provident aut. repellendus aut dolores eius. nisi delectus earum corrupti ipsum accusamus.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(71,5,10,'emmy',358.44,NULL,'saepe fugiat dolorum optio quia. saepe recusandae quis in esse. reiciendis voluptatem architecto velit provident eos commodi fugiat.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(72,5,9,'veronica',419.33,NULL,'aut consequatur corrupti sunt et. fugit accusantium assumenda vel aliquid. adipisci beatae excepturi tenetur porro aut sint. omnis non necessitatibus ducimus voluptatibus.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(73,5,8,'erick',210.41,NULL,'enim inventore est excepturi eaque est aut. quia enim pariatur eum. accusamus qui adipisci fuga est autem explicabo quos.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(74,5,10,'vern',380.73,NULL,'sunt hic vero fuga odit repellendus nihil. iure deserunt ut inventore quia. iusto quia laboriosam voluptates et repellat. repellendus veniam fugiat saepe eveniet quos aut minima.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(75,5,7,'saul',110.28,NULL,'rerum et est assumenda et dolor. debitis consequatur illo est neque repudiandae. pariatur qui non amet consequuntur consequatur sit error dicta.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(76,6,1,'hermina',241.19,NULL,'repudiandae aliquam et adipisci et et dolorem. quasi modi debitis excepturi velit repellat suscipit.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(77,6,2,'curtis',439.21,NULL,'et asperiores at et sit. ut et ipsum nobis consequatur voluptatibus. magnam similique dolores nulla quod.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(78,6,5,'golden',466.75,NULL,'voluptas et sapiente non et similique voluptatem. velit optio qui nesciunt ducimus vero in cum quia. aut iure voluptas ipsam dignissimos rerum ea architecto.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(79,6,2,'owen',165.55,NULL,'nobis voluptas consequatur fugit tempore dolorem ut omnis molestiae. inventore ea vel labore minima est omnis maxime. praesentium tenetur nesciunt voluptas eius ut ut omnis.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(80,6,6,'kaylin',421.52,NULL,'minima incidunt quo est nulla ea atque minus. omnis cupiditate explicabo asperiores. repudiandae modi ut numquam ut. nostrum iure cupiditate a dolorum architecto ab.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(81,6,2,'loyce',391.10,NULL,'tempore perspiciatis saepe sint qui architecto. fugiat nulla ex quae est quidem ut quas.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(82,6,4,'ethan',116.84,NULL,'omnis autem non corporis explicabo officiis. impedit magni et voluptatem qui id similique aut. et officiis similique deleniti. adipisci nostrum ut eum id modi dolorem ratione.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(83,6,7,'orland',449.10,NULL,'reprehenderit minus nam temporibus nulla consequatur. sint commodi optio aliquam ut neque ut. adipisci perspiciatis quibusdam quia cum exercitationem nulla et incidunt. in qui qui incidunt praesentium.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(84,6,1,'hermann',415.73,NULL,'est minus repudiandae et nam totam debitis. porro aspernatur quas est ab sint nobis. cum velit itaque sint blanditiis voluptatem ut.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(85,6,5,'rylan',304.43,NULL,'quibusdam inventore aspernatur vero. sint ut ex amet. quibusdam nam asperiores rem officia qui non perspiciatis quo.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(86,6,10,'oswald',448.14,NULL,'aut delectus dolorem aperiam. qui exercitationem reiciendis et quo. eum provident molestiae impedit omnis minima.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(87,6,6,'paolo',466.36,NULL,'quam id perspiciatis iure eos sit est. ratione est et nemo pariatur error voluptatum. facilis dolor expedita sed. ducimus natus consequatur dolorem voluptatum neque omnis voluptatem.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(88,6,6,'myrtice',360.91,NULL,'neque est occaecati laboriosam unde quas accusamus deleniti. iure accusamus soluta aut incidunt reiciendis. odio libero velit inventore beatae ad.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(89,6,5,'alexzander',212.83,NULL,'dolor et facilis ipsam facilis molestiae corporis sit corporis. dolor facilis iusto qui sequi. saepe nam est dolorem corrupti minima.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(90,6,7,'kaci',423.28,NULL,'nobis aliquid quo rerum reiciendis. sed ut odit magnam molestiae sed magni corporis.',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25');
/*!40000 ALTER TABLE `foods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2015_07_15_012002_create_roles_table',1),('2015_07_15_012124_create_users_table',1),('2015_07_15_073927_add_foreign_keys_on_users_table',1),('2015_07_16_012245_create_restaurants_table',1),('2015_07_16_110054_add_foreign_keys_on_restaurants_table',1),('2015_07_16_110157_create_food_types_table',1),('2015_07_16_110210_create_foods_table',1),('2015_07_17_041228_create_food_specialties_table',1),('2015_07_17_041431_add_foreign_keys_on_foods_table',1),('2015_07_17_065656_create_customers_table',1),('2015_07_17_070322_add_foreign_keys_on_customers_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `coordinates` point DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurants_owner_id_foreign` (`owner_id`),
  CONSTRAINT `restaurants_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (1,1,'chikaan','28277 wayne mews\nveronamouth, id 59594','filipino','(34) 7821-1089','chikaan.jpg','2015-07-22 08:19:24','2015-07-22 08:19:24',NULL,'\0\0\0\0\0\0\0(^¼ÄqŸ$@\0\0\0ª=ù^@'),(2,2,'jolibee','3594 josefina points suite 844\nsouth traceymouth, or 60232','fastfood','(14) 99341-6983','jollibee.jpg','2015-07-22 08:19:24','2015-07-22 08:19:24',NULL,'\0\0\0\0\0\0\0¼„ÜÇÄŸ$@\0\0\0Öµú^@'),(3,3,'mcdo','35349 dach trail\nnorth elisabeth, ga 55697-7901','fastfood','(66) 9733-6960','mcdo.jpg','2015-07-22 08:19:25','2015-07-22 08:19:25',NULL,'\0\0\0\0\0\0\0%Œ£Ë¢$@\0\0\0Vëù^@'),(4,4,'sunburst','52521 king estates\nwest berneice, de 22064','fine dining','(78) 7417-5622','sunburst.jpg','2015-07-22 08:19:25','2015-07-22 08:19:25',NULL,'\0\0\0\0\0\0\0ƒž\Zà§$@\0\0\0þ÷ù^@'),(5,5,'casa verde','733 anna mall\nnew linda, mi 15343-4741','fine dining','(37) 2054-3961','casaverde.jpg','2015-07-22 08:19:25','2015-07-22 08:19:25',NULL,'\0\0\0\0\0\0\0”>[¾Ëž$@\0\0\0ž£ù^@'),(6,6,'ching palace','721 selina squares apt. 382\nnorth lorenz, me 35407-2528','fine dining','(58) 7533-9639','ching-palace.jpg','2015-07-22 08:19:25','2015-07-22 08:19:25',NULL,'\0\0\0\0\0\0\0µ‰y©$@\0\0\0ßžù^@');
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'owner'),(3,'public');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'dchamplin@yahoo.com','$2y$10$ox5.5lHir6JiHMVCu1JPnuq9Fzm9d60LctA/F8PotM928JPVzYGGW','Chase','Bins','1994-05-25','male','worker','',NULL,'2015-07-22 08:19:24','2015-07-22 08:19:24'),(2,2,'bo.volkman@gmail.com','$2y$10$PPKBgQxXRkROh6bawlWApu1QsNEi2rXRNhJAmzJ/yhWKsO6PK7K2u','Kattie','Jacobi','1991-07-26','male','worker','',NULL,'2015-07-22 08:19:24','2015-07-22 08:19:24'),(3,2,'murray.thalia@hotmail.com','$2y$10$Pwzb5eKfVlGJj4jl7z5uQuQlgULES0yn1.jQ26q6ox3mJOE30lnWW','Clara','Kris','2007-05-23','female','worker','',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(4,2,'tyson15@howell.info','$2y$10$SvgHYlasFgxw9Wp3y52Ot.GYK0Tqtht.pPhs2kwjKsWzxw6HQ07R2','Name','Donnelly','2012-03-22','female','worker','',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(5,2,'zhaag@gmail.com','$2y$10$bxBbCinpu4b8SkOvz4FqRuIB6Tset7DLfTzwtS9SIsvAoxHc6KYDO','Reginald','Daniel','1978-08-01','male','worker','',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(6,2,'allan.prohaska@yahoo.com','$2y$10$RR9bKaU0av61pGKGy7BqrOqK0uzA.7ziN/A/JlarHEyY5oyyTdADK','Elmore','Abernathy','1986-05-01','male','worker','',NULL,'2015-07-22 08:19:25','2015-07-22 08:19:25'),(8,2,'waynearila@yahoo.com','$2y$10$GVW8w8BZ0597ncE.yOJIOulIN40Yhr8Wj4OD9hyAj.aryk5nKIUou','wayne','abarquez','09/08/1989','male','Tambay','',NULL,'2015-07-22 08:38:57','2015-07-22 08:38:57');
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

-- Dump completed on 2015-07-22 16:50:12
