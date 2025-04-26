-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bookstore
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `Author_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Biography` text DEFAULT NULL,
  `Date_of_Birth` date DEFAULT NULL,
  `Nationality` int(1) DEFAULT NULL,
  `Img_Author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Author_id`),
  KEY `fk_author_nationality` (`Nationality`),
  CONSTRAINT `fk_author_nationality` FOREIGN KEY (`Nationality`) REFERENCES `countries` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Không xác định',NULL,NULL,NULL,NULL),(2,'Nguyễn Nhật Ánh','Nguyễn Nhật Ánh sinh ngày 7 tháng 5 năm 1955 tại tỉnh Quảng Nam.  Ông được coi là một trong những nhà văn thành công nhất viết sách cho tuổi thơ, tuồi mới lớn với hơn 100 tác phẩm các thể loại.\r\n\r\nTrước khi trở thành nhà văn nổi tiếng, Nguyễn Nhật Ánh từng có thời gian đi dạy học, viết báo với nhiều bút danh như Chu Đình Ngạn, Lê Duy Cật, Đông Phương Sóc, Sóc Phương Đông,... Năm 13 tuổi, ông đã có thơ đăng báo. Năm 1984, tác phẩm truyện dài đầu tiên Trước vòng chung kết đã định vị tên tuổi của ông trong lòng độc giả và kể từ đó, ông tập trung viết cho lứa tuổi thanh thiếu niên.\r\n\r\nTên tuổi của nhà văn Nguyễn Nhật Ánh gắn liền với các tác phẩm làm say lòng độc giả bao thế hệ như Mắt biếc, Cỏn chút gì để nhớ, Hạ đỏ, Cô gái đến từ hôm qua, Chú bé rắc rối,… Truyện của ông được tái bản liên tục và chưa bao giờ giảm sức hút với những người yêu mến chất văn Nguyễn Nhật Ánh.\r\n\r\nÔng cũng đã đoạt nhiều giải thưởng như: năm 1990, truyện dài “Chú bé rắc rối” được Trung ương Đoàn Thanh niên Cộng sản Hồ Chí Minh trao giải thưởng Văn học Trẻ hạng A. Năm 1995, ông được bầu chọn là nhà văn được yêu thích nhất trong 20 năm (1975-1995) qua cuộc trưng cầu ý kiến bạn đọc về các gương mặt trẻ tiêu biểu trên mọi lĩnh vực của Thành đoàn TP HCM và Báo Tuổi trẻ, đồng thời được Hội Nhà văn TP HCM chọn là một trong 20 nhà văn trẻ tiêu biểu trong 20 năm (1975-1995).\r\n\r\nNăm 2010, tác phẩm Cho tôi xin một vé đi tuổi thơ của ông được trao tặng Giải thưởng Văn học ASEAN.                            ','1955-06-15',185,'Nguyễn_Nhật_Ánh.jpg'),(3,'J.K. Rowling','<p>J.K. Rowling l&agrave; t&aacute;c giả của bộ tiểu thuyết Harry Potter, đ&atilde; đạt nhiều giải thưởng v&agrave; c&oacute; con số ph&aacute;t h&agrave;nh kỷ lục. Bộ s&aacute;ch được bạn đọc tr&ecirc;n khắp thế giới y&ecirc;u chuộng, đ&atilde; b&aacute;n được hơn 500 triệu bản, được dịch sang 80 thứ tiếng v&agrave; dựng th&agrave;nh t&aacute;m tập phim bom tấn.</p>\r\n<p>B&agrave; đ&atilde; viết ba ngoại truyện v&igrave; mục đ&iacute;ch từ thiện: Quidditch qua c&aacute;c thời kỳ, Những sinh vật huyền b&iacute; v&agrave; nơi t&igrave;m ra ch&uacute;ng (để hỗ trợ cho quỹ Comic Relief v&agrave; Lumos), v&agrave; Những c&acirc;u chuyện của Beedle người h&aacute;t rong (hỗ trợ cho quỹ Lumos), cũng như kịch bản phim những sinh vật huyền b&iacute; v&agrave; nơi t&igrave;m ra ch&uacute;ng, khởi đầu cho loạt phim năm sau được viết bởi ch&iacute;nh t&aacute;c giả truyện gốc.</p>\r\n<p>Năm 2016, J.K. Rowling hợp t&aacute;c với Hack Thorne v&agrave; gi&aacute;m đốc sản xuất John Tiffany trong vở kịch Harry Potter v&agrave; đứa trẻ bị nguyền rủa Phần Một v&agrave; Hai, hiện đang c&ocirc;ng diễn tại The Palace Theatre tại khu West End, London v&agrave; diễn tại s&acirc;n khấu Broadway v&agrave;o th&aacute;ng 4 năm 2018.</p>\r\n<p>Năm 2012, c&ocirc;ng ty kỹ thuật số Pottermore của J,K. Rowling ra đời, tạo điều kiện cho người h&acirc;m mộ theo d&otilde;i tin tức, sự kiện v&agrave; c&aacute;c b&agrave;i viết trực tiếp từ b&agrave;. T&aacute;c phẩm đầu ti&ecirc;n d&agrave;nh cho người lớn của b&agrave; c&oacute; t&ecirc;n Khoảng trống (The Casual Vacancy), ra mắt năm 2012 v&agrave; được BBC chuyển thể th&agrave;nh phim truyền h&igrave;nh v&agrave;o năm 2015. Bộ tiểu thuyết trinh th&aacute;m b&agrave; viết dưới b&uacute;t danh Robert Galbraith được ph&aacute;t h&agrave;nh năm 2013 (Con chim kh&aacute;t tổ - The Cuckoo&rsquo;s calling), 2014 (Con tằm &ndash; The Silkworm) v&agrave; 2015 (Nghiệp &aacute;c &ndash; Career of Evil) được chuyển thể th&agrave;nh series phim truyền h&igrave;nh ph&aacute;t tr&ecirc;n k&ecirc;nh BBC One, do h&atilde;ng Bront&euml; Film and Television sản xuất.</p>\r\n<p>B&agrave;i ph&aacute;t biểu của J.K. Rowling v&agrave;o năm 2008 tại lễ ph&aacute;t bằng tốt nghiệp của đại học Harvard được ph&aacute;t h&agrave;nh dưới dạng s&aacute;ch c&oacute; tranh minh họa, với tựa đề Very Good Lives: The Fringe Benefits of Failure and the Importance of Imagination (Những cuộc đời v&ocirc; c&ugrave;ng tốt đẹp: C&aacute;c lợi &iacute;ch đi k&egrave;m thất bại v&agrave; tầm quan trọng của tr&iacute; tưởng tượng)</p>\r\n<p>B&agrave; đ&atilde; nhận rất nhiều giải thưởng v&agrave; danh hiệu, bao gồm cả huy chương OBE v&agrave; huy chương Companion of Honour, France&rsquo;s L&eacute;gion d&rsquo;honneur, v&agrave; giải thưởng Hans Christian Andersen.</p>','1965-07-31',74,'nxbtre_thumb_06582016_095839.jpg'),(4,'Dan Brown','<p data-pm-slice=\"0 0 []\">Dan Brown (sinh ng&agrave;y 22 th&aacute;ng 6 năm 1964) l&agrave; một nh&agrave; văn Mỹ chuy&ecirc;n viết tiểu thuyết hư cấu, bao gồm loạt truyện về nh&acirc;n vật Robert Langdon: Thi&ecirc;n thần v&agrave; &aacute;c quỷ (2000), Mật m&atilde; Da Vinci (2003), Biểu tượng thất truyền (2009), Hỏa ngục (2013) v&agrave; Nguồn cội (2017). Nội dung c&aacute;c tiểu thuyết l&agrave; đi t&igrave;m c&aacute;c b&aacute;u vật trong v&ograve;ng 24 giờ. Ch&uacute;ng thường chứa c&aacute;c chủ đề lặp lại về mật m&atilde;, nghệ thuật v&agrave; c&aacute;c thuyết &acirc;m mưu. Ba trong số những tiểu thuyết của &ocirc;ng đ&atilde; được chuyển thể th&agrave;nh phim.</p>','1964-06-22',74,'Dan_Brown.jpg'),(5,'Haruki Murakami','<p data-pm-slice=\"0 0 []\">Murakami sinh ng&agrave;y 12 th&aacute;ng 1 năm 1949 tại Kyoto, nhưng lớn l&ecirc;n tại th&agrave;nh phố Nishinomiya v&agrave; th&agrave;nh phố Ashiya ở tỉnh Hyogo. &Ocirc;ng nội của &ocirc;ng l&agrave; một nh&agrave; sư &ocirc;ng ngoại của &ocirc;ng l&agrave; một thương gia ở Osaka. Bố v&agrave; mẹ &ocirc;ng đều l&agrave; gi&aacute;o vi&ecirc;n m&ocirc;n Văn học Nhật Bản.</p>\r\n<p data-pm-slice=\"0 0 []\">Từ nhỏ, Murakami đ&atilde; chịu ảnh hưởng lớn của văn h&oacute;a phương T&acirc;y, đặc biệt l&agrave; &acirc;m nhạc v&agrave; văn học. &Ocirc;ng lớn l&ecirc;n c&ugrave;ng với h&agrave;ng loạt t&aacute;c phẩm của c&aacute;c nh&agrave; văn Mỹ như Kurt Vonnegut v&agrave; Richard Brautigan, v&agrave; sự ảnh hưởng của phương T&acirc;y ch&iacute;nh l&agrave; đặc điểm gi&uacute;p mọi người ph&acirc;n biệt &ocirc;ng với những nh&agrave; văn Nhật kh&aacute;c. Văn học Nhật thường ch&uacute; trọng đến vẻ đẹp ng&ocirc;n từ, do đ&oacute; c&oacute; thể khiến cho khả năng diễn đạt bị giới hạn v&agrave; trở n&ecirc;n cứng nhắc, trong khi phong c&aacute;ch của Murakami tương đối tho&aacute;ng đạt v&agrave; uyển chuyển.</p>\r\n<p>Murakami học về nghệ thuật s&acirc;n khấu tại Đại học Waseda, Tokyo. Ở đ&oacute;, &ocirc;ng đ&atilde; gặp được Yoko, người sau n&agrave;y l&agrave; vợ &ocirc;ng. Ban đầu &ocirc;ng l&agrave;m việc trong một cửa h&agrave;ng băng đĩa, nơi m&agrave; một trong những nh&acirc;n vật ch&iacute;nh của &ocirc;ng trong t&aacute;c phẩm Rừng Na Uy, Watanabe Toru, đ&atilde; l&agrave;m việc. Một thời gian ngắn trước khi ho&agrave;n th&agrave;nh việc học, Murakami mở một tiệm c&agrave; ph&ecirc; chơi nhạc jazz c&oacute; t&ecirc;n \"Peter Cat\" tại Kokubunji, Tokyo, &ocirc;ng quản l&yacute; n&oacute; từ năm 1974 đến 1982. Nhiều tiểu thuyết của &ocirc;ng lấy bối cảnh &acirc;m nhạc v&agrave; nhan đề đề cũng n&oacute;i đến một bản nhạc n&agrave;o đ&oacute;, gồm c&oacute; Dance, Dance, Dance (của ban nhạc The Steve Miller), Rừng Na Uy (của The Beatles), v&agrave; Ph&iacute;a nam bi&ecirc;n giới, ph&iacute;a t&acirc;y mặt trời (gh&eacute;p từ nhan đề một b&agrave;i h&aacute;t South of the Border v&agrave; mượn &yacute; lại của một b&agrave;i h&aacute;t kh&aacute;c East of the Sun).</p>','1949-01-12',85,'Murakami_Haruki.jpg'),(6,'Stephen King',' Stephen Edwin King là một tác gia người mỹ. Vì danh tiếng của ông gắn liền với các tiểu thuyết kinh dị, nên ông nhận được danh xưng là \"Ông hoàng kinh dị\". Tuy nhiên, ông cũng đã thử sức với nhiều thể loại truyện khác, trong đó nổi bật nhất bao gồm giật gân, tội phạm, khoa học viễn tưởng, kỳ ảo và bí ẩn.                                                                                    ','1947-09-21',74,'Stephen_King.jpg'),(7,'Agatha Christie','<p>Agatha Christie (1890 &ndash; 1976) l&agrave; tiểu thuyết gia trinh th&aacute;m người Anh. B&agrave; được mệnh danh l&agrave; &ldquo;nữ ho&agrave;ng trinh th&aacute;m&rdquo; đ&atilde; s&aacute;ng tạo ra hai nh&acirc;n vật th&aacute;m tử nổi tiếng được h&agrave;ng triệu độc giả mến mộ: Hercule Poirot v&agrave; Miss Marple. B&agrave; sinh ra trong một gia đ&igrave;nh d&ograve;ng d&otilde;i qu&yacute; tộc v&agrave; gi&agrave;u c&oacute;. Khi c&ograve;n nhỏ, Agatha Christie kh&ocirc;ng đến trường, chỉ được học tại nh&agrave; dưới sự hướng dẫn của mẹ v&agrave; c&aacute;c c&ocirc; giữ trẻ. B&agrave; được mẹ khuyến kh&iacute;ch viết từ nhỏ. Trong Thế chiến I, Agatha l&agrave;m việc tại một nh&agrave; thuốc bệnh viện. B&agrave; đ&atilde; c&oacute; kiến thức về c&aacute;c chất độc m&agrave; sau n&agrave;y sẽ gi&uacute;p &iacute;ch rất nhiều trong c&ocirc;ng việc viết tiểu thuyết. Tiểu thuyết đầu ti&ecirc;n của Agatha Christie, The Mysterious Affair at Styles được xuất bản năm 1920 v&agrave; lần đầu ti&ecirc;n giới thiệu cho độc giả nh&acirc;n vật th&aacute;m tử nổi tiếng Hercule Poirot, người xuất hiện trong 30 tiểu thuyết v&agrave; 50 truyện ngắn kh&aacute;c của Christie. Cuốn s&aacute;ch đầu ti&ecirc;n của b&agrave; phải đợi đến 5 năm mới được ph&aacute;t h&agrave;nh v&agrave; đ&atilde; bị 6 nh&agrave; xuất bản từ chối. Nh&acirc;n vật Agatha Christie y&ecirc;u th&iacute;ch l&agrave; nữ th&aacute;m tử Marple được lấy cảm hứng từ h&igrave;nh ảnh b&agrave; ngoại của b&agrave;. B&agrave; cũng l&agrave; một tiểu thuyết gia t&igrave;nh cảm rất th&agrave;nh c&ocirc;ng. Christie đ&atilde; viết s&aacute;u tiểu thuyết l&atilde;ng mạn dưới b&uacute;t danh Mary Westmacott, bao gồm Unfinished Portrait, cuốn s&aacute;ch b&aacute;n tự truyện về một t&aacute;c giả cố gắng tự tử sau khi cuộc h&ocirc;n nh&acirc;n của c&ocirc; sụp đổ. Agatha Chritie l&agrave; nh&agrave; văn c&oacute; s&aacute;ch b&aacute;n chạy nhất mọi thời đại với hơn 2 tỷ bản đ&atilde; được ti&ecirc;u thụ tr&ecirc;n to&agrave;n thế giới. Truyện của b&agrave; đ&atilde; được dịch ra hơn 103 ng&ocirc;n ngữ khiến b&agrave; trở th&agrave;nh t&aacute;c giả c&oacute; t&aacute;c phẩm dịch ra nhiều thứ tiếng nhất.</p>','1894-09-19',180,'Agatha_Christie.jpg'),(8,'Victor Hugo','Tác giả của Những người khốn khổ                                                                                    ','1802-02-26',74,'Victor_Hugo.jpg'),(9,'Leo Tolstoy','Nhà văn Nga với Chiến tranh và hòa bình','1828-08-28',191,'Leo_Tolstoy.jpg'),(10,'George Orwell','Eric Arthur Blair (25 tháng 6 năm 1903 – 21 tháng 1 năm 1950), nổi tiếng với bút danh George Orwell, là một tác giả và phóng viên người Anh. Được biết đến như một tiểu thuyết gia, một nhà phê bình, một nhà bình luận về văn hóa, Orwell là một trong những ngòi bút tiếng Anh được hâm mộ nhất ở thế kỷ 20. Ông nổi danh nhờ 2 cuốn tiểu thuyết bài xích tính độc tài của nhà nước nói chung và chủ nghĩa Stalin nói riêng, được viết và xuất bản vào cuối đời: 1984 (Nineteen Eighty-Four) và Trại súc vật (Animal Farm)  ','1903-06-25',180,'George_Orwell.jpg'),(11,'Paulo Coelho','Tác giả của Nhà Giả Kim','1947-08-24',27,'Coelhopaulo.jpg'),(12,'Hosokawa Chieko','Bắt đầu sự nghiệp sáng tác của mình trong môi trường của Shoujo Club, một câu lạc bộ dành riêng cho những mangaka nữ, Hosokawa Chieko đã nhanh chóng chiếm được cảm tình của độc giả nhờ vào phong cách vẽ nữ tính, mềm mại cùng các câu chuyện tình cảm tinh tế.\r\n\r\nNhững tác phẩm của bà thường tập trung vào các mối quan hệ tình cảm phức tạp và sự trưởng thành của các nhân vật nữ, mang lại cho người đọc cảm giác sâu sắc và dễ đồng cảm.\r\n\r\nPhong cách nghệ thuật của bà trong những năm đầu rất đặc trưng của thể loại shoujo, với các nhân vật có đường nét thanh thoát và những câu chuyện nhẹ nhàng nhưng đầy cảm xúc.\r\n\r\nHosokawa Chieko không chỉ là một mangaka nổi bật trong thời kỳ của mình mà còn góp phần quan trọng vào sự phát triển và phổ biến của thể loại truyện tranh shoujo tại Nhật Bản.                            ','1935-01-01',85,'Hosokawa_Chieko.jpg'),(21,'Vương Hồng Sển','Vương Hồng Sển (1902 – 1996) tên thật là Vương Hồng Thạnh (hay Thịnh). Ngày 4.11.1904, khi làm giấy khai sinh, người giữ sổ lục bộ ghi nhầm thành Sển. Ông học ở trường Chasseloup, sau làm công chức, về hưu sớm để chuyên về văn nghệ. Ông thích khảo cứu về hát bội, cải lương, ký bút hiệu là Anh Vương, Vân Đường, Đạt Cổ Trai, và làm việc tại Viện bảo tàng Sài Gòn từ năm 1947 đến năm 1964.\r\n\r\n\r\nVương Hồng Sển rất sành về đồ cổ. Ông còn ưa khảo cứu về các trò chơi cổ truyền như đá dế, chọi gà, chọi cá, chơi chim, trồng kiểng, nghệ thuật chơi cổ ngoại, nghiên cứu về chuyện tiếu lâm xưa và nay. Những cuốn sách ông viết về những điều thu lượm được là nguồn thông tin độc đáo và giá trị về những thú chơi nói trên.\r\n\r\nCác tác phẩm của ông phần nhiều thuộc dạng hồi ký, bút ký. Chúng là nguồn tư liệu sống động cho thấy đời sống, suy nghĩ, văn hóa ở xã hội năm xưa. Những tư liệu mà ông thu thập và ghi chép là nguồn tài liệu lịch sử và văn hóa quý giá cho những ai muốn tìm hiểu về nhiều khía cạnh của đời sống ở miền Nam qua nhãn quan một chứng nhân thời cuộc.\r\n\r\nHọc giả Nguyễn Hiến Lê cho rằng: “Chúng ta nên cảm ơn ông đã ghi lại - mặc dầu là hấp tấp trong sự trình bày - vô số tài liệu mà trong mấy chục năm, ông đã tốn công đi sưu tầm khắp Sài Gòn, Chợ Lớn và các vùng lân cận. Về nhà cân nhắc chọn lựa với tinh thần thận trọng đáng khen...”\r\n\r\n“Nhà Nam bộ học” Sơn Nam từng nhận xét về ông rằng những gì ông viết có khi chỉ là “chuyện lụn vụn ‘tào lao’, ‘loạn xà ngầu’, nhưng với những người đến sau, nó mang một giá trị to lớn, nó chất chứa những niềm say mê và quyến rũ”.\r\n\r\nKhi qua đời, ông đã hiến tặng ngôi nhà (Vân Đường phủ) và bộ sưu tập cổ vật của mình (tổng cộng 849 món) cho Nhà nước Việt Nam. Ngày 5/8/2003, UBND TP. Hồ Chí Minh đã ban hành quyết định xếp hạng ngôi nhà là di tích cấp thành phố và là di tích kiến trúc nghệ thuật nhà cổ dân dụng truyền thống.\r\n\r\n\r\nTrong tháng 8 năm 2024, Nhà xuất bản Trẻ vừa ký hợp đồng mua tác quyền hàng loạt các tác phẩm của Vương Hồng Sển cùng đại diện gia đình tác giả. Một số tựa sách trong hợp đồng sẽ được NXB Trẻ phát hành trong tương lai bao gồm: Sài Gòn năm xưa, Sài Gòn Tả Pín Lù, Chuyện cười cổ nhân, Hơn nửa đời hư, Bên lề sách cũ, Phong lưu cũ mới, Bộ Khảo về đồ sứ men lam Huế, Thú chơi cổ ngoạn, Thú xem truyện Tàu, Tự vị tiếng nói miền Nam… và các tựa khác.','1902-09-27',185,'nxbtre_thumb_13362020_043636.jpg'),(22,'Nguyễn Ngọc Tư','<p>Nguyễn Ngọc Tư sinh năm 1976 tại Đầm Dơi, C&agrave; Mau. L&agrave; nữ nh&agrave; văn trẻ của Hội nh&agrave; văn Việt Nam. Với niềm đam m&ecirc; viết l&aacute;ch, chị miệt m&agrave;i viết như một c&aacute;ch giải tỏa v&agrave; thể nghiệm, chị biết rằng chị muốn viết về những điều gần gũi nhất xung quanh cuộc sống của m&igrave;nh. Giọng văn chị đậm chất Nam bộ, l&agrave; giọng kể mềm mại m&agrave; s&acirc;u cay về những cuộc đời &eacute;o le, những số phận ch&igrave;m nổi. C&aacute;i chất miền qu&ecirc; s&ocirc;ng nước ngấm v&agrave;o c&aacute;c t&aacute;c phẩm, thấm đẫm c&aacute;i t&igrave;nh của l&agrave;ng, của đất, của những con người ch&acirc;n chất hồn hậu nhưng &iacute;t nhiều gặp những bất hạnh.</p>\r\n<p>&Acirc;m thầm đến với văn chương v&agrave; bừng s&aacute;ng khi được nhận giải Nhất cuộc thi Văn học tuổi 20 của NXB Trẻ, Nguyễn Ngọc Tư đ&atilde; trở th&agrave;nh t&acirc;m điểm của sự hy vọng v&agrave;o một nền văn trẻ đương đại. Chị đ&atilde; tiếp tục c&oacute; những c&uacute; nhảy ngoạn mục tr&ecirc;n chặng đường văn c&ugrave;ng những t&aacute;c phẩm được giới chuy&ecirc;n m&ocirc;n đ&aacute;nh gi&aacute; cao. Tập truyện ngắn C&aacute;nh đồng bất tận của chị g&acirc;y được tiếng vang lớn, nhận được nhiều giải thưởng cũng như chuyển thể th&agrave;nh kịch, phim điện ảnh.</p>\r\n<p>C&aacute;c mốc sự kiện văn chương đ&aacute;ng nhớ:</p>\r\n<p style=\"padding-left: 40px;\">2000: Giải Nhất cuộc vận động s&aacute;ng t&aacute;c Văn học tuổi 20 lần 2 với t&aacute;c phẩm Ngọn đ&egrave;n kh&ocirc;ng tắt, giải Mai v&agrave;ng ở hạng mục Nh&agrave; văn xuất sắc.<br>2001: Giải B Hội nh&agrave; văn Việt Nam với t&aacute;c phẩm Ngọn đ&egrave;n kh&ocirc;ng tắt.<br>2003: L&agrave; một trong Mười nh&acirc;n vật trẻ xuất sắc ti&ecirc;u biểu của năm 2002.<br>2006: Giải thưởng Hội nh&agrave; văn Việt Nam năm 2006 với t&aacute;c phẩm C&aacute;nh đồng bất tận.<br>2008: Giải thưởng văn học ASEAN với t&aacute;c phẩm Ngọn đ&egrave;n kh&ocirc;ng tắt v&agrave; C&aacute;nh đồng bất tận.<br>2018: Giải thưởng LiBeraturpreis 2018 do Hiệp hội Quảng b&aacute; văn học ch&acirc;u &Aacute;, ch&acirc;u Phi, Mỹ Latin tại Đức (Litprom) b&igrave;nh chọn với t&aacute;c phẩm C&aacute;nh đồng bất tận. Chị c&ograve;n tham gia triển khai dự &aacute;n trị gi&aacute; 6.000 EU bằng c&aacute;c hoạt động tổ chức s&aacute;ng t&aacute;c d&agrave;nh cho nữ giới tại Việt Nam.<br>2019: Thuộc Top 50 người phụ nữ c&oacute; ảnh hưởng nhất tại Việt Nam 2018 do tạp ch&iacute; Forbes b&igrave;nh chọn.</p>\r\n<p>C&aacute;c t&aacute;c phẩm của Nguyễn Ngọc Tư được t&aacute;i bản nhiều lần v&agrave; được dịch ra tiếng H&agrave;n, tiếng Anh, tiếng Thụy Điển, tiếng Đức.</p>','1976-01-01',185,'nxbtre_thumb_13212019_032106.jpg'),(24,'Trang Thế Hy','Trang Thế Hy (1924-2015) tên thật là Võ Trọng Cảnh là tác giả sáng tác văn và thơ. Ngoài bút danh Trang Thế Hy ông còn có những bút danh khác như Phạm Võ, Văn Phụng Mỹ, Triều Phong, Vũ Ái, Văn Minh Phẩm... \r\n\r\nÔng tham gia hoạt động cách mạng trong hai cuộc kháng chiến chống Pháp và chống Mỹ. Sau 1975 ông sinh hoạt Văn nghệ tại TPHCM, làm biên tập viên Văn tại báo Văn nghệ TPHCM. Ông được xem là một trong những nhà văn đương đại hàng đầu của văn chương Nam bộ nửa sau thế kỷ 20 và đầu thế kỷ 21.\r\n\r\nNhà văn Trang Thế Hy từng được Giải thưởng văn học Nguyễn Đình Chiểu (1960-1965) với truyện ngắn Anh Thơm râu rồng; được tặng thưởng của Hội Nhà văn Việt Nam năm 1994 với tập truyện Tiếng khóc và tiếng hát, giải thưởng loại A của Uỷ ban toàn quốc Liên hiệp các Hội Văn học nghệ thuật Việt Nam năm 2001 với tập truyện Nợ nước mắt…\r\n\r\nGần 50 năm cầm bút, Trang Thế Hy viết không nhiều, chỉ khoảng trên dưới 50 truyện ngắn. Mỗi truyện ngắn của ông là một tuyên ngôn về cuộc sống mà độc giả tìm thấy tấm chân tình gần gũi, tha thiết mà ông dành cho cuộc đời. Những truyện ngắn gắn liền với tên tuổi Trang Thế Hy là Nắng đẹp miền quê ngoại (1964), Mưa ấm (1981), Người yêu và mùa thu (1981), Vết thương thứ 13 (1989), Tiếng khóc và tiếng hát (1993).\r\n\r\nNgoài viết văn, Trang Thế Hy còn sáng tác gần 20 bài thơ, trong đó có 13 bài in thành tập. Nhà văn Nguyên Ngọc nhận xét các bài thơ đó có thể nói là hồn cốt của ông - một người hiền của văn chương Nam bộ.','1924-10-29',185,'Trang Thế Hy.jpg'),(25,'Bảo Ninh','Bảo Ninh (sinh ngày 18 tháng 10 năm 1952) tại Nghệ An. Ông tên thật là Hoàng Ấu Phương, là nhà văn nổi tiếng với nhiều tác phẩm tạo được tiếng vang lớn, trong đó thành công nhất là Nỗi buồn chiến tranh.\r\n\r\nÔng có thời gian từng đi bộ đội từ năm 1969 đến năm 1975. Năm 1987, ông ra mắt tác phẩm đầu tiên là Trại bảy chú lùn. Năm 1991, tiểu thuyết Nỗi buồn chiến tranh của Bảo Ninh (in lần đầu năm 1987 tên là Thân phận của tình yêu), được tặng Giải thưởng Hội Nhà văn Việt Nam và đã được đón chào nồng nhiệt. \r\n\r\nCuốn sách được dịch sang tiếng Anh bởi Frank Palmos và Phan Thanh Hảo, xuất bản năm 1994 với nhan đề \"The Sorrow of War\", được ca tụng rộng rãi và một số nhà phê bình đánh giá là một trong những tiểu thuyết cảm động nhất về chiến tranh. Bản dịch này được bán rộng rãi cho du khách nước ngoài. Đây là một cuốn sách được đọc rất nhiều ở phương Tây, và là một trong số ít sách nói về chiến tranh Việt Nam được xuất bản ở đây. \r\n\r\nTác phẩm này cũng đã được chuyển ngữ và giới thiệu ở 18 quốc gia trên thế giới.Vào tháng 8 năm 2016, nhà văn Bảo Ninh với tác phẩm Nỗi buồn chiến tranh vừa được nhận giải thưởng văn học Sim Hun của Hàn Quốc.','1952-10-18',185,'Bảo Ninh.jpg'),(26,'Lý Quí Trung','Lý Quí Trung (sinh 1966 tại Sài Gòn) là một doanh nhân, nhà hoạt động xã hội, diễn giả và giảng viên đại học thỉnh giảng. Ông là thành viên sáng lập Tập đoàn Nam An Group chuyên kinh doanh trong lĩnh vực ẩm thực cao cấp, trong đó có chuỗi cửa hàng Phở 24 với hơn 70 cửa hàng trong và ngoài nước. Các thương hiệu ẩm thực nổi bật khác bao gồm Nhà hàng Nam An, Nhà hàng Tân Nam, Nhà hàng An, Nhà hàng An Viên, chuỗi café Gloria Jean\'s Coffees, chuỗi tiệm bánh Breadtalk...\r\n\r\nNăm 2013, ông cho ra mắt cuốn tự truyện với nhan đề Bầu trời không chỉ có màu xanh. Trước đó, ông cũng đã xuất bản nhiều đầu sách về nhượng quyền thương mại và xây dựng thương hiệu dành cho các doanh nghiệp vừa và nhỏ của Việt Nam. Năm 2013 ông đi định cư tại Úc. Năm 2016, ông viết cuốn \"Không chỉ có niềm đam mê - 20 điều chia sẻ cùng người khởi nghiệp\", xuất bản ở Việt Nam thông qua NXB Trẻ.\r\n\r\nÔng từng được hai trường đại học lớn của Úc phong hàm giáo sư danh dự (trường Griffith University vào năm 2009 và trường Western Sydney University năm 2016). Lý Quý Trung được biết nhiều trong lĩnh vực kinh doanh, viết sách, báo, giảng dạy, diễn thuyết, ông từng tổ chức một cuộc triển lãm tranh sơn dầu cá nhân với 22 bức tranh tại Galary An trên đường Đồng Khởi vào năm 2010\r\n\r\nLý Quí Trung còn được khán giả truyền hình biết đến nhiều trong các chương trình như: Làm thành viên Ban giám khảo chương trình truyền hình thực tế The Next Iron Chef \"Tìm kiếm Siêu đầu bếp\" từ đầu năm 2013 của đài VTV3, làm đại sứ dự án kinh doanh Hub Culture và là người chiến thắng tại cuộc đua \"Hành trình không ngừng bước tới\", làm giám khảo chương trình \"Chìa khóa thành công\" đài VTV1, chương trình \"Làm giàu không khó\" của VTV1, chương trình \"Nhịp cầu doanh nhân\" đài TH Thành phố Hồ Chí Minh, chương trình \"Trò chuyện cuối tuần\" Ban chuyên đề đài TH Thành phố Hồ Chí Minh, chương trình\"Người đương thời\" của VTV1, chương trình \"Chào ngày mới\" của HTV7, chương trình \"Khởi nghiệp\" đài THVN, làm giám khảo cuộc thi \"Tiếp thị hình ảnh Việt Nam\" của báo Tuổi trẻ TP HCM, chương trình \"Nhà lãnh đạo doanh nghiệp\" và \"Câu chuyện kinh doanh\" Kênh truyền hình FBNC,...','1966-01-01',185,'Lý Quí Trung.jpg'),(27,'Toan Ánh','<p>Nh&agrave; văn Toan &Aacute;nh (1915 &ndash; 2009), sinh tại Thị Cầu, Bắc Ninh, t&ecirc;n thật l&agrave; Nguyễn Văn To&aacute;n, l&agrave; nh&agrave; văn, nh&agrave; nghi&ecirc;n cứu văn h&oacute;a Việt Nam. &Ocirc;ng sinh ra tại Thị Cầu, Bắc Ninh, một v&ugrave;ng quan họ nổi tiếng với những lễ hội, đ&igrave;nh đ&aacute;m. Mẹ &ocirc;ng l&agrave;m nghề h&agrave;ng x&aacute;o, ng&agrave;y b&agrave; đi b&aacute;n, tối về vừa xay gạo vừa dạy chữ H&aacute;n cho &ocirc;ng. Sau, &ocirc;ng theo học với thầy Chu Kinh Phượng, l&agrave; thầy đồ nổi tiếng v&ugrave;ng Kinh Bắc. b Khi trưởng th&agrave;nh, nhờ &ocirc;ng l&agrave;m nhiều c&ocirc;ng việc kh&aacute;c nhau như thuế vụ, thanh tra, dạy học&hellip;v&agrave; hay thay đổi nơi ở, n&ecirc;n &ocirc;ng biết được nhiều v&ugrave;ng của đất nước. Đến đ&acirc;u &ocirc;ng cũng ch&uacute; t&acirc;m t&igrave;m hiểu tập qu&aacute;n, hội h&egrave;, ca dao&hellip; v&agrave; ghi ch&eacute;p một c&aacute;ch cẩn thận. Toan &Aacute;nh bắt đầu viết văn từ năm 1934. Năm 1935, truyện ngắn đầu tay của &ocirc;ng l&agrave; Chiếc nhẫn qu&yacute; được đăng tr&ecirc;n b&aacute;o Tiểu thuyết Thứ Bảy. Kể từ đ&oacute;, &ocirc;ng gắn b&oacute; mật thiết với đề t&agrave;i văn h&oacute;a truyền thống của Việt Nam từ n&ocirc;ng th&ocirc;n đến th&agrave;nh thị, từ Bắc v&agrave;o Nam, v&agrave; để lại cho đời khoảng 124 t&aacute;c phẩm c&oacute; gi&aacute; trị học thuật.</p>','1915-01-01',185,'Toan Ánh.png'),(28,'Tôn Thất Nguyễn Thiêm','<p>T&aacute;c giả T&ocirc;n Thất Nguyễn Thi&ecirc;m (1952-2024). T&ecirc;n đầy đủ l&agrave; T&ocirc;n Thất Nguyễn Khắc Thi&ecirc;m. &Ocirc;ng sang Bỉ du học năm 1970. Tốt nghiệp tiến sĩ x&atilde; hội học kinh tế, cử nh&acirc;n lịch sử văn h&oacute;a v&agrave; nh&acirc;n học tại Đại học Tổng hợp Brussels, cao học x&atilde; hội học ứng dụng tại Đại học C&ocirc;ng gi&aacute;o Louvain, cao học chuy&ecirc;n ng&agrave;nh marketing v&agrave; t&acirc;m l&yacute; ti&ecirc;u d&ugrave;ng tại Trường Thương mại Brussels. Giảng dạy tại Khoa Kinh tế Ch&iacute;nh trị X&atilde; hội của Đại học Tổng hợp Brussels. Phụ tr&aacute;ch c&aacute;c vị tr&iacute; then chốt ở nhiều c&ocirc;ng ty quản l&yacute; tư vấn quốc tế về điều nghi&ecirc;n chiến lược. &Ocirc;ng đ&atilde; đảm tr&aacute;ch nhiều chương tr&igrave;nh hợp t&aacute;c đ&agrave;o tạo thạc sĩ v&agrave; cử nh&acirc;n quản trị kinh doanh giữa Bỉ với c&aacute;c trường đại học h&agrave;ng đầu ở Việt Nam.</p>\r\n<p>Thuộc số &iacute;t t&aacute;c giả người Việt viết nhiều s&aacute;ch về kinh tế v&agrave; thương doanh xuất bản ở Việt Nam. C&aacute;c quyển s&aacute;ch m&agrave; &ocirc;ng đ&atilde; xuất bản ở NXB Trẻ:</p>\r\n<div>\r\n<ul>\r\n<li>Từ marketing đến thời trang v&agrave; phong c&aacute;ch sống</li>\r\n<li>Thương hiệu thanh danh t&ecirc;n tuổi</li>\r\n<li>Về</li>\r\n<li>Dặn với mai kia</li>\r\n<li>Cội</li>\r\n<li>Ngộ</li>\r\n<li>L&atilde;nh đạo v&agrave; nh&acirc;n đạo, dẫn đường v&agrave; mở hướng</li>\r\n<li>Nh&acirc;n văn v&agrave; kinh tế: T&igrave;nh v&agrave; tiền trong quản trị kinh doanh</li>\r\n<li>Chiến lược cơ chế con người</li>\r\n<li>Thị trường chiến lược cơ cấu</li>\r\n<li>C&aacute;i t&ocirc;i chuy&ecirc;n nghiệp</li>\r\n</ul>\r\n</div>','1952-01-01',185,'Tôn Thất Nguyễn Thiêm.jpg'),(29,'Veronica Roth','<p>Veronica Roth&nbsp;(sinh ng&agrave;y 19 th&aacute;ng 8, 1988) l&agrave; một&nbsp;tiểu thuyết gia&nbsp;v&agrave;&nbsp;người viết truyện ngắn&nbsp;người Mỹ được biết đến với loạt truyện nằm trong danh s&aacute;ch s&aacute;ch b&aacute;n chạy của&nbsp;New York Times,&nbsp;Divergent, bao gồm ba cuốn&nbsp;Divergent,&nbsp;Insurgent, v&agrave;&nbsp;Allegiant; v&agrave;&nbsp;Four: A Divergent Collection.&nbsp;Divergent&nbsp;nhận được giải Cuốn s&aacute;ch Y&ecirc;u th&iacute;ch năm 2011 v&agrave; giải S&aacute;ch Khoa học Giả tưởng cho Thiếu ni&ecirc;n hay nhất năm 2012 của&nbsp;Goodreads</p>\r\n<p>Roth sinh ra tại&nbsp;Th&agrave;nh phố New York&nbsp;v&agrave;o ng&agrave;y 19 th&aacute;ng 8, 1988 v&agrave; lớn l&ecirc;n tại&nbsp;Barrington, Illinois. Roth tốt nghiệp trường trung học Barrington High School. Sau một năm học cao đẳng tại trường cao đẳng&nbsp;Carleton College, c&ocirc; chuyển tới học tại&nbsp;Đại học Northwestern&nbsp;bởi chương tr&igrave;nh học viết l&aacute;ch s&aacute;ng tạo của ng&ocirc;i trường n&agrave;y.</p>\r\n<p>Với bộ ba tập truyện Divergent b&aacute;n được 4 triệu bản to&agrave;n cầu Veronica Roth kiếm được khoảng 25 triệu USD năm nay, tăng 8 triệu USD so với năm ngo&aacute;i. Phim chuyển thể Insurgent l&agrave; bom tấn với doanh thu ph&ograve;ng v&eacute; gần 300 triệu USD to&agrave;n cầu cũng g&oacute;p phần kh&ocirc;ng nhỏ v&agrave;o thu nhập nh&agrave; văn 37 tuổi.</p>','1988-08-19',74,'nxbtre_thumb_29152015_121538.jpg');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `Book_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Author_id` int(11) DEFAULT NULL,
  `Category_id` int(11) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `Date_added` date DEFAULT NULL,
  `Status_id` int(11) DEFAULT 1,
  PRIMARY KEY (`Book_id`),
  KEY `Author_id` (`Author_id`),
  KEY `Category_id` (`Category_id`),
  KEY `Status_id` (`Status_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`Author_id`) REFERENCES `author` (`Author_id`),
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`Category_id`) REFERENCES `category` (`Category_id`),
  CONSTRAINT `book_ibfk_3` FOREIGN KEY (`Status_id`) REFERENCES `bookstatus` (`Status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (27,141,3,9,23,'2025-02-21',1),(28,141,4,3,10,'2025-02-25',1),(29,141,2,9,10,'2025-02-25',1),(30,141,2,23,12,'2025-03-06',1),(31,141,2,2,10,'2025-03-06',1),(32,141,28,16,9,'2025-03-08',1),(34,141,3,9,9,'2025-03-08',1),(35,141,3,9,6,'2025-03-08',1),(36,141,3,9,13,'2025-03-08',1),(37,141,3,9,10,'2025-03-08',1),(38,141,3,9,9,'2025-03-08',1),(39,141,7,3,10,'2025-03-08',1),(46,169,9,16,37,'2025-03-31',1);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookdetail`
--

DROP TABLE IF EXISTS `bookdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` text NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `bookdetail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `book` (`Book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookdetail`
--

LOCK TABLES `bookdetail` WRITE;
/*!40000 ALTER TABLE `bookdetail` DISABLE KEYS */;
INSERT INTO `bookdetail` VALUES (27,'Harry Potter và Hòn Đá Phù Thủy - Tập 1','<p>Khi một l&aacute; thư được gởi đến cho cậu b&eacute; Harry Potter b&igrave;nh thường v&agrave; bất hạnh, cậu kh&aacute;m ph&aacute; ra một b&iacute; mật đ&atilde; được che giấu suốt cả một thập kỉ. Cha mẹ cậu ch&iacute;nh l&agrave; ph&ugrave; thủy v&agrave; cả hai đ&atilde; bị lời nguyền của Ch&uacute;a tể Hắc &aacute;m giết hại khi Harry mới chỉ l&agrave; một đứa trẻ, v&agrave; bằng c&aacute;ch n&agrave;o đ&oacute;, cậu đ&atilde; giữ được mạng sống của m&igrave;nh. Tho&aacute;t khỏi những người gi&aacute;m hộ Muggle kh&ocirc;ng thể chịu đựng nổi để nhập học v&agrave;o trường Hogwarts, một trường đ&agrave;o tạo ph&ugrave; thủy với những b&oacute;ng ma v&agrave; ph&eacute;p thuật, Harry t&igrave;nh cờ dấn th&acirc;n v&agrave;o một cuộc phi&ecirc;u lưu đầy gai g&oacute;c khi cậu ph&aacute;t hiện ra một con ch&oacute; ba đầu đang canh giữ một căn ph&ograve;ng tr&ecirc;n tầng ba. Rồi Harry nghe n&oacute;i đến một vi&ecirc;n đ&aacute; bị mất t&iacute;ch sở hữu những sức mạnh lạ k&igrave;, rất qu&iacute; gi&aacute;, v&ocirc; c&ugrave;ng nguy hiểm, m&agrave; cũng c&oacute; thể l&agrave; mang cả hai đặc điểm tr&ecirc;n.</p>',135000),(28,'Mật mã DaVinci','Tổng hợp các thể loại hư cấu trinh thám, giật gân và âm mưu, quyển sách là một trong bốn tiểu thuyết liên quan tới nhân vật Robert Langdon, cùng với Thiên thần và Ác quỷ (Angels and Demons), Biểu tượng thất truyền (The Lost Symbol, trước đây được biết đến với tên The Solomon Key) và Hỏa ngục (Inferno).\r\n</p>\r\nCốt truyện của tiểu thuyết kể về âm mưu của Giáo hội Công giáo nhằm che giấu sự thật về Chúa Giê-su. Truyện ám chỉ rằng Tòa thánh Roma biết rõ âm mưu này từ hai ngàn năm qua, nhưng vẫn giấu kín để giữ vững quyền lực của mình. Sau khi vừa xuất bản, cuốn tiểu thuyết đã khơi dậy mạnh mẽ sự tò mò khắp thế giới đi tìm hiểu sự thật về Sự tích Chén Thánh, và vai trò của Mary Magdalene trong lịch sử Giáo hội Công giáo.\r\n</p>\r\nMật mã Da Vinci nhận được nhiều phê bình sâu sắc. Những người ủng hộ cho rằng quyển tiểu thuyết rất sáng tạo, đầy kịch tính và làm cho người xem phải suy nghĩ. Người chỉ trích thì cho rằng quyển sách không chính xác và viết rất kém, những chỉ trích còn lên án các ẩn ý xấu của Dan Brown về Giáo hội Công giáo.',75000),(29,'Tôi thấy hoa vàng trên cỏ xanh','<p>Những c&acirc;u chuyện nhỏ xảy ra ở một ng&ocirc;i l&agrave;ng nhỏ: chuyện người, chuyện c&oacute;c, chuyện ma, chuyện c&ocirc;ng ch&uacute;a v&agrave; ho&agrave;ng tử , rồi chuyện đ&oacute;i ăn, ch&aacute;y nh&agrave;, lụt lội, Bối cảnh l&agrave; trường học, nh&agrave; trong x&oacute;m, b&atilde;i tha ma. Dẫn chuyện l&agrave; cậu b&eacute; 15 tuổi t&ecirc;n Thiều. Thiều c&oacute; ch&uacute; ruột l&agrave; ch&uacute; Đ&agrave;n, c&oacute; bạn th&acirc;n l&agrave; c&ocirc; b&eacute; Mận. Nhưng nh&acirc;n vật đ&aacute;ng y&ecirc;u nhất lại l&agrave; Tường, em trai Thiều, một cậu b&eacute; học kh&ocirc;ng giỏi. Thiều, Tường v&agrave; những đứa trẻ sống trong c&ugrave;ng một l&agrave;ng, học c&ugrave;ng một trường, c&oacute; biết bao chuyện chung. Ch&uacute;ng n&ocirc; đ&ugrave;a, c&atilde;i cọ rồi y&ecirc;u thương nhau, c&ugrave;ng lớn l&ecirc;n theo năm th&aacute;ng, trải qua bao sự kiện biến cố của cuộc đời.</p>\r\n<p>&nbsp;</p>\r\n<p>T&aacute;c giả vẫn giữ c&aacute;ch kể chuyện bằng ch&iacute;nh giọng trong s&aacute;ng hồn nhi&ecirc;n của trẻ con. 81 chương ngắn l&agrave; 81 c&acirc;u chuyện hấp dẫn với nhiều chi tiết th&uacute; vị, cảm động, c&oacute; những t&igrave;nh tiết bất ngờ, từ đ&oacute; lộ r&otilde; t&iacute;nh c&aacute;ch người. Cuốn s&aacute;ch, v&igrave; thế, c&oacute; sức &aacute;m ảnh.</p>',125000),(30,'Tiệm Sách Của Nàng','<p>Bối cảnh l&agrave; một tiệm s&aacute;ch tại th&agrave;nh phố hiện đại. Nh&acirc;n vật &ldquo;anh&rdquo; xuất hiện trong c&acirc;u chuyện t&igrave;nh cảm l&atilde;ng mạn, ở đ&oacute; c&oacute; nắng ấm &ecirc;m, c&oacute; mưa th&agrave;nh d&ograve;ng để thả thuyền giấy, những c&acirc;u thoại vu vơ chỉ hai người mới hiểu, với &ldquo;một ch&uacute;t h&acirc;n hoan, một ch&uacute;t dỗi hờn&hellip;&rdquo;</p>\r\n<p>Nhưng tr&agrave;n ngập gần 300 trang s&aacute;ch l&agrave; k&yacute; ức về tuổi trưởng th&agrave;nh ng&agrave;y ấy ở v&ugrave;ng qu&ecirc; miền Trung. Qu&aacute; khứ v&agrave; hiện tại mang m&agrave;u sắc vui buồn tr&aacute;i ngược, khiến cuốn s&aacute;ch c&oacute; một hấp dẫn kh&aacute;c biệt.</p>\r\n<p>&nbsp;Sự v&ocirc; t&igrave;nh của con người nhiều khi mang t&iacute;nh &aacute;c, nhất l&agrave; khi dưới vỏ những c&acirc;u chọc ghẹo tr&ecirc;u đ&ugrave;a dai dẳng. C&oacute; những chuyện khốc liệt, v&ocirc; tr&aacute;ch nhiệm, &iacute;ch kỷ của ch&iacute;nh người lớn đ&atilde; bắt trẻ con phải g&aacute;nh chịu. C&oacute; những đứa trẻ đ&atilde; trở n&ecirc;n ưa g&acirc;y gổ, ương bướng, bất cần khi cuộc đời ch&uacute;ng sa v&agrave;o bi thương, bất hạnh.</p>\r\n<p>&hellip;C&acirc;u chuyện chất chứa nhiều cảm x&uacute;c, đặc biệt bất ngờ qua những nỗi niềm chưa thể gửi trao của cậu thiếu ni&ecirc;n từng nổi tiếng ngang ngược v&agrave; hung h&atilde;n d&agrave;nh cho người bạn g&aacute;i cậu y&ecirc;u. Tuổi thơ bị đ&aacute;nh cắp, bị &ldquo;tra tấn tinh thần&rdquo;, cuộc sống trở n&ecirc;n bấp b&ecirc;nh, nhưng may thay, sự tử tế v&agrave; t&igrave;nh y&ecirc;u thương kỳ diệu đ&atilde; h&oacute;a giải l&ograve;ng hận kh&ocirc; cứng, cuốn tr&ocirc;i đi sự ngạo ngược, chỉ c&ograve;n lại sự mạnh mẽ với t&acirc;m hồn trong sạch, l&ograve;ng tin v&agrave;o nh&acirc;n &aacute;i v&agrave; sự bao dung dịu d&agrave;ng.</p>',225000),(31,'Ngày Xưa Có Một Chuyện Tình: Truyện Dài ','<p>NG&Agrave;Y XƯA C&Oacute; MỘT CHUYỆN T&Igrave;NH l&agrave; t&aacute;c phẩm mới tinh thứ 2 trong năm 2016 của nh&agrave; văn Nguyễn Nhật &Aacute;nh d&agrave;i hơn 300 trang, được coi l&agrave; tập tiếp theo của tập truyện Mắt biếc. C&oacute; một t&igrave;nh y&ecirc;u dữ dội, với em, của một người y&ecirc;u em hơn ch&iacute;nh bản th&acirc;n m&igrave;nh - l&agrave; anh.</p>\r\n<p>Ng&agrave;y xưa c&oacute; một chuyện t&igrave;nh c&oacute; phải l&agrave; một c&acirc;u chuyện cảm động khi người ta y&ecirc;u nhau, nỗi kh&aacute;t khao một hạnh ph&uacute;c &ecirc;m đềm ấm &aacute;p đến thế; hay đơn giản chỉ l&agrave; chuyện ba người - anh, em, v&agrave; người ấy&hellip;?</p>\r\n<p><span style=\"background-color: #ffffff;\">Bạn h&atilde;y mở s&aacute;ch ra, để chứng kiến l&agrave;n gi&oacute; t&igrave;nh y&ecirc;u chảy qua như rải nắng tr&ecirc;n khu&ocirc;n mặt m&ugrave;a đ&ocirc;ng của c&ocirc; g&aacute;i; nụ h&ocirc;n đầu ti&ecirc;n ngọt mật, c&aacute;i &ocirc;m đầu ti&ecirc;n, những giọt nước mắt v&agrave; c&aacute;i &ocirc;m xiết cuối c&ugrave;ng&hellip; rồi sẽ t&igrave;m thấy c&acirc;u trả lời, cho ri&ecirc;ng m&igrave;nh.</span></p>',77000),(32,'NHÂN VĂN VÀ KINH TẾ - TÌNH VÀ TIỀN TRONG QUẢN TRỊ KINH DOANH','<p><em>Nh&acirc;n văn v&agrave; kinh tể&nbsp;</em>l&agrave; cuốn s&aacute;ch trả lời kh&uacute;c chiết v&agrave; tường minh cho những c&acirc;u hỏi đang trở th&agrave;nh những vấn đề hết sức nổi cộm trong quản l&yacute; kinh tế vĩ m&ocirc; lẫn vi m&ocirc;:<br>+ Kinh tế m&agrave; l&agrave;m cho con người mất t&iacute;nh người v&agrave; c&otilde;i sống của con người ng&agrave;y c&agrave;ng mất đi những c&aacute;i đẹp &yacute; vị thanh tao th&igrave; l&agrave;m kinh tế rốt cuộc l&agrave; để l&agrave;m g&igrave;?!<br>+ Ph&aacute;t triển phải chăng l&agrave; bắt buộc chấp nhận mặt tr&aacute;i của kinh tế thị trường?<br>+ Mặt tr&aacute;i của kinh tế thị trường chịu tr&aacute;ch nhiệm cho tất cả những vấn đề kinh tế-x&atilde; hội?<br>Từ sự l&yacute; giải đ&oacute; m&agrave; b&agrave;n về 4 chữ T&agrave;i &ndash; Tr&iacute; &ndash; T&acirc;m &ndash; Tầm trong quản trị. V&agrave; một gợi mở suy nghĩ về Tầm cho việc xuất khẩu tr&agrave; v&agrave; c&agrave; ph&ecirc; của VN.<br>Với c&aacute;ch viết nh&igrave;n thẳng vấn đề; truy nguy&ecirc;n nh&acirc;n; đề xuất giải ph&aacute;p r&otilde; tinh thần x&acirc;y dựng, nhiều g&oacute;c nh&igrave;n, luận điểm kết hợp Đ&ocirc;ng-T&acirc;y kim cổ c&aacute;c vấn đề về quản trị kinh doanh cũng được t&aacute;c giả l&yacute; giải hấp dẫn v&agrave; th&ocirc;ng tuệ.</p>',75000),(34,'Harry Potter và Tên Tù Nhân Ngục Azkaban (Bản Đặc Biệt Có Tranh Minh Họa Màu)','<p>Harry Potter bước v&agrave;o năm học thứ 3 với mối nguy hiểm ngh&egrave;o: T&ecirc;n t&ugrave; nh&acirc;n Sirius Black vượt ngục Azkaban v&agrave; đang l&ugrave;ng kiếm cậu, Liệu cậu c&oacute; đương đầu được với kẻ được coi l&agrave; tay ch&acirc;n đắc lực của Voldermort n&agrave;y?</p>',1020000),(35,'Harry Potter Và Hội Phượng Hoàng - Tập 5 ','<p>Harry tức giận v&igrave; bị bỏ rơi ở nh&agrave; Dursley trong dịp h&egrave;, cậu ngờ rằng Ch&uacute;a tể hắc &aacute;m Voldemort đang tập hợp lực lượng, v&agrave; v&igrave; cậu c&oacute; nguy cơ bị tấn c&ocirc;ng, những người Harry lu&ocirc;n coi l&agrave; bạn đang cố che giấu tung t&iacute;ch cậu.</p>\r\n<p>Cuối c&ugrave;ng, sau khi được giải cứu, Harry kh&aacute;m ph&aacute; ra rằng gi&aacute;o sư Dumbledore đang tập hợp lại Hội Phượng Ho&agrave;ng &ndash; một đo&agrave;n qu&acirc;n b&iacute; mật đ&atilde; được th&agrave;nh lập từ những năm trước nhằm chống lại Ch&uacute;a tể Voldemort.</p>\r\n<p>Tuy nhi&ecirc;n, Bộ Ph&aacute;p thuật kh&ocirc;ng ủng hộ Hội Phượng Ho&agrave;ng, những lời bịa đặt nhanh ch&oacute;ng được đăng tải tr&ecirc;n Nhật b&aacute;o Ti&ecirc;n tri &ndash; một tờ b&aacute;o của giới ph&ugrave; thủy, Harry lo ngại rằng rất c&oacute; khả năng cậu sẽ phải g&aacute;nh v&aacute;c tr&aacute;ch nhiệm chống lại c&aacute;i &aacute;c một m&igrave;nh.</p>',385000),(36,'Harry Potter Và Phòng Chứa Bí Mật - Tập 2 ','<p>Harry khổ sở mong ng&oacute;ng cho k&igrave; nghỉ h&egrave; kinh khủng với gia đ&igrave;nh Dursley kết th&uacute;c. Nhưng một con gia tinh b&eacute; nhỏ tội nghiệp đ&atilde; cảnh b&aacute;o cho Harry biết về mối nguy hiểm chết người đang chờ cậu ở trường Hogwarts.</p>\r\n<p>Trở lại trường học, Harry nghe một tin đồn đang lan truyền về ph&ograve;ng chứa b&iacute; mật, nơi cất giữ những b&iacute; ẩn đ&aacute;ng sợ d&agrave;nh cho giới ph&ugrave; thủy c&oacute; nguồn gốc Muggle. C&oacute; kẻ n&agrave;o đ&oacute; đang ph&ugrave; ph&eacute;p l&agrave;m t&ecirc; liệt mọi người, khiến họ gần như đ&atilde; chết, v&agrave; một lời cảnh b&aacute;o kinh ho&agrave;ng được t&igrave;m thấy tr&ecirc;n bức tường. Mối nghi ngờ h&agrave;ng đầu &ndash; v&agrave; lu&ocirc;n lu&ocirc;n sai lầm &ndash; l&agrave; Harry. Nhưng một việc c&ograve;n đen tối hơn thế đ&atilde; được h&eacute; mở.</p>',170000),(38,'Những chuyện kể của Beedle Người Hát Rong','<p><em>Những chuyện kể của Beedle Người H&aacute;t Rong&nbsp;</em>gồm năm c&acirc;u chuyện thần ti&ecirc;n với những ph&eacute;p thuật lạ l&ugrave;ng độc đ&aacute;o, những t&igrave;nh huống căng thẳng hồi hộp sẽ l&agrave;m say m&ecirc; độc giả của mọi lứa tuổi. Đặc biệt sau mỗi c&acirc;u chuyện c&oacute; phần b&igrave;nh luận của gi&aacute;o sư Albus Dumbledore. Với những suy nghĩ s&acirc;u sắc &yacute; nhị v&agrave; phần h&eacute; lộ th&ocirc;ng tin về cuộc sống tại trường Hogwarts, những lời b&agrave;n của gi&aacute;o sư hy vọng sẽ được d&acirc;n Muggles v&agrave; giới ph&ugrave; thủy y&ecirc;u th&iacute;ch như nhau.</p>\r\n<p>S&aacute;ch c&oacute; nhiều minh họa đẹp, rất được y&ecirc;u th&iacute;ch trong giờ đọc s&aacute;ch trước khi ngủ ở c&aacute;c gia đ&igrave;nh ph&ugrave; thủy nhiều thế kỷ qua.</p>',150000),(39,'Đêm Yên Tĩnh','<p>V&agrave;o đầu th&aacute;ng 12 năm 1931, Poirot v&agrave; thanh tra Catchpool đang chuẩn bị cho lễ Gi&aacute;ng sinh th&igrave; Cynthia Catchpool, mẹ của thanh tra Edward Catchpool, triệu tập cả hai người đ&agrave;n &ocirc;ng đến để giải quyết một vụ &aacute;n giết người v&agrave; ngăn chặn một vụ kh&aacute;c tại thị trấn nhỏ Munby-on-Sea ở Norfolk.</p>\r\n<p>Ai đ&oacute; đ&atilde; đập v&agrave;o đầu Stanley Niven, người quản l&yacute; bưu điện được mọi người y&ecirc;u qu&yacute;, trong thời gian &ocirc;ng ta nằm viện. Vivienne Laurier, một người bạn của Cynthia, tin rằng chồng b&agrave;, Arnold, đ&atilde; tự đặt m&igrave;nh v&agrave;o nguy hiểm khi quyết t&acirc;m truy l&ugrave;ng kẻ giết Stanley, v&agrave; sự lo lắng của b&agrave; tăng cao khi Arthur chuẩn bị v&agrave;o c&ugrave;ng bệnh viện nơi Stanley bị giết. Cynthia khăng khăng rằng Poirot v&agrave; Edward phải ở lại với b&agrave; trong suốt kỳ nghỉ lễ. Kh&ocirc;ng kh&iacute; lễ hội của m&ugrave;a đ&ocirc;ng dường như đối nghịch ho&agrave;n to&agrave;n với sự căng thẳng v&agrave; những b&iacute; ẩn ẩn giấu trong ng&ocirc;i nh&agrave;.</p>\r\n<p>Một vụ giết người xảy ra, v&agrave; c&aacute;c dấu hiệu dẫn dắt Poirot v&agrave;o một m&ecirc; cung của những nghi ngờ, lời n&oacute;i dối, c&ugrave;ng những &acirc;m mưu kh&oacute; đo&aacute;n. Cả hai bắt đầu một cuộc điều tra phức tạp, cuối c&ugrave;ng đẩy t&iacute;nh mạng của họ v&agrave;o t&igrave;nh thế nguy <span style=\"background-color: #ffffff;\">hiểm.</span></p>',150000),(46,'Nhân văn và Kinh tế','<p><em>Nh&acirc;n văn v&agrave; kinh tể&nbsp;</em>l&agrave; cuốn s&aacute;ch trả lời kh&uacute;c chiết v&agrave; tường minh cho những c&acirc;u hỏi đang trở th&agrave;nh những vấn đề hết sức nổi cộm trong quản l&yacute; kinh tế vĩ m&ocirc; lẫn vi m&ocirc;:<br>+ Kinh tế m&agrave; l&agrave;m cho con người mất t&iacute;nh người v&agrave; c&otilde;i sống của con người ng&agrave;y c&agrave;ng mất đi những c&aacute;i đẹp &yacute; vị thanh tao th&igrave; l&agrave;m kinh tế rốt cuộc l&agrave; để l&agrave;m g&igrave;?!<br>+ Ph&aacute;t triển phải chăng l&agrave; bắt buộc chấp nhận mặt tr&aacute;i của kinh tế thị trường?<br>+ Mặt tr&aacute;i của kinh tế thị trường chịu tr&aacute;ch nhiệm cho tất cả những vấn đề kinh tế-x&atilde; hội?<br>Từ sự l&yacute; giải đ&oacute; m&agrave; b&agrave;n về 4 chữ T&agrave;i &ndash; Tr&iacute; &ndash; T&acirc;m &ndash; Tầm trong quản trị. V&agrave; một gợi mở suy nghĩ về Tầm cho việc xuất khẩu tr&agrave; v&agrave; c&agrave; ph&ecirc; của VN.<br>Với c&aacute;ch viết nh&igrave;n thẳng vấn đề; truy nguy&ecirc;n nh&acirc;n; đề xuất giải ph&aacute;p r&otilde; tinh thần x&acirc;y dựng, nhiều g&oacute;c nh&igrave;n, luận điểm kết hợp Đ&ocirc;ng-T&acirc;y kim cổ c&aacute;c vấn đề về quản trị kinh doanh cũng được t&aacute;c giả l&yacute; giải hấp dẫn v&agrave; th&ocirc;ng tuệ.</p>',45000);
/*!40000 ALTER TABLE `bookdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookimages`
--

DROP TABLE IF EXISTS `bookimages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookimages` (
  `Image_id` int(11) NOT NULL AUTO_INCREMENT,
  `Book_id` int(11) DEFAULT NULL,
  `Image_URL` varchar(255) DEFAULT NULL,
  `Uploaded_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Image_id`),
  KEY `Book_id` (`Book_id`),
  CONSTRAINT `bookimages_ibfk_1` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookimages`
--

LOCK TABLES `bookimages` WRITE;
/*!40000 ALTER TABLE `bookimages` DISABLE KEYS */;
INSERT INTO `bookimages` VALUES (32,27,'book_67b8ab0f042a47.32445156.jpeg','2025-02-21 16:34:23'),(34,28,'mat_ma_da_vinci.jpg','2025-02-25 11:38:38'),(35,29,'toi_thay_hoa_vang_tren_co_xanh.webp','2025-02-25 11:40:05'),(36,29,'book_67bdac1be5b4d4.09271147.webp','2025-02-25 11:40:11'),(39,30,'book_67c95671571767.25648653.jpg','2025-03-06 08:01:53'),(40,31,'Ngày Xưa Có Một Chuyện Tình_ Truyện Dài.jpg','2025-03-06 08:10:16'),(43,34,'copy_1_nxbtre_thumb_06462018_034636.jpg','2025-03-08 07:17:23'),(44,35,'nxbtre_full_28042023_110430.jpg','2025-03-08 07:18:07'),(45,36,'nxbtre_full_12352022_113505.jpg','2025-03-08 07:20:56'),(47,38,'nxbtre_full_10462019_044611.jpg','2025-03-08 07:23:16'),(48,39,'nxbtre_full_10522025_085251.jpg','2025-03-08 07:27:57'),(65,32,'book_6801159a7838e8.97423371.jpg','2025-04-17 14:52:10'),(66,46,'book_680115b8c212c5.14640129.jpg','2025-04-17 14:52:40');
/*!40000 ALTER TABLE `bookimages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookstatus`
--

DROP TABLE IF EXISTS `bookstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookstatus` (
  `Status_id` int(11) NOT NULL AUTO_INCREMENT,
  `Status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookstatus`
--

LOCK TABLES `bookstatus` WRITE;
/*!40000 ALTER TABLE `bookstatus` DISABLE KEYS */;
INSERT INTO `bookstatus` VALUES (1,'Còn hàng'),(2,'Hết hàng'),(3,'Ngừng kinh doanh'),(4,'Đang cập nhật'),(5,'Ẩn');
/*!40000 ALTER TABLE `bookstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `Cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) DEFAULT NULL,
  `Book_id` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Cart_id`),
  KEY `User_id` (`User_id`),
  KEY `Book_id` (`Book_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (10,14,46,1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `Category_id` int(11) NOT NULL AUTO_INCREMENT,
  `Category_name` varchar(255) DEFAULT NULL,
  `Category_type` varchar(255) NOT NULL,
  PRIMARY KEY (`Category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Khác','khac'),(2,'Tiểu thuyết','tieu_thuyet'),(3,'Trinh thám','trinh_tham'),(4,'Kinh dị','kinh_di'),(5,'Triết học','triet_hoc'),(6,'Khoa học viễn tưởng','khoa_hoc_vien_tuong'),(7,'Lịch sử','lich_su'),(8,'Tâm lý học','tam_ly_hoc'),(9,'Thiếu nhi','thieu_nhi'),(10,'Giáo dục','giao_duc'),(11,'Văn học cổ điển','van_hoc_co_dien'),(12,'Thơ ca','tho_ca'),(13,'Tùy bút tản văn','tuy_but_tan_van'),(14,'Phiêu lưu','phieu_luu'),(15,'Tôn giáo tâm linh','ton_giao_tam_linh'),(16,'Kinh tế','kinh_te'),(17,'Chính trị','chinh_tri'),(18,'Công nghệ','cong_nghe'),(19,'Y học','y_hoc'),(20,'Nghệ thuật','nghe_thuat'),(21,'Du lịch','du_lich'),(22,'Văn học kỳ ảo','van_hoc_ky_ao'),(23,'Văn học','van_hoc');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan'),(2,'Ai Cập'),(3,'Albania'),(4,'Algeria'),(5,'Ấn Độ'),(6,'Andorra'),(7,'Angola'),(8,'Antigua và Barbuda'),(9,'Argentina'),(10,'Armenia'),(11,'Áo'),(12,'Azerbaijan'),(14,'Bahamas'),(15,'Bahrain'),(16,'Bangladesh'),(17,'Barbados'),(18,'Belarus'),(19,'Bỉ'),(20,'Belize'),(21,'Benin'),(22,'Bhutan'),(23,'Bolivia'),(24,'Bosna và Herzegovina'),(25,'Botswana'),(26,'Bồ Đào Nha'),(27,'Brazil'),(28,'Brunei'),(29,'Bulgaria'),(30,'Burkina Faso'),(31,'Burundi'),(32,'Cabo Verde'),(33,'Campuchia'),(34,'Cameroon'),(35,'Canada'),(36,'Chad'),(37,'Chile'),(38,'Colombia'),(39,'Comoros'),(40,'Cộng hòa Congo'),(41,'Costa Rica'),(42,'Cộng hòa Dominica'),(43,'Cộng hòa Séc'),(44,'Cộng hòa Trung Phi'),(45,'Cộng hòa Dân chủ Congo'),(46,'Cuba'),(47,'Đan Mạch'),(48,'Đức'),(49,'Djibouti'),(50,'Dominica'),(51,'Ecuador'),(52,'El Salvador'),(53,'Eritrea'),(54,'Estonia'),(55,'Eswatini'),(56,'Ethiopia'),(57,'Fiji'),(58,'Phần Lan'),(59,'Pháp'),(60,'Gabon'),(61,'Gambia'),(62,'Georgia'),(63,'Ghana'),(64,'Grenada'),(65,'Guatemala'),(66,'Guinea'),(67,'Guinea Xích đạo'),(68,'Guinea-Bissau'),(69,'Guyana'),(70,'Hà Lan'),(71,'Hàn Quốc'),(72,'Haiti'),(73,'Honduras'),(74,'Hoa Kỳ'),(75,'Hungary'),(76,'Hy Lạp'),(77,'Iceland'),(78,'Indonesia'),(79,'Iran'),(80,'Iraq'),(81,'Ireland'),(82,'Israel'),(83,'Ý'),(84,'Jamaica'),(85,'Nhật Bản'),(86,'Jordan'),(87,'Kazakhstan'),(88,'Kenya'),(89,'Kiribati'),(90,'Kosovo'),(91,'Kuwait'),(92,'Kyrgyzstan'),(93,'Lào'),(94,'Latvia'),(95,'Lebanon'),(96,'Lesotho'),(97,'Liberia'),(98,'Libya'),(99,'Liechtenstein'),(100,'Lithuania'),(101,'Luxembourg'),(102,'Madagascar'),(103,'Malawi'),(104,'Malaysia'),(105,'Maldives'),(106,'Mali'),(107,'Malta'),(108,'Quần đảo Marshall'),(109,'Mauritania'),(110,'Mauritius'),(111,'Mexico'),(112,'Liên bang Micronesia'),(113,'Moldova'),(114,'Monaco'),(115,'Mông Cổ'),(116,'Montenegro'),(117,'Ma-rốc'),(118,'Mozambique'),(119,'Myanmar'),(120,'Bắc Macedonia'),(121,'Nam Phi'),(122,'Nam Sudan'),(123,'Namibia'),(124,'Nauru'),(125,'Nepal'),(126,'New Zealand'),(127,'Nicaragua'),(128,'Niger'),(129,'Nigeria'),(130,'Niue'),(131,'Na Uy'),(132,'Oman'),(133,'Pakistan'),(134,'Palau'),(135,'Nhà nước Palestine'),(136,'Panama'),(137,'Papua New Guinea'),(138,'Paraguay'),(139,'Peru'),(140,'Philippines'),(141,'Qatar'),(142,'Romania'),(143,'Rwanda'),(144,'Saint Kitts và Nevis'),(145,'Saint Lucia'),(146,'Saint Vincent và Grenadines'),(147,'Samoa'),(148,'San Marino'),(149,'Sao Tome và Principe'),(150,'Ả Rập Xê Út'),(151,'Senegal'),(152,'Serbia'),(153,'Seychelles'),(154,'Sierra Leone'),(155,'Singapore'),(156,'Slovakia'),(157,'Slovenia'),(158,'Quần đảo Solomon'),(159,'Somalia'),(160,'Sri Lanka'),(161,'Sudan'),(162,'Suriname'),(163,'Syria'),(164,'Tajikistan'),(165,'Tanzania'),(166,'Tây Ban Nha'),(167,'Thái Lan'),(168,'Thổ Nhĩ Kỳ'),(169,'Thụy Điển'),(170,'Thụy Sĩ'),(171,'Timor-Leste'),(172,'Togo'),(173,'Tonga'),(174,'Trung Quốc'),(175,'Tunisia'),(176,'Turkmenistan'),(177,'Tuvalu'),(178,'Ukraina'),(179,'Các Tiểu vương quốc Ả Rập Thống nhất'),(180,'Vương quốc Anh'),(181,'Uruguay'),(182,'Uzbekistan'),(183,'Thành Vatican'),(184,'Venezuela'),(185,'Việt Nam'),(186,'Yemen'),(187,'Zambia'),(188,'Zimbabwe'),(189,'Andorra'),(190,'Marshall Islands'),(191,'Nga'),(192,'Tuvalu'),(193,'Vanuatu'),(194,'São Tomé và Príncipe'),(195,'Bhutan'),(196,'Không xác định');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourite`
--

DROP TABLE IF EXISTS `favourite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `User_id` (`User_id`),
  KEY `Book_id` (`Book_id`),
  CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`),
  CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourite`
--

LOCK TABLES `favourite` WRITE;
/*!40000 ALTER TABLE `favourite` DISABLE KEYS */;
INSERT INTO `favourite` VALUES (10,142,30),(11,142,27),(12,142,29),(14,141,34),(16,14,38),(21,14,35),(22,14,27),(24,169,32),(25,169,29);
/*!40000 ALTER TABLE `favourite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `new_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `image_1` text NOT NULL,
  `image_2` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`new_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`User_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (8,14,'Nhà văn Nguyễn Ngọc Tư: ‘Tôi tiếc những độc giả bỏ mình đi’','Vanvn- Nguyễn Ngọc Tư – tác giả của “Cánh đồng bất tận” – tiếc khi nhiều người không thích chị đổi mới lối viết, nhưng xem đó là cách tôn trọng bạn đọc.','<p>Đầu th&aacute;ng 3, nh&agrave; văn ra mắt tập tản văn&nbsp;<em>Tiếng gọi ch&acirc;n trời</em>, kể từ tập truyện&nbsp;<em>Tr&ocirc;i</em>&nbsp;(2023). Dịp n&agrave;y, chị n&oacute;i về cảm hứng v&agrave; quan điểm s&aacute;ng t&aacute;c.</p>\r\n<p>*&nbsp;<em>Từ &yacute; tưởng v&agrave; nguồn cảm hứng n&agrave;o chị ra mắt tập tản văn mới &ndash; &ldquo;Tiếng gọi ch&acirc;n trời&rdquo;?</em></p>\r\n<p>&ndash; C&oacute; thể từ ch&iacute;nh m&igrave;nh, từ c&aacute;i sự kh&ocirc;ng y&ecirc;n, kh&ocirc;ng đủ, cảm thấy m&igrave;nh chật chội, kh&ocirc;ng mấy tự do. Chủ đề n&agrave;y lu&ocirc;n hiện diện trong hầu hết t&aacute;c phẩm của t&ocirc;i, chỉ l&agrave; viết ho&agrave;i chưa hết. T&ocirc;i thấy con người nhỏ b&eacute; lắm, trước thi&ecirc;n nhi&ecirc;n. N&ecirc;n họ cũng biến đổi nếu tự nhi&ecirc;n biến đổi. Kh&ocirc;ng l&yacute; g&igrave; t&ocirc;i kh&ocirc;ng nh&igrave;n v&agrave;o những thứ đ&oacute; để viết, khai th&aacute;c. Nhất l&agrave; t&ocirc;i th&iacute;ch mọi thứ ở ngo&agrave;i kia, c&acirc;y cỏ, s&ocirc;ng hồ, mưa nắng.</p>\r\n<p>*&nbsp;<em>V&igrave; sao chủ đề về những vấn đề mang t&iacute;nh to&agrave;n cầu như &ocirc; nhiễm m&ocirc;i trường, biến đổi kh&iacute; hậu, thường trở đi trở lại trong trang viết của chị?</em></p>\r\n<p>&ndash; Với người viết chuy&ecirc;n nghiệp, bất cứ g&igrave; tr&ecirc;n đời n&agrave;y đều đ&aacute;ng để học hỏi. C&aacute;ch một c&aacute;i c&acirc;y thay l&aacute;, nếu để t&acirc;m v&agrave;o cũng l&agrave; một b&agrave;i học cho văn chương. L&uacute;c viết, t&ocirc;i kh&ocirc;ng quan t&acirc;m đ&acirc;y l&agrave; miền n&agrave;o, người xứ n&agrave;o. T&ocirc;i chỉ nh&igrave;n v&agrave;o th&acirc;n phận con người. Trước những biến động của x&atilde; hội v&agrave; tự nhi&ecirc;n, người ở đ&acirc;u cũng giống nhau. Nhưng t&ocirc;i sẽ c&acirc;n nhắc l&aacute;t cắt mới, kh&ocirc;ng n&ecirc;n nhai đi nhai lại m&atilde;i một đề t&agrave;i.</p>\r\n<p><em>*</em>&nbsp;<em>Một số truyện, c&aacute;c nh&acirc;n vật của chị đều ở trạng th&aacute;i tr&ocirc;i nổi, mơ m&agrave;ng v&agrave; v&ocirc; định. Điều n&agrave;y phản &aacute;nh t&acirc;m trạng v&agrave; cảm x&uacute;c của chị thế n&agrave;o trong qu&aacute; tr&igrave;nh s&aacute;ng t&aacute;c?</em></p>\r\n<p>&ndash; T&ocirc;i s&aacute;ng t&aacute;c bằng l&yacute; tr&iacute;, lu&ocirc;n tr&aacute;nh việc phơi b&agrave;y m&igrave;nh ra t&aacute;c phẩm. Nhưng nếu độc giả đọc vị t&ocirc;i l&agrave; anh A chị B trong đ&oacute; cũng kh&ocirc;ng sai. T&ocirc;i tin những cảm gi&aacute;c ti&ecirc;u cực ấy lu&ocirc;n xảy ra với bất cứ ai, v&agrave;o v&agrave;i thời điểm n&agrave;o đ&oacute; trong cuộc đời. Ph&acirc;n t&iacute;ch v&agrave; phơi b&agrave;y n&oacute; cũng l&agrave; một đề t&agrave;i hấp dẫn của văn chương.</p>\r\n<p><em>*</em><em>&nbsp;Phản hồi từ độc giả ảnh hưởng đến t&acirc;m thế s&aacute;ng t&aacute;c của chị ra sao?</em></p>\r\n<p>&ndash; T&ocirc;i kh&ocirc;ng d&ugrave;ng mạng x&atilde; hội, n&ecirc;n chỉ c&ograve;n c&aacute;ch nh&igrave;n v&agrave;o số lượng s&aacute;ch b&aacute;n được (cười). C&aacute;ch viết của t&ocirc;i c&agrave;ng kh&oacute; nắm bắt, tạo khoảng c&aacute;ch với hiện thực th&igrave; s&aacute;ch c&agrave;ng ế dần đều. L&uacute;c đ&oacute;, t&ocirc;i chỉ nghĩ: Phải t&igrave;m c&aacute;ch kh&aacute;c, đ&acirc;u thể kiếm sống bằng nghề viết được nữa.</p>\r\n<p>Ngo&agrave;i ra, t&ocirc;i kh&ocirc;ng thực sự muốn biết độc giả muốn đọc điều g&igrave; lắm, kh&aacute;c n&agrave;o đẽo c&agrave;y giữa đường, cứ gọt giũa theo &yacute; của người qua kẻ lại. Chi bằng d&agrave;nh thời gian ấy m&agrave; học hỏi, trải nghiệm, viết như m&igrave;nh muốn. Từ đ&oacute;, người đọc sẽ t&igrave;m thấy kiểu văn chương th&iacute;ch hợp. Với t&ocirc;i, nh&agrave; văn n&ecirc;n để bạn đọc chọn m&igrave;nh, chứ kh&ocirc;ng n&ecirc;n đi chọn độc giả.</p>\r\n<p><em>*</em><em>&nbsp;Chị nghĩ g&igrave; khi thử nghiệm thể loại mới nhưng kh&ocirc;ng được độc giả đ&oacute;n nhận?</em></p>\r\n<p>&ndash; T&ocirc;i cũng tiếc nuối khi mất đi lượng lớn độc giả từng y&ecirc;u mến m&igrave;nh. Sự ủng hộ của họ trong những ng&agrave;y đầu s&aacute;ng t&aacute;c c&ograve;n non nớt, vụng về đ&atilde; đỡ đần t&ocirc;i rất nhiều, gi&uacute;p t&ocirc;i sống được bằng nghề viết. Nhưng t&ocirc;i nghĩ việc kh&ocirc;ng ngừng đổi mới, thay v&igrave; chỉ khai th&aacute;c những đề t&agrave;i quen thuộc, mới l&agrave; c&aacute;ch t&ocirc;n trọng độc giả.</p>','<figure id=\"attachment_96038\" aria-describedby=\"caption-attachment-96038\">\r\n<figcaption id=\"caption-attachment-96038\"><em>B&igrave;a &ldquo;Tiếng gọi ch&acirc;n trời&rdquo; &ndash; tập tản văn mới nhất của Nguyễn Ngọc Tư. Ảnh: NXB Trẻ</em></figcaption>\r\n</figure>\r\n<p><em>*</em><em>&nbsp;V&igrave; sao chị &iacute;t khi ra mắt tiểu thuyết</em>?</p>\r\n<p>&ndash; Khi nghĩ về tiểu thuyết, t&ocirc;i lại nghĩ về thời gian. Nếu thời gian của t&ocirc;i vẫn bị cắt vụn, hoặc phải dừng việc ngồi v&agrave;o b&agrave;n viết cả qu&atilde;ng d&agrave;i bởi một biến động bất ngờ n&agrave;o đ&oacute;, như trước giờ t&ocirc;i vẫn gặp, th&igrave; nu&ocirc;i nấng một tiểu thuyết thật kh&oacute;.</p>\r\n<p>*&nbsp;<em>Chủ đề thời sự được văn giới b&agrave;n luận gần đ&acirc;y l&agrave; sự ph&aacute;t triển của tr&iacute; tuệ nh&acirc;n tạo (AI). Chị quan t&acirc;m điều g&igrave; về n&oacute;</em>?</p>\r\n<p>&ndash; T&ocirc;i chỉ lo mỗi chuyện kh&ocirc;ng biết c&ocirc;ng nghệ n&agrave;y c&oacute; &ldquo;cướp&rdquo; c&ocirc;ng việc của con m&igrave;nh kh&ocirc;ng. Sau n&agrave;y tụi nhỏ sẽ kiếm sống thế n&agrave;o nếu bị ảnh hưởng. C&ograve;n việc sống v&agrave; viết của t&ocirc;i coi bộ chẳng li&ecirc;n quan AI mấy, nếu c&oacute; cũng ở tương lai. M&agrave; t&ocirc;i chắc g&igrave; đ&atilde; c&oacute; mặt ở đấy.</p>\r\n<p>*&nbsp;<em>Chị động vi&ecirc;n con trai Cao Khải An thế n&agrave;o khi cậu b&eacute; tham gia con đường viết l&aacute;ch</em>?</p>\r\n<p>&ndash; T&ocirc;i kh&ocirc;ng khuyến kh&iacute;ch, cũng kh&ocirc;ng ngăn cản. T&ocirc;i chỉ gi&uacute;p con mỗi một việc, ấy l&agrave; c&oacute; một tủ s&aacute;ch trong nh&agrave;. C&ograve;n việc s&aacute;ng t&aacute;c phải xuất ph&aacute;t từ nhu cầu của con, con vui th&igrave; viết, kh&ocirc;ng vui th&igrave; dừng, kh&ocirc;ng vấn đề g&igrave;. Văn chương rất qu&yacute; gi&aacute;, nhưng tự do c&ograve;n qu&yacute; hơn.</p>\r\n<p>Nh&agrave; văn Nguyễn Ngọc Tư, 49 tuổi, sinh sống v&agrave; l&agrave;m việc tại C&agrave; Mau. C&ocirc; l&agrave; t&aacute;c giả của nhiều t&aacute;c phẩm nổi tiếng như&nbsp;<em>Đảo, Kh&oacute;i trời lộng lẫy, Gi&oacute; lẻ, Kh&ocirc;ng ai qua s&ocirc;ng, H&agrave;nh l&yacute; hư v&ocirc;</em>. Gần đ&acirc;y, chị được trao giải Văn học Đ&ocirc;ng Nam &Aacute; xuất sắc tại giải thưởng của tạp ch&iacute; Điền Tr&igrave;, tỉnh V&acirc;n Nam (Trung Quốc) cho c&aacute;c truyện ngắn của m&igrave;nh.</p>\r\n<p>Cuốn&nbsp;<em>C&aacute;nh đồng bất tận</em>&nbsp;của Nguyễn Ngọc Tư b&aacute;n tr&ecirc;n 150 ngh&igrave;n bản. T&aacute;c phẩm chuyển thể điện ảnh năm 2010, do Nguyễn Phan Quang B&igrave;nh đạo diễn. S&aacute;ch được gi&aacute;o sư Gunter Giesenfeld, nh&agrave; gi&aacute;o Marianne Ngo chuyển ngữ sang tiếng Đức. Năm 2017, bản dịch dẫn đầu bầu chọn của Litprom tại sự kiện&nbsp;<em>S&aacute;ch hay m&ugrave;a đ&ocirc;ng lần thứ 37</em>&nbsp;(Đức). Năm 2022, truyện ngắn&nbsp;<em>Tro t&agrave;n rực rỡ</em>&nbsp;v&agrave;&nbsp;<em>Củi mục tr&ocirc;i về</em>&nbsp;được đạo diễn B&ugrave;i Thạc Chuy&ecirc;n lấy cảm hứng, chuyển thể th&agrave;nh phim điện ảnh&nbsp;<em>Tro t&agrave;n rực rỡ</em>.</p>','2025-03-29',1,'nxbtre_full_26342025_093403.jpg','nguyen-ngoc-tu-sach-vanvn.jpg','nha_van_nguyen_ngoc_tu_toi_tiec_nhung_doc_gia_bo_minh_di'),(11,169,'HỘI SÁCH MỪNG SINH NHẬT NHÀ XUẤT BẢN TRẺ','Hội sách diễn ra từ ngày 20/3 đến 26/3 lúc 8g-20g, từ cửa hàng 157 Lý Chính Thắng đến sân NXB Trẻ 161B Lý Chính Thắng.','<p>Hẹn bạn ng&agrave;y 20.3 - 26.3, tại trụ sở Nh&agrave; xuất bản Trẻ nh&eacute;! Th&aacute;ng Ba s&aacute;ch Trẻ l&agrave; đợt tung s&aacute;ch lớn nhất trong năm của NXB, c&aacute;c tựa s&aacute;ch đủ mọi thể loại v&agrave; truyện tranh \"n&oacute;ng\" nhất hứa hẹn một bữa tiệc phong ph&uacute; cho người y&ecirc;u s&aacute;ch!</p>\r\n<p>Địa điểm: Hội s&aacute;ch k&eacute;o d&agrave;i từ cửa h&agrave;ng 157 L&yacute; Ch&iacute;nh Thắng đến s&acirc;n NXB Trẻ 161B L&yacute; Ch&iacute;nh Thắng. Mỗi nơi t&iacute;nh tiền ri&ecirc;ng, &aacute;p dụng khuyến m&atilde;i như nhau.</p>\r\n<p>Thời gian: 8g - 20g mỗi ng&agrave;y, từ 20 - 26/3/2025</p>\r\n<p>Hướng dẫn gửi xe: Gửi ngay tại vỉa h&egrave; trước Hội s&aacute;ch hoặc theo hướng dẫn của bảo vệ.</p>\r\n<p><strong>H&agrave;ng ng&agrave;n cuốn s&aacute;ch mới - Khuyến m&atilde;i hấp dẫn - Qu&agrave; tặng xinh xắn&nbsp;</strong></p>\r\n<p>Tận tay lựa chọn những tựa s&aacute;ch mới nhất của NXB Trẻ v&agrave; tận hưởng những ưu đ&atilde;i hấp dẫn:<br>- Ưu đ&atilde;i l&ecirc;n đến 30% cho s&aacute;ch chữ<br>- Ưu đ&atilde;i 10% v&agrave; nhiều qu&agrave; tặng hấp dẫn cho truyện tranh<br>- Quầy s&aacute;ch cũ ưu đ&atilde;i l&ecirc;n đến 60%</p>\r\n<p>+ S&aacute;ch mới của Nguyễn Văn Hầu, L&ecirc; Văn Nghĩa, Nguyễn Ngọc Tư, Nguyễn Đ&igrave;nh Đầu, Đặng Ngọc Hưng, Vương Hồng Sển...</p>\r\n<p>+ Bộ Văn học kinh điển</p>\r\n<p>+ Trọn bộ s&aacute;ch Nguyễn Nhật &Aacute;nh</p>\r\n<p>+ Top s&aacute;ch khoa học kh&aacute;m ph&aacute;, khoa học h&agrave;nh vi, c&ocirc;ng nghệ, chuyển đổi số</p>\r\n<p>+ Hai tựa mới nhất của Agatha Christie v&agrave; trọn bộ s&aacute;ch trinh th&aacute;m</p>\r\n<p>+ S&aacute;ch kinh tế ch&iacute;nh trị hot: H&agrave;nh lang hẹp, tại sao c&aacute;c quốc gia thất bại, Lịch sử b&igrave;nh đẳng,...</p>\r\n<p>+ Loạt s&aacute;ch t&acirc;m l&yacute; học - sức khỏe - dinh dưỡng</p>\r\n<p>... V&agrave; những bộ truyện tranh mới nhất!</p>\r\n<p>Khu vực s&aacute;ch cũ cho người sưu tầm, giới thiệu c&aacute;c bộ s&aacute;ch đ&atilde; tuyệt bản với gi&aacute; hấp dẫn.</p>','','2025-04-12',1,'nxbtre_full_18032025_090336.jpg','','hoi_sach_mung_sinh_nhat_nha_xuat_ban_tre');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `Order_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) DEFAULT NULL,
  `Full_Name` varchar(255) DEFAULT NULL,
  `Phone_Number` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` int(11) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `Status` int(1) DEFAULT 1,
  `PaymentMethod_id` int(11) DEFAULT NULL,
  `Sum` decimal(10,2) DEFAULT NULL,
  `Order_date` date DEFAULT NULL,
  `Item_code` varchar(20) NOT NULL,
  `Payment_Status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Order_id`),
  KEY `FK_Order_Status` (`Status`),
  KEY `FK_PaymentMethod` (`PaymentMethod_id`),
  KEY `fk_user_id` (`User_id`),
  KEY `fk_order_userlocation` (`Address`),
  CONSTRAINT `FK_Order_Status` FOREIGN KEY (`Status`) REFERENCES `orderstatus` (`Status_id`),
  CONSTRAINT `FK_PaymentMethod` FOREIGN KEY (`PaymentMethod_id`) REFERENCES `paymentmethods` (`PaymentMethod_id`),
  CONSTRAINT `fk_order_userlocation` FOREIGN KEY (`Address`) REFERENCES `userlocation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (16,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',4,3,45000.00,'2025-04-11','ORDER_67f8cdb58d292',1),(17,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',2,4,75000.00,'2025-04-12','ORDER_67fa0749c9a50',0),(18,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',4,3,45000.00,'2025-04-12','ORDER_67fa076a65c2c',1),(19,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',8,3,780000.00,'2025-04-12','ORDER_67fa3ce2274ec',0),(20,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',1,4,225000.00,'2025-04-14','ORDER_67fcb296a561c',0),(21,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',8,3,45000.00,'2025-04-14','ORDER_67fcb2da0c23a',0),(22,170,'Khang','0967890410','khang@gmail.com',35,'',8,3,300000.00,'2025-04-14','ORDER_67fcc484e7133',0),(23,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',8,3,75000.00,'2025-04-14','ORDER_67fccb4ba350c',0),(24,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',1,3,170000.00,'2025-04-19','ORDER_68034a1eb1eec',0),(25,169,'Quách Công T','0796543210','quachcongt@example.com',33,'',1,3,45000.00,'2025-04-19','ORDER_68034a1eb2cf1',0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetail`
--

DROP TABLE IF EXISTS `orderdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetail` (
  `OrderDetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `Order_id` int(11) DEFAULT NULL,
  `Book_id` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`OrderDetail_id`),
  KEY `Order_id` (`Order_id`),
  KEY `Book_id` (`Book_id`),
  CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `order` (`Order_id`),
  CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetail`
--

LOCK TABLES `orderdetail` WRITE;
/*!40000 ALTER TABLE `orderdetail` DISABLE KEYS */;
INSERT INTO `orderdetail` VALUES (22,16,46,1,45000.00),(23,17,32,1,75000.00),(24,18,46,1,45000.00),(25,19,32,1,75000.00),(26,19,35,1,385000.00),(27,19,36,1,170000.00),(28,19,38,1,150000.00),(29,20,32,1,75000.00),(30,20,38,1,150000.00),(31,21,46,1,45000.00),(32,22,32,4,75000.00),(33,23,32,1,75000.00),(34,24,36,1,170000.00),(35,25,46,1,45000.00);
/*!40000 ALTER TABLE `orderdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderstatus`
--

DROP TABLE IF EXISTS `orderstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderstatus` (
  `Status_id` int(11) NOT NULL,
  `Status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderstatus`
--

LOCK TABLES `orderstatus` WRITE;
/*!40000 ALTER TABLE `orderstatus` DISABLE KEYS */;
INSERT INTO `orderstatus` VALUES (1,'Đang chờ xác nhận'),(2,'Đang chuẩn bị'),(3,'Đang vận chuyển'),(4,'Đã giao hàng'),(7,'Vận chuyển thất bại'),(8,'Đơn hàng bị hủy');
/*!40000 ALTER TABLE `orderstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentmethods`
--

DROP TABLE IF EXISTS `paymentmethods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymentmethods` (
  `PaymentMethod_id` int(11) NOT NULL,
  `PaymentMethod_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PaymentMethod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentmethods`
--

LOCK TABLES `paymentmethods` WRITE;
/*!40000 ALTER TABLE `paymentmethods` DISABLE KEYS */;
INSERT INTO `paymentmethods` VALUES (3,'Thanh toán khi nhận hàng'),(4,'Momo'),(5,'ZaloPay'),(6,'Chuyển khoản ngân hàng');
/*!40000 ALTER TABLE `paymentmethods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `Role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (0,'Khách Hàng'),(1,'Người Bán Sách'),(2,'Quản Trị Viên');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `Full_Name` varchar(100) DEFAULT NULL,
  `Phone_Number` varchar(10) DEFAULT NULL,
  `Pass_Word` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Role_id` int(11) DEFAULT 0,
  `Status` int(11) DEFAULT 1,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Role_id` (`Role_id`),
  KEY `user_ibfk_2` (`Status`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`Role_id`) REFERENCES `role` (`Role_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `userstatus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (14,'Cao Hoàng Khải','0834477131','$2y$10$PiZKzfrYerZr6vXpzzPLru02sPa14wI0oVdG1SlsyH5W7Bb5EMt6W','hoangcao230703@gmail.com',2,1),(130,'Bùi Văn K','0901234577','$2y$10$QVMCCnyNTac0bm6K8RMMuOgbyCXoENyN5IJe5tLX27/5TXXNFvq46','bui.k@example.com',0,1),(131,'Đặng Thị L','0901234578','$2y$10$yYLD3iZltPR.8NjHs7v8ne3xx/2ZqfBbwdaAZtxtak51WrKwtQ2C2','dang.l@example.com',0,1),(132,'Dương Minh M','0901234579','$2y$10$rQnf7zpT7Qj1LFFO60p7EetfX/xP9EX1sw798SuXoj0AfP1kgRyEK','duong.m@example.com',0,1),(133,'Hồ Quang N','0901234580','$2y$10$/8mcLZ/H5g/yKukShVnomeMb.Iy8NfnfTYyF5ep3UkGG8Ht6PuR3y','ho.n@example.com',0,1),(134,'Phan Thị O','0901234581','$2y$10$XpofQd1W7NSWw6i7fkLUte4kkXudCXMi5wnjif.L3dMPcbRsnwCwW','phan.o@example.com',0,1),(135,'Lương Văn P','0901234582','$2y$10$byS9HeKQiFktgZ/3q/cJuOMr4JJcx1mY3GTV7v/WzEif7jEB0vhMO','luong.p@example.com',0,1),(136,'Tô Thị Q','0901234583','$2y$10$HT0Doo4PYy5o8IKWamis8.uT54uiNHLi9AQULCQFknMLzR8KpPFeO','to.q@example.com',0,1),(137,'Võ Minh R','0901234584','$2y$10$RXGIQ7zWl8aq3j5ckrzxmO6MdkY6wbfbkdlxdHJDl6FuI8csfj64S','vo.r@example.com',0,1),(138,'Đoàn Văn S','0901234585','$2y$10$U7WPzyu7y/8RSSPyL/xC8.GOZe3.upDCNQI/Z/noIV0o7Ko4tgGQ2','doan.s@example.com',0,1),(139,'Khúc Thị T','0901234586','$2y$10$MieYlF2PfdjSIC8Ur/8oqOau.FKcA.LcidmyRfFUBPeEfxqYVXgI.','khuc.t@example.com',0,1),(140,'B2106839','0834477134','$2y$10$tyY0.8uj7pk1RLJ03ucIw.aB8Er2cjGaQOJYoUDojpUYziRZ7bORm','hieupc11@gmail.com',0,1),(141,'Nhà Xuất Bản Trẻ','0238465596','$2y$10$uRAeSLYxlRJM2NvFfg92DuTLSqGyBh7ME5x6BwnDmiSrDkkDmUnLO','hopthubandoc@nxbtre.com.vn',1,1),(142,'Nguyễn Văn A','0987654321','$2y$10$5dRb5.Ppe7eyRpbBhHNS0.0ObK/vnKHIt.B5TcTjbqNDq9EndGrIC','nguyenvana@exam.ple.com',0,1),(169,'Quách Công T','0796543210','$2y$10$/GfDc9V0ovz1BxbPtXaOZuHNmpjkipjKgyT5USik/HvAXrCTb3Aji','quachcongt@example.com',1,1),(170,'Khang','0967890410','$2y$10$.0Dyl0ljyeBthu7yuoBoj.axeqQrSVsziDyFEGY1R10y9PNXHQFVS','khang@gmail.com',0,1),(171,'Nguyễn Văn A','0901234501','$2y$10$fpcwde4BUVTPW0nivMKKbuDQcQPZ4i2dN58gzG1JtgGMrl5lywNC6','nguyen.a@example.com',0,1),(172,'Trần Thị B','0901234502','$2y$10$BrGkXreBEX7s1u8.ZdNR.uYhvXTRygoXT.sT5HY/HIOjxBwRMOe/G','tran.b@example.com',0,1),(173,'Lê Minh C','0901234503','$2y$10$l4qA4sd4N.ZHH1a5E.JkPOkiVEIdSHSJDREyq7a8PBDsF6QsAeP3O','le.c@example.com',0,1),(174,'Phạm Văn D','0901234504','$2y$10$MiEGmmnfZjjZoIsUcdcgcOMNlFCUVBAYLwhLz8wxRE/HoQTs5KM7y','pham.d@example.com',0,1),(175,'Hoàng Thị E','0901234505','$2y$10$Yzijgt6rUKW7AnAZYozcXuJa8BxvXs0aX1EmbN/QCkOQfmHTJSgp.','hoang.e@example.com',0,1),(176,'Vũ Văn F','0901234506','$2y$10$SvEJRvCK7KeBz7psZvgRYeyXYTPdohabZm/KIgW.yFuX/3qsBMIPm','vu.f@example.com',0,1),(177,'Đinh Thị G','0901234507','$2y$10$C3gJplP4YoYfUK5ySrxyVOfx8VKU/Og4jGw0ecxFUj/vTP9RurYXa','dinh.g@example.com',0,1),(178,'Bạch Minh H','0901234508','$2y$10$mIPT50nZgcw1U3q9Bs1Gou9qjbcET2DvKT4k8Sqy5FhzoQWoGXzQC','bach.h@example.com',0,1),(179,'Lý Văn I','0901234509','$2y$10$Zi1wV/HdmvLCRSawPrXHueo7LoJAR9iTZWJS/I6dagqPsNSEjVlTm','ly.i@example.com',0,1),(180,'Tăng Thị J','0901234510','$2y$10$68ugbQOlZka/jtEJ57m1x.pyBg6QHDfoMWgUNdZwoqs.uRfc2wBp2','tang.j@example.com',0,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlocation`
--

DROP TABLE IF EXISTS `userlocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `City` int(11) NOT NULL,
  `District` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_userlocation_user` (`User_id`),
  CONSTRAINT `fk_userlocation_user` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlocation`
--

LOCK TABLES `userlocation` WRITE;
/*!40000 ALTER TABLE `userlocation` DISABLE KEYS */;
INSERT INTO `userlocation` VALUES (14,140,22,203,'61-63,Lý Văn Lâm,Khóm 3,Phường 1',1),(15,141,79,778,'Phường 7,161B Lý Chính Thắng',1),(16,142,14,124,'Số 1, Đường ABC',1),(17,14,22,203,'61-63,Lý Văn Lâm,Khóm 3,Phường 1',1),(18,142,96,964,'61-63,Lý Văn Lâm,Khóm 3,Phường 1',1),(21,142,1,1,'61-63,Lý Văn Lâm,Khóm 3,Phường 1',1),(22,142,1,1,'dvsbsfbfdsa',0),(31,169,25,237,'61-63,Lý Văn Lâm,Khóm 3,Phường 1',0),(32,169,2,28,'Hẻm 553 ,Đường 30/4',0),(33,169,92,916,'Hẻm 553 ,Đường 30/4',1),(34,169,1,1,'fff',0),(35,170,96,964,'aaa',1);
/*!40000 ALTER TABLE `userlocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userstatus`
--

DROP TABLE IF EXISTS `userstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Status_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userstatus`
--

LOCK TABLES `userstatus` WRITE;
/*!40000 ALTER TABLE `userstatus` DISABLE KEYS */;
INSERT INTO `userstatus` VALUES (1,'Còn Hoạt Động'),(2,'Bị Hủy Kích Hoạt');
/*!40000 ALTER TABLE `userstatus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-19 19:33:13
