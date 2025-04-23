-- --------------------------------------------------------
-- Host:                         192.168.1.89
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5190
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_exam
CREATE DATABASE IF NOT EXISTS `db_exam` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_exam`;

-- Dumping structure for table db_exam.auth
CREATE TABLE IF NOT EXISTS `auth` (
  `id_auth` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_auth` varchar(225) DEFAULT NULL,
  `uname` varchar(225) DEFAULT NULL,
  `pword` varchar(225) DEFAULT NULL,
  `level_auth` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`id_auth`),
  UNIQUE KEY `user_auth` (`user_auth`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.auth: ~7 rows (approximately)
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` (`id_auth`, `user_auth`, `uname`, `pword`, `level_auth`) VALUES
	(1, 'C0000.0', 'trust', 'trust', 'Administrator'),
	(2, 'C0001.1', 'user', 'user', 'PIC'),
	(4, 'C0001.2', 'exam', 'exam', 'Exam Administrator'),
	(5, 'C0001.3', 'andi', 'andi', 'Proctor'),
	(7, 'C0002.1', 'sari', 'sari', 'PIC'),
	(14, 'C0001.6', 'imam', 'imam', 'Student Register'),
	(15, 'C0005.1', 'C0005.1', 'LDY8F3', 'PIC'),
	(16, 'C0005.2', 'contoh', 'contoh', 'Exam Administrator'),
	(17, 'C0005.3', 'proctor', '123', 'Proctor');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;

-- Dumping structure for table db_exam.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` varchar(25) NOT NULL,
  `cust_name` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `phone_off` varchar(225) DEFAULT NULL,
  `email_off` varchar(225) DEFAULT NULL,
  `logo` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_customer`),
  UNIQUE KEY `id_customer_UNIQUE` (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.customer: ~5 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id_customer`, `cust_name`, `address`, `phone_off`, `email_off`, `logo`) VALUES
	('C0000', 'Trust Training', 'Surabaya', '123123', 'support1@trustunified.com', 'lsp.png'),
	('C0001', 'fantasi', 'surabaya', '1232', 'wisnu.agustya@gmail.com', 'images.jpg'),
	('C0002', 'lsp-trust', 'surabaya', '12312', 'fantasi21@gmail.com', 'jdoisdjvsdv'),
	('C0003', 'lsp-trust', 'surabaya', '12312', 'wisnu.agustya@gmail.com', 'jdoisdjvsdv'),
	('C0004', 'Power', 'surabaya', '213123', 'staff@example.com', 'logo-Power.png'),
	('C0005', 'CustomerAA', 'surabaya', '+6', 'name@host.com', 'logo-CustomerAA20181107.jpg');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_group
CREATE TABLE IF NOT EXISTS `exam_group` (
  `exam_code` int(11) NOT NULL,
  `group_name` varchar(45) DEFAULT NULL,
  `id_voucher` varchar(45) DEFAULT NULL,
  `count_stu` int(11) DEFAULT NULL,
  PRIMARY KEY (`exam_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_group: ~6 rows (approximately)
/*!40000 ALTER TABLE `exam_group` DISABLE KEYS */;
INSERT INTO `exam_group` (`exam_code`, `group_name`, `id_voucher`, `count_stu`) VALUES
	(1, 'test', 'VC0001', 1),
	(2, 'test', 'VC0001', 1),
	(3, 'test', 'VC0001', 1),
	(4, 'test', 'VC0001', 1),
	(5, 'test', 'VC0001', 1),
	(6, 'test', 'VC0001', 1),
	(7, 'test', 'VC0001', 1),
	(8, 'test', 'VC0005', 0);
/*!40000 ALTER TABLE `exam_group` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_participants
CREATE TABLE IF NOT EXISTS `exam_participants` (
  `no` int(11) NOT NULL,
  `exam_group` int(11) DEFAULT NULL,
  `id_student` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_participants: ~0 rows (approximately)
/*!40000 ALTER TABLE `exam_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_participants` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_report
CREATE TABLE IF NOT EXISTS `exam_report` (
  `id_report` int(11) NOT NULL,
  `exam_date` datetime DEFAULT NULL,
  `exam_code` varchar(45) DEFAULT NULL,
  `exam_class` varchar(45) DEFAULT NULL,
  `exam_reportcol` varchar(45) DEFAULT NULL,
  `group_name` varchar(45) DEFAULT NULL,
  `proctor` varchar(45) DEFAULT NULL,
  `student_id` varchar(45) DEFAULT NULL,
  `student_name` varchar(45) DEFAULT NULL,
  `true_answer` varchar(45) DEFAULT NULL,
  `false_answer` varchar(45) DEFAULT NULL,
  `null_answer` varchar(45) DEFAULT NULL,
  `duration` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_report`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_report: ~0 rows (approximately)
/*!40000 ALTER TABLE `exam_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_report` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_run_quest
CREATE TABLE IF NOT EXISTS `exam_run_quest` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) DEFAULT NULL,
  `id_student` varchar(45) DEFAULT NULL,
  `no_quest` varchar(45) DEFAULT NULL,
  `id_quest` varchar(45) DEFAULT NULL,
  `question` varchar(225) DEFAULT NULL,
  `val_a` varchar(225) DEFAULT NULL,
  `val_b` varchar(225) DEFAULT NULL,
  `val_c` varchar(225) DEFAULT NULL,
  `val_d` varchar(225) DEFAULT NULL,
  `val_e` varchar(225) DEFAULT NULL,
  `val_key` varchar(45) DEFAULT NULL,
  `grade` varchar(45) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `answer` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_run_quest: ~0 rows (approximately)
/*!40000 ALTER TABLE `exam_run_quest` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_run_quest` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_schedule
CREATE TABLE IF NOT EXISTS `exam_schedule` (
  `id_schedule` int(50) NOT NULL AUTO_INCREMENT,
  `exam_group` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` varchar(45) DEFAULT NULL,
  `duration` varchar(45) DEFAULT NULL,
  `classroom` varchar(45) DEFAULT NULL,
  `proctor` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `token` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_schedule: ~3 rows (approximately)
/*!40000 ALTER TABLE `exam_schedule` DISABLE KEYS */;
INSERT INTO `exam_schedule` (`id_schedule`, `exam_group`, `date`, `start_time`, `duration`, `classroom`, `proctor`, `status`, `token`) VALUES
	(1, 5, '2018-11-07', '17:05', '', NULL, 'C0001.3', 'init', NULL),
	(2, 6, '2018-11-07', '17:05', '', NULL, 'C0001.3', 'init', NULL),
	(3, 7, '2018-11-07', '17:05', '', NULL, 'C0001.3', 'init', NULL),
	(4, 8, '2018-11-09', '11:05', '', NULL, 'C0005.3', 'start', 'V9MR98');
/*!40000 ALTER TABLE `exam_schedule` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_session
CREATE TABLE IF NOT EXISTS `exam_session` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `id_student` varchar(45) DEFAULT NULL,
  `start_time` varchar(45) DEFAULT NULL,
  `end_time` varchar(45) DEFAULT NULL,
  `token` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_session`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_session: ~0 rows (approximately)
/*!40000 ALTER TABLE `exam_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_session` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_source
CREATE TABLE IF NOT EXISTS `exam_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_subject` varchar(45) DEFAULT NULL,
  `quest_code` varchar(45) DEFAULT NULL,
  `question` varchar(225) DEFAULT NULL,
  `val_a` varchar(225) DEFAULT NULL,
  `val_b` varchar(225) DEFAULT NULL,
  `val_c` varchar(225) DEFAULT NULL,
  `val_d` varchar(225) DEFAULT NULL,
  `val_e` varchar(225) DEFAULT NULL,
  `val_key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_source: ~244 rows (approximately)
/*!40000 ALTER TABLE `exam_source` DISABLE KEYS */;
INSERT INTO `exam_source` (`id`, `id_subject`, `quest_code`, `question`, `val_a`, `val_b`, `val_c`, `val_d`, `val_e`, `val_key`) VALUES
	(18, 'ppoint1', NULL, 'Cara yang singkat untuk mengakses Microsoft Excel 2013 di Windows 8.1?<br><img src="tes.20181103091751.xls-2-J.png"><br>', 'Tekan kombinasi tombol Windows + R & ketikkan Excel 2013', 'Tekan tombol Windows & ketikkan Excel 2013', 'Klik Start ; pilih All Programs ; pilih Microsoft Office 2013 ; klik Excel 2013', 'Tekan kombinasi tombol Windows + E & pada isian Search ketikkan Excel 2013 lalu jalankan', 'Klik kanan tombol Start ; Klik Programs & Features ; jalankan Excel 2013', 'B'),
	(19, 'ppoint1', NULL, 'Untuk dapat menggunakan scroll layar satu baris ke arah atas, bawah, kiri dan kanan maka tombol yang harus di aktifkan sebelum tombol arah panah digunakan adalah<br><img src="tes.20181103091751.xls-3-J.jpg"><br>', 'Num Lock', 'Scroll Lock', 'Home', 'End', 'Insert', 'B'),
	(21, 'excel1', NULL, 'Cara yang singkat untuk mengakses Microsoft Excel 2013 di Windows 8.1?<br><img src="tes.20181103100038.xls-2-I.png"><br>', 'Tekan kombinasi tombol Windows + R & ketikkan Excel 2013', 'Tekan tombol Windows & ketikkan Excel 2013', 'Klik Start ; pilih All Programs ; pilih Microsoft Office 2013 ; klik Excel 2013', 'Tekan kombinasi tombol Windows + E & pada isian Search ketikkan Excel 2013 lalu jalankan', 'Klik kanan tombol Start ; Klik Programs & Features ; jalankan Excel 2013', 'B'),
	(22, 'excel1', NULL, 'Untuk dapat menggunakan scroll layar satu baris ke arah atas, bawah, kiri dan kanan maka tombol yang harus di aktifkan sebelum tombol arah panah digunakan adalah<br><img src="tes.20181103100038.xls-3-I.jpg"><br>', 'Num Lock', 'Scroll Lock', 'Home', 'End', 'Insert', 'B'),
	(23, 'word1', NULL, 'Untuk membuat heading dan subheading dengan cepat dan mudah, kita gunakan fungsi apakah dalam tab View?<br>', 'Outline View', 'Read Mode', 'Web Layout', 'Print Layout', 'Draft', 'A'),
	(24, 'word1', NULL, 'Pada tab Home terdapat beberapa Ribbon, Ribbon manakah yang berfungsi untuk pengaturan huruf untuk bold, italic dan underline?', 'Font', 'Clipboard', 'Paragraph', 'Styles', 'Editing', 'A'),
	(25, 'word1', NULL, 'Pada tab Home terdapat beberapa Ribbon, Ribbon manakah yang berfungsi untuk pengaturan bullets and numbering, align, spacing dan shading?', 'Paragraph', 'Clipboard', 'Font', 'Styles', 'Editing', 'A'),
	(26, 'word1', NULL, 'Pada tab Home terdapat beberapa Ribbon, Ribbon manakah yang berisi tombol Copy, Cut dan Paste?', 'Clipboard', 'Font', 'Paragraph', 'Styles', 'Editing', 'A'),
	(27, 'word1', NULL, 'Pada tab Home terdapat beberapa Ribbon, Ribbon manakah yang berfungsi untuk pengaturan Heading?', 'Styles', 'Clipboard', 'Font', 'Paragraph', 'Editing', 'A'),
	(28, 'word1', NULL, 'Untuk menarik perhatian pembaca, kita dapat menggunakan efek memperbesar huruf pertama dalam sebuah paragraph dengan menggunakan fungsi?', 'Drop Cap', 'Word Art', 'Quick Part', 'Shapes', 'Smart Art', 'A'),
	(29, 'word1', NULL, 'Untuk membuat paragraf menjadi berada di tengah halaman, menggunakan tombol?', 'Center', 'Align Left', 'Align Right', 'Justify', 'Bottom', 'A'),
	(30, 'word1', NULL, 'Untuk membuat paragraf menjadi rata sebelah kiri, menggunakan tombol?', 'Align Left', 'Left Margin', 'Align Right', 'Right Margin', 'Left Indent', 'A'),
	(31, 'word1', NULL, 'Untuk membuat paragraf menjadi rata sebelah kanan, menggunakan tombol?', 'Align Right', 'Right Margin', 'Right Indent', ' Align Left', 'Left Indent', 'A'),
	(32, 'word1', NULL, 'Untuk membuat paragraf menjadi rata pada kanan dan kiri, menggunakan tombol?<br>', 'Justify', 'Center', 'Align Left', 'Align Right', 'Line Spacing', 'A'),
	(33, 'word1', NULL, 'Tombol yang digunakan untuk melakukan pengaturan jarak antara baris dan antar paragraf adalah?<br>', 'Line and Paragraph Spacing', 'Borders', 'Change Case', 'Shading', 'Multilevel List', 'A'),
	(34, 'word1', NULL, 'Untuk memunculkan penanda bahwa kita telah menginputkan enter dan spasi, dapat menggunakan tombol?', 'Show/Hide Marks', 'Show Navigation Pane', 'Show Ruler', 'Show Gridlines', 'Read Mode', 'A'),
	(35, 'word1', NULL, 'Tombol justify digunakan untuk pengaturan paragaraf agar ?', 'Paragraf rata kanan dan kiri', 'Paragraf rata kiri', 'Paragraf berada di tengah halaman', 'Paragraf rata kanan', 'Salah semua', 'A'),
	(36, 'word1', NULL, 'Fungsi Drop Cap adalah ', 'Memberikan efek pada huruf pertama pada sebuah paragraf agar lebih besar dan menarik untuk dilihat', 'Memperbesar paragraf', 'Menghapus semua paragraf dalam satu halaman', 'Mengatur paragraf agar tampak rata kanan dan kiri', 'Pengaturan huruf kapital dalam paragraph', 'A'),
	(37, 'word1', NULL, 'Yang merupakan fungsi ruler yang ada dalam Microsoft Word, kecuali?', 'Berfungsi sebagai penggaris', 'Berfungsi untuk meluruskan elemen antar dokumen', 'Berfungsi sebagai penghitung jumlah kata yang sudah diketik', 'Berfungsi sebagai penentu jarak', 'Berfungsi sebagai penanda dimana kita akan mulai mengetik', 'C'),
	(38, 'word1', NULL, 'Manakah jawaban yang paling tepat untuk Tampilan yang digunakan ketika membuat dokumen tanpa gambar dan bagan ?<br>', 'Draft', 'Full Screen Reading', 'Web Layout', 'Print Layout', 'Outline', 'E'),
	(39, 'word1', NULL, 'Tab yang berguna untuk mengubah Page Setup sebuah dokumen adalah ?', 'Home', 'Insert', 'Review', 'Page Layout', 'References', 'D'),
	(40, 'word1', NULL, 'Tab apakah yang akan muncul jika kita menggunakan tampilan outline ?', 'Tab Home', 'Tab Insert', 'Tab Outlining', 'Tab Picture', 'Tab Format', 'C'),
	(41, 'word1', NULL, 'Apakah fungsi Promote Up di dalam Outlining Tab pada tampilan Outline?', 'Menggerakkan point ke level tertinggi', 'Menggerakkan point satu tingkat ke atas', 'Menggerakkan point satu tingkat kebawah', 'Menggerakkan point ke level terbawah', 'Menggerakkan point ke samping kanan', 'B'),
	(42, 'word1', NULL, 'Apakah Shortcut yang digunakan untuk menambah ukuran font?', 'Ctrl + Shift + +', 'Ctrl + Shift + >', 'Ctrl + Shift + <', 'Ctrl + Shift + =', 'Ctrl + Shift + K', 'B'),
	(43, 'word1', NULL, 'apakah fungsi "Page Breaks" yang ada di dalam tab Insert?', ' Akan membuka sebuah dokumen baru', 'Akan membuka sebuah halaman kosong yang baru', 'Akan membuka sebuah gambar di dalam halaman yang baru', 'Akan membuka sebuah tabel di dalam halaman yang baru', 'Akan membuat sebuah file baru', 'B'),
	(44, 'word1', NULL, 'Disebut apakah format untuk huruf tebal?', 'Italic', 'Bold', 'Underlines', 'Subscript', 'Inscript', 'B'),
	(45, 'word1', NULL, 'Shortcut apa yang digunakan untuk memberikan rata tengah dalam sebuah dokumen?', 'Ctrl + L', 'Ctrl + E', 'Ctrl + C', 'Ctrl + Alt + Del', 'Ctrl + S', 'B'),
	(46, 'word1', NULL, 'Apakah Fungsi dari Columns pada suatu dokumen?', 'Membuat kolom pada suatu tabel', 'Membuat halaman menjadi beberapa kolom', 'Membuat kolom pada Header', 'Membuat kolom pada Footer', 'Membuat kolom pada tepi kiri atau kanan', 'B'),
	(47, 'word1', NULL, 'Jika kita ingin membuat suatu tanda misalkan tanda minus (-), untuk menggantikan nomor atau huruf pada suatu kalimat menggunakan fungsi apakah?<br>', 'Bullets', 'Numbering', 'Multilevel List', 'Grow Font', 'Shrink Font', 'A'),
	(48, 'word1', NULL, 'Jika kita ingin menggunakan penomoran secara urut dan otomatis, fungsi apakah yang paling tepat digunakan?<br>', 'Bullets', 'Shrink Font', 'Numbering', 'Multilevel List', 'Grow Font', 'C'),
	(49, 'word1', NULL, 'Apakah Fungsi dari Line Spacing?', 'Menentukan jarak antar spasi', 'Menebalkan huruf', 'Membuat miring huruf', 'Merubah jenis huruf', 'Merubah besar huruf', 'A'),
	(50, 'word1', NULL, 'Apakah fungsi dari Toolbar?', 'Menampilkan judul dokumen', 'Menampilkan perintah-perintah yang ada pada Microsoft Word', 'Mempercepat langkah dalam menjalankan suatu perintah', 'Sebagai tempat untuk mengetik suatu dokumen', 'Menampilkan status yang berkaitan dengan dokumen yang di buat', 'C'),
	(51, 'word1', NULL, 'Fungsi Fill Color apabila digunakan teks adalah', 'Merubah bakground warna dari teks', 'Merubah warna dari teks', 'Menghapus semua paragraf dalam satu halaman', 'Mengatur paragraf agar tampak rata kanan dan kiri', 'Pengaturan huruf kapital dalam paragraf', 'A'),
	(52, 'word1', NULL, 'Alignment yang digunakan untuk kedua sisi dokumen adalah ?<br>', 'Right', 'Justified', 'Left', 'Bottom', 'Centered', 'B'),
	(53, 'word1', NULL, 'Ffitur yang digunakan untuk menambahkan Chart pada tab Insert adalah ?<br>', 'Chart', 'Pictures', 'Shape', 'Smart Art', 'Column', 'A'),
	(54, 'word1', NULL, 'Tipe Chart pada jawaban yang dapat digunakan dalam Microsoft Word, kecuali ?', 'Smart Art', 'Column', 'Bar', 'Line', 'Pie', 'A'),
	(55, 'word1', NULL, 'Untuk merubah data pada Chart yang sebelumnya sudah di buat, dapat menggunakan tombol ?', 'Edit Data', 'Select Data', 'Switch Row/Column', 'Refresh Data', 'Change Chart Type', 'A'),
	(56, 'word1', NULL, 'Untuk memberikan view yang berbeda pada Pie chart, maka kita dapat memasukkan nilai rotasi pada menu Series Option di bagian?<br>', 'Angle of first slice', 'Pie explosion', 'Fill', 'Border', 'Shadow', 'A'),
	(57, 'word1', NULL, 'Untuk memberikan efek potongan Pie Chart yang terpisah, maka dapat memasukkan nilai pada menu Series Option di bagian?', 'Angle of first slice', 'Pie explosion', 'Fill', 'Border', 'Shadow', 'B'),
	(58, 'word1', NULL, 'Untuk memberikan pengaturan pada legend, masuk ke pengaturan apa ?', 'Format Legend', 'Format Chart Area', 'Format Chart Title', 'Format Plot Area', 'Format Data Series', 'A'),
	(59, 'word1', NULL, 'Untuk memberi efek pada text agar terlihat lebih menarik dapat menggunakan?', 'Word Art', 'Text Box', 'Quick parts', 'Drop Cap', 'Smart Art', 'A'),
	(60, 'word1', NULL, 'Yang terdapat pada jawaban adalah beberapa pilihan pada tombol Wrap Text, kecuali ?<br>', 'Justify', 'In line with text', 'Behind the text', 'In front of Text', 'Top and Bottom', 'A'),
	(61, 'word1', NULL, 'Untuk menempatkan gambar agar secara otomatis berada diatas text, maka menggunakan salah satu fungsi Word Wrap ?<br>', 'In Front of Text', 'Square', 'Tight', 'Behind Text', 'Top and Bottom', 'A'),
	(62, 'word1', NULL, 'Pada jawaban terdapat beberapa pilihan dalam menu Rotate Picture, kecuali ?', 'Square', 'Rotate Left 90 Degree', 'Rotate Right 90 Degree', 'Flip Horizontal', 'Flip Vertical', 'A'),
	(63, 'word1', NULL, 'Untuk memotong gambar pada dokumen dapat menggunakan fitur ?<br>', 'Crop', 'Rotate', 'Align', 'Picture Border', 'Picture Effect', 'A'),
	(64, 'word1', NULL, 'Pada jawaban adalah beberapa tipe SmartArt yang dapat digunakan , kecuali ?', 'Oval', 'List', 'Process', 'Cycle', 'Hierarchy', 'A'),
	(65, 'word1', NULL, 'Untuk menampilkan Panel Text Editor pada SmartArt Word, pada tab Design Smart Art dapat menggunakan tombol?', 'Text Pane', 'Add Shape', 'Right to Left', 'Add Bullet', 'Promote', 'A'),
	(66, 'word1', NULL, 'Untuk membuat header atau footer yang berbeda setelah Page Break, dapat menggunakan pilihan?', 'Non-aktifkan Ã¢â‚¬Å“Link to PreviousÃ¢â‚¬Â', 'Aktifkan Ã¢â‚¬Å“Link to Previous', 'Different First Page', 'Different Odd & Even Pages', 'Show Document Text', 'A'),
	(67, 'word1', NULL, ' Untuk membuat daftar isi secara otomatis berdasarkan heading dan sub heading yang telah tersusun rapi, dapat menggunakan fitur ?', 'Table of Contents', 'Update Table', 'Insert Citation', 'Insert Table of Figures', 'Insert Endnote', 'A'),
	(68, 'word1', NULL, 'Untuk mengupdate halaman pada daftar isi secara otomatis, dapat menggunakan tombol ... ?', 'Update table', 'Insert Footnote', 'Manage Source', 'Insert Index', 'Mark Citation', 'A'),
	(69, 'word1', NULL, 'Untuk menampilkan daftar pustaka, dapat menggunakan fungsi ?', 'Bibliography', 'Manage Source', 'Insert Citation', 'Insert Footnote', 'Table of Contents', 'A'),
	(70, 'word1', NULL, 'Tombol  apakah yang dapat digunakan untuk membuat footnote ?', 'Footer', 'Table of Content', 'Table of Figure', 'Bibliography', 'Insert Footnote', 'E'),
	(71, 'word1', NULL, 'Fungsi apakah yang digunakan untuk menggabungkan antar Cell ketika membuat suatu tabel?', 'Merge Cells', 'Split Cells', 'Split Table', 'Insert Left', 'Autofit', 'A'),
	(72, 'word1', NULL, 'Fitur apakah yang digunakan untuk membuat bingkai dan menambah warna serta corak latar belakang ?', 'Bullets & Numbering', 'Border & Shading', 'Line Spacing', 'Alignment', 'Find & Replace', 'B'),
	(73, 'word1', NULL, 'Ketika pertama kali membuat pie chart maka secara default pie chart tersebut menjadi berapa pecahan pie?<br>', '1', '2', '3', '4', '5', 'D'),
	(74, 'word1', NULL, 'Untuk merubah judul chart yang sudah di buat, maka dapat menggunakan menu ?<br>', 'Layout', 'Chart Title', 'Shape outline', 'Format Floor Window', '3D Rotation', 'B'),
	(75, 'word1', NULL, 'Fungsi di dalam Word Art yang dapat membuat tampilan text tampak lebih hidup dengan menggunakan tampilan 3 Dimensi adalah', 'Shadow', 'Reflection', 'Text Fill', '3D Rotation', 'Glow and Soft Edges', 'D'),
	(76, 'word1', NULL, 'Jika anda ingin menambahkan judul dan menandai nomer halaman secara otomatis, maka anda bisa menggunakan perintah?', 'Header and Footers', 'Page Number', 'Pages', 'Table', 'Comment', 'A'),
	(77, 'word1', NULL, 'Suatu laporan di sertai dengan background yang berupa gambar, agar posisi tulisan di atas gambar tersebut maka menggunakan perintah apa?', 'Behind Text', 'In Front of Text', 'Wrap Text', 'Flip Horizontal', 'Flip Vertical', 'A'),
	(78, 'word1', NULL, 'Untuk menambahkan halaman pada Table of Content maka dapat menggunakan perintah ?<br>', 'Table of Figures', 'Bibliography', 'Footer', 'Header', 'Header and Footers', 'A'),
	(79, 'word1', NULL, 'Untuk memberi efek warna pada dasar chart yang sudah dibuat, maka perintah yang dapat digunakan adalah ?<br>', 'Chart Floor', 'Chart Wall', 'Shape Outline', 'Word Art', 'Chart Title', 'A'),
	(80, 'word1', NULL, 'Apakah fungsi dari lembar kerja ?', 'Menampilkan judul dokumen', 'Menampilkan perintah-perintah yang ada pada dokumen<br>', 'Mempercepat langkah dalam menjalankan suatu perintah', 'Sebagai tempat untuk mengetik suatu dokumen', 'Menampilkan status yang berkaitan dengan dokumen yang di buat', 'D'),
	(81, 'word1', NULL, 'Apakah fungsi utama dari Replace ?', 'Untuk mengubah suatu kata', 'Untuk menghapus suatu kata', 'Untuk menampilkan suatu kata', 'Untuk menambahkan suatu kata', 'Untuk menyembunyikan suatu kata', 'A'),
	(82, 'word1', NULL, 'Fungsi utama dari Caption adalah', 'Memberikan keterangan pada suatu tabel atau gambar', 'Memberikan keterangan pada suatu movie', 'Memberikan keterangan pada suatu sound', 'Memberikan keterangan pada suatu text', 'Memberikan keterangan pada suatu multimedia', 'A'),
	(86, 'word3', NULL, 'Untuk dapat menggunakan dokumen baru maka langkah apa sajakah yang perlu dijalankan adalah?<br>', 'Klik tab File ; pilih New ; pilih Blank Document', 'Klik tab File ; pilih New ; pilih My Template', ' Klik tab File ; pilih Save As ; pilih Browse Folder', 'Klik tab File ; pilih Open ; pilih Recent Documents', 'Klik tab File ; pilih Close', 'A'),
	(87, 'word3', NULL, 'Untuk menyimpan dokumen, langkah apa sajakah yang dijalankan?<br><br><br>', 'Klik tab File ; pilih Save ', 'Klik tab File ; pilih New ; pilih My Template', 'Klik tab File ; pilih New ; pilih Blank Document', 'Klik tab File ; pilih Open ; pilih Recent Documents', 'Klik tab File ; pilih Close', 'A'),
	(88, 'word3', NULL, 'Untuk menyimpan dokumen dalam bentuk tipe file yang berbeda, maka langkah yang dapat dijalankan adalah?<br>', 'Klik tab File ; pilih Save as', 'Klik tab File ; pilih New ; pilih My Template', 'Klik tab File ; pilih New ; pilih Blank Document', 'Klik tab File ; pilih Open ; pilih Recent Documents', 'Klik tab File ; pilih Close', 'A'),
	(89, 'word3', NULL, 'Langkah apakah yang dapat dijalankan untuk membuka dokumen yang telah tersimpan sebelumnya?<br>', 'Klik tab File ; pilih Open', 'Klik tab File ; pilih New', 'Klik tab File ; pilih Save', 'Klik tab File ; pilih Print', 'Klik tab File ; pilih Close', 'A'),
	(90, 'word3', NULL, 'Bagaimanakah cara untuk membuat halaman Cover?', 'Klik tab Insert ; klik Cover ; Pilih tipe Cover', 'Klik tab Insert ; klik Blank Page', 'Klik tab Insert ; klik Page Break', 'Klik tab Home ; klik Cover', 'Klik tab Home ; klik Open', 'A'),
	(91, 'word3', NULL, 'Bagaimanakah langkah-langkah untuk mengganti bullet dengan gambar / icon ?<br>', 'Klik tab Home ; Klik menu dropdown Bullet ; Define New Bullet', 'Klik tab Home ; Klik menu dropdown Numbering ; Define New Number Format', 'Klik tab Home ; Klik Bullet', 'Klik tab Home ; klik Numbering', 'Klik tab Home ; Klik menu dropdown Bullet ; Define New Number Format', 'A'),
	(92, 'word3', NULL, 'Perintah apakah yang digunakan untuk membuat halaman judul yang telah disediakan yaitu menggunakan halaman judul yang bernama Austin?', 'Pilih File Tab ; New Documents ; Pilih Austin', 'Pilih Insert Tab ; Pilih Cover Page ; Pilih Austin', 'Pilih Insert Tab ; pilih Shapes ; Pilih Austin', 'Pilih Insert Tab ; pilih Header ; Pilih Austin', 'Pilih Insert Tab ; pilih Footer ; pilih Austin', 'B'),
	(93, 'word3', NULL, 'Bagaimanakah cara merubah tampilan sebuah paragraf menjadi 3 kolom?', 'Pilih Page Layout ; Pilih Orientation ; Pilih Landscape', 'Pilih Page Layout ; Pilih Columns ; Pilih Three', 'Pilih Page Layout ; Pilih Orientation ; Pilih Potrait', 'Pilih Page Layout ; Pilih Margin ; Pilih Moderate', 'Pilih Page Layout ; Pilih Margin ; Pilih Wide', 'B'),
	(94, 'word3', NULL, 'Manakah pada jawaban yang merupakan cara untuk menggeser Bullet pada Bullet and Numbering ?', 'Menekan tombol Ctrl + Tab pada sebuah bullet yang akan digeser', 'Menekan tombol Tab', 'Menggeser Bullet dengan mengarahkan pointer lalu menahan tombol kiri pada mouse', 'Menekan tombol spasi hingga sampai pada batas yang diinginkan', 'Semua Jawaban Benar', 'C'),
	(95, 'word3', NULL, 'Bagaimanakah cara untuk memberikan rata tengah pada sebuah paragraf dengan jarak spasi per baris sebanyak 1,5pt ?', 'Tekan Ctrl + E ; Klik Page Layout ; Pilih Page Setup ; masukkan angka 1,5 pada width', 'Tekan Ctrl + E ; Lalu klik Page Layout ; Arahkan kursor mouse ke Ribbon Paragraph ; Klik tanda panah kecil pada Line & Paragraph Spacing ; Pilih 1,5pt ', 'Tekan Ctrl + J ; klik Page Layout ; Pilih Paragraph ; Klik tanda panah kecil ; Masukkan angka 1,5 pada Line spacing', 'Tekan Ctrl + S ;klik Page Layout ; Pilih Paragraph ; Klik tanda panah kecil ; Masukkan angka 1,5 pada Line spacing', 'Tekan Ctrl + S ;Klik Home tab ; Pilih Paragraph ; Klik tanda panah kecil ; masukkan angka 1,5 pada Line spacing', 'B'),
	(96, 'word3', NULL, 'Bagaimana cara membuat dokumen yang baru dengan menggunakan template yang bernama Resume?', 'Klik Tab File ; Pilih Tombol New ; klik Template yang bernama Resume', 'Klik Tab Home ; Pilih Tombol New ; klik Template yang bernama Resume', 'Klik Tab File ; Pilih Tombol Start ; klik Template yang bernama Resume', 'Klik Tab Insert ; Pilih Tombol New ; klik Template yang bernama Resume', 'Klik Tab File ; Pilih Tombol Insert ; klik Template yang bernama Resume', 'A'),
	(97, 'word3', NULL, 'Bagaimanakah cara untuk memilih jenis ukuran kertas?', 'Pada Tab Margin ; Ketik jarak yang ingin dirubah', 'Pilih Tab Page Layout ; Klik Size ; Pilih jenis ukuran kertas', 'Klik tanda Tab Page Layout;Pilih Line Numbers ; Pilih Continous', 'Klik tanda Tab Page Layout ; Pilih Line Numbers ; Pilih Restart Each Page ', 'Tekan Ctrl + E lalu ; Klik Page Layout ; Pilih Page Setup ;Masukkan angka 1,5 pada width', 'B'),
	(98, 'word3', NULL, 'Bagaimana cara mengubah ukuran Teks menjadi 20?', 'Klik dua kali teks ; Pilih Tab Home ; Klik tombol Underline pada group Font', 'Klik dua kali teks ; Pilih Tab Home ; Klik tombol Bold pada group Font', 'Klik dua kali teks ; Pilih Tab Home ; Klik tombol Italic pada group Font', 'Klik dua kali teks ; Klik Font Dialog Box Launcher ; Klik pada checkbox Outline', 'Klik dua kali teks ;Pilih Tab Home ; Klik tanda panah Font Size ;isikan angka 20', 'E'),
	(99, 'word3', NULL, 'Langkah apa saja yang harus dilakukan untuk mengatur teks dengan Underline ?', 'Klik dua kali teks ; Pilih Tab Home ; Klik tombol Underline pada group Font', 'Klik dua kali teks ; Pilih Tab Home ; Klik tombol Bold pada group Font', 'Klik dua kali teks ; Pilih Tab Home ; Klik tombol Italic pada group Font', 'Pilih Tab Home ; Klik panah Font Color pada group Font ; Klik warna yang diinginkan pada Palette', 'Klik dua kali pada paragraf ; Klik tab Home dan pilih group Paragraph ; Klik tombol Justify', 'A'),
	(100, 'word3', NULL, 'Bagaimana cara mengatur warna Font pada teks ?', 'Klik dua kali teks ; Klik Font Dialog Box Launcher ; Klik pada checkbox Outline ', 'Klik dua kali teks ; Pilih Tab Home ; Klik tanda panah Font Size, isikan angka 20', 'Pilih Tab Home ; Klik Font Color pada group Font ; Klik warna yang diinginkan pada Palette', 'Klik tombol Shape Fill ; Pilih warna Aqua ; Pada bagian Gradien pilih From Center ', 'Pilih Tab Design ; Klik tanda panah Change Color pada group Smart Styles ; Pilih salah satu warna', 'C'),
	(101, 'word3', NULL, 'Bagaimanakah cara membuka dokumen yang sudah pernah digunakan?<br>', 'Klik tab File ; Klik Open Document', 'Klik tab File ; Pilih New ; Pilih Blank Document', 'Klik tab File ; Klik Open ; Pilih Recent Document', 'Klik tab File ; Pilih Print', 'Klik tab File ; Pilih Save and Send', 'C'),
	(102, 'word3', NULL, 'Manakah pada jawaban yang&nbsp; bukan termasuk pengaturan pada Format Teks adalah?<br>', 'Bold', 'Italic', 'Underline', 'Font Size', 'Bullet &amp; Numbering', 'E'),
	(103, 'word3', NULL, 'Yang bukan termasuk unsur dari pengaturan paragraf adalah?', 'Bullets & Numbering', 'Border & Shading', 'Line Spacing', 'Alignment', 'Find & Replace', 'E'),
	(104, 'word3', NULL, 'Bagaimanakah cara mengganti bullet dengan symbol yang kita inginkan tanpa menggunakan symbol yang sudah ada ?', 'Klik tanda panah bawah pada bullet lalu pilih define new bullet lalu pilih picture', 'Klik tanda panah bawah pada bullet lalu pilih define new bullet lalu pilih Symbol', 'Klik tanda panah bawah pada bullet lalu pilih define new bullet lalu pilih Font', 'Klik tanda Tab Page Layout lalu pilih Line Numbers lalu pilih Continous', 'Klik tanda Tab Page Layout lalu pilih Line Numbers lalu pilih Restart Each Page', 'A'),
	(105, 'word3', NULL, 'Bagaimanakah mengatur lebar kolom pada sebuah paragraf yang telah dibentuk menjadi kolom?', 'Dengan mengatur ukuran lebar dari ruler', 'Dengan menekan tombol Tab', 'Dengan mengatur Spacing pada pengaturan Paragraph', 'Dengan menekan tombol Shift + Tab', 'Dengan mengatur margin kiri', 'A'),
	(106, 'word3', NULL, 'Bagaimanakah cara membuat dokumen baru ?', 'Klik tab File ; Open Document', 'Klik tab File ; Pilih New ; Pilih Blank Document', 'Klik tab File ; Open Recent Document', ' Klik tab File ; Print', 'Klik tab File ; Save and Send', 'B'),
	(107, 'word3', NULL, 'Apa yang mesti dilakukan untuk menampilkan paragraf yang terbagi menjadi beberapa kolom dalam satu halaman?<br>', 'Mengatur Columns pada tab Page Layout', 'Mengatur Orientation pada tab Page Layout', 'Mengatur Line Numbers pada tab Page Layout', 'Mengatur Position pada tab Page Layout', 'Mengatur Align pada tab Page Layout', 'A'),
	(108, 'word3', NULL, 'Untuk memberikan  tampilan yang lebih bagus pada penulisan tanggal, contohnya seperti penulisan Ã¢â‚¬Å“thÃ¢â‚¬Â pada tanggal (20th December) dapat menggunakan pengaturan?', 'Superscript', 'Subscript', 'Changecase', 'Bold', 'Underline', 'A'),
	(109, 'word3', NULL, 'Untuk memberikan citation sebagai penanda bahwa telah mengutip referensi dari sumber lain, dapat menggunakan fitur?<br>', 'Insert Citation', 'Insert Table of Figures', 'Insert Index', 'Insert Table of Authorities', 'Table of Contents', 'A'),
	(110, 'word3', NULL, 'Apakah fungsi dari Tab References ?', 'Sebagai pembuat surat atau dokumen otomatis', 'Sebagai alat untuk mengubah dokumen dan property sebuah halaman', 'Sebagai alat untuk mengedit thesaurus, spelling, comments, dan protection', 'Sebagai alat untuk memasukkan sesuatu ke dalam lembar kerja seperti gambar, tabel dll', 'Sebagai alat untuk membuat daftar isi, catatan kaki, kutipan, dan keterangan', 'E'),
	(111, 'word3', NULL, 'Bagaimanakah cara menyisipkan Wordart pada dokumen ?', 'Pilih Tab Insert ; Klik Wordart ; Pilih jenis Wordart yang ingin digunakan', 'Pilih Tab Insert ; Pilih Drop Cap ; Pilih Droped', 'Pilih Tab Insert ; Pilih Smart Art ; Pilih Desain yang sesuai', 'Pilih Tab Insert ; Pilih Clip Art ; Masukkan lokasi file', 'Pilih Tab Insert ; Pilih Clip Art ; Pilih Droped', 'A'),
	(112, 'word3', NULL, 'Langkah-langkah untuk membuat Chart seperti nampak pada gambar adalah<br><img src="soal word 61-90.20150802231352.xls-28-K.jpg"><br>', 'Pilih Tab Insert ; Klik Chart ; Pilih 3-D Pie & Tekan Ok ; Masukkan Data pada layar Window Excel', 'Klik Chart ; Pilih 3-D Pie & Tekan Ok ; Masukkan Data pada layar Window Excel', 'Pilih Tab Format ; Klik Chart ; Pilih 3-D Pie & Tekan Ok ; Masukkan Data pada layar Window Excel', 'Klik Pie Chart ; Pilih 3-D Pie & Tekan Ok ; Masukkan Data pada layar Window Excel', 'Pilih Tab Design ; Klik Chart ; Pilih 3-D Pie & Tekan Ok ; Masukkan Data pada layar Window Excel', 'A'),
	(113, 'word3', NULL, 'Bagaimanakah Langkah-langkah untuk membuat Tabel seperti nampak pada gambar adalah <br><img src="soal word 61-90.20150802231352.xls-29-K.jpg"><br>', 'Pilih Tab Insert ; Klik Table ; Pada Insert Table Buat Tabel 5 Baris & 2 Kolom ; Klik Tabel & Pilih Tab Design ; Pada Ribbon Table Style Pilih Grid Table 4 Ã¢â‚¬â€œ Accent 1', 'Klik Table ; Pada Insert Table Buat Tabel 5 Baris & 2 Kolom ; Klik Tabel & Pilih Tab Design ; Pada Ribbon Table Style Pilih Grid Table 4 Ã¢â‚¬â€œ Accent 1', 'Pilih Tab Format ; Klik Table ; Pada Insert Table Buat Tabel 5 Baris & 2 Kolom ; Klik Tabel & Pilih Tab Design ; Pada Ribbon Table Style Pilih Grid Table 4 Ã¢â‚¬â€œ Accent 1', 'Klik Table ; Pada Insert Table Buat Tabel 5 Baris & 2 Kolom ; Pilih Tab Format ; Pada Ribbon Table Style Pilih Grid Table 4 Ã¢â‚¬â€œ Accent 1', 'Pilih Tab Insert ; Klik Table ; Pada Insert Table Buat Tabel 5 Baris & 2 Kolom ', 'A'),
	(114, 'word3', NULL, 'Untuk membuat tampilan suatu chart tampak miring seperti pada gambar, yang perlu dilakukan pada opsi 3-D Rotation adalah<br><img src="soal word 61-90.20150802231352.xls-30-K.jpg"><br>', 'Tambahkan centang pada Right Angle Axis', 'Hilangkan centang pada Right Angle Axis', 'Tambahkan centang pada Autoscale', 'Hilangkan centang pada Autoscale', 'Klik tombol Default Rotation', 'B'),
	(115, 'word3', NULL, 'Untuk membuat text effect seperti nampak pada gambar, yang perlu dilakukan pada Text Effect adalah<br><img src="soal word 61-90.20150802231352.xls-31-K.jpg"><br>', 'Pilih Efek Shadow pada Text Effects dan klik Perspective Diagonal Upper Right Shadow', 'Pilih Efek Bevel pada Text Effects dan klik Perspective Diagonal Upper Right Shadow', 'Pilih Efek Reflection pada Text Effects dan klik Perspective Diagonal Upper Right Shadow', 'Pilih Efek Glow pada Text Effects dan klik Perspective Diagonal Upper Right Shadow', 'Pilih Efek 3-D Rotation pada Text Effects dan klik Perspective Diagonal Upper Right Shadow', 'A'),
	(116, 'word3', NULL, 'Untuk membuat efek bayangan seperti pada gambar maka pada Picture Offects yang perlu dilakukan adalah<br><img src="soal word 91-120.20150802231544.xls-2-K.jpg"><br>', 'Pilih Shadow dan pilih Below', 'Pilih Bevel dan pilih Below', 'Pilih Reflection dan pilih Below', 'Pilih 3-D Rotation dan pilih Below', 'Pilih Glow dan pilih Below', 'A'),
	(117, 'word3', NULL, 'Untuk membuat daftar isi seperti pada gambar, maka ketika berada pada Tab References yang perlu dilakukan adalah<br><img src="soal word 91-120.20150802231544.xls-3-K.jpg"><br>', 'Klik Insert Table of Figures dan pilih format yang ingin digunakan lalu klik OK', 'Klik Insert Table dan pilih desain yang ingin digunakan lalu klik OK', 'Klik Insert Figures dan pilih format yang ingin digunakan lalu klik OK', 'Klik Insert Table of Figures ', 'Pilih format yang ingin digunakan lalu klik OK', 'A'),
	(118, 'word3', NULL, 'Untuk membuat Bibliography seperti pada gambar, maka pada Tab References yang perlu dilakukan adalah<br><img src="soal word 91-120.20150802231544.xls-4-K.jpg"><br>', 'Klik Bibliography yang akan muncul sub menu dan pilih Bibilography', 'Klik Citation yang akan muncul sub menu dan pilih Bibilography', 'Klik Footnote yang akan muncul sub menu dan pilih Bibilography', 'Klik Header yang akan muncul sub menu dan pilih Bibilography', 'Klik Footer yang akan muncul sub menu dan pilih Bibilography', 'A'),
	(119, 'word3', NULL, 'Bagaimanakah cara untuk menyisipkan gambar dengan Shapes ?', 'Klik Tab Insert ; Pilih Word Art ; Pilih Desain yang sesuai', 'Klik Tab Insert ; Pilih Drop Cap ; Pilih Droped', 'Klik Tab Insert ; Pilih Smart Art ; Pilih Desain yang sesuai', 'Klik Tab Insert ; Pilih Clip Art ; Masukkan lokasi file', 'Klik Tab Insert ; Pilih Shapes ; Pilih bentuk gambar ; Sesuaikan ukuran Shapes', 'E'),
	(120, 'word3', NULL, 'Bagaimanakah cara mudah untuk membuat sebuah kata atau kalimat yang memiliki footnote ?', 'Klik Tab References ; Pilih Insert Citation', 'Klik Tab References ; pilih Insert Footnote', 'Klik Tab Insert ; Pilih Footer', 'Klik Tab Insert ; Pilih Insert Footnote', 'Klik Tab Page Layout ; Pilih Insert Footnote', 'B'),
	(121, 'word3', NULL, 'Cara yang tepat untuk membuat Pie Chart di dalam Microsoft Word 2013 adalah ?', 'Pilih Tab Insert ; Pilih Chart ; Pilih Line ; Tekan Ok', 'Pilih Tab Insert ; Pilih Chart ; Pilih Pie ; Tekan Ok', 'Pilih Tab Insert ; Pilih Chart ; Pilih Bar ; Tekan Ok', 'Pilih Tab Insert ; Pilih Chart ; Pilih Doughnut ; Tekan Ok', 'Pilih Tab Insert ; Pilih Chart ; Pilih Column ; Tekan Ok', 'B'),
	(122, 'word3', NULL, 'Bukalah buku kerja Excel ; Cari data yang diinginkan ; Pilih bagan lalu tekan Ctrl + C ; Pindah ke File MS Word ; Tekan Ctrl + V .  Cara tersebut adalah untuk ...?', 'Membuat data baru di dalam MS EXCEL', 'Membuat tabel baru di dalam MS WORD', 'Membuat data tabel di dalam MS WORD', 'Membuat salinan tabel dari MS EXCEL ke MS WORD', 'Membuat salinan tabel dari MS WORD ke MS EXCEL', 'D'),
	(123, 'word3', NULL, 'Masuk ke dalam Insert Tab ; Pilih Chart ; Pilih Line chart ; Tekan OK ; Klik salah satu garis ; Masuk ke dalam chart tools lalu pilih Format ; Pilih Shape Fill pilih Yellow .  Cara tersebut adalah untuk ...?  ', 'Merubah salah satu warna Chart Pie', 'Merubah salah satu warna Chart Line', 'Merubah salah satu Outline Chart Line', 'Merubah salah satu ketebalan garis Chart Line', 'Merubah salah satu bentuk Chart Line', 'B'),
	(124, 'word3', NULL, 'Klik Chart line yang sudah ada ; Pilih Layout pada Chart Tools ; Pilih Line Chart ; Masuk ke dalam data table ; Pilih Show data Table .  Cara tersebut adalah untuk...?', 'Menampilkan data valid dari sebuah data Chart Line', 'Menampilkan tabel lain dari sebuah data Chart Line', 'Menampilkan data sebuah data dari Chart Line', 'Menampilkan Legenda sebuah data dari Chart Line', ' Menampilkan tabel data sebuah data dari Chart Line', 'E'),
	(125, 'word3', NULL, 'Pilih tab Insert ; Pilih Picture ; Carilah file yang ingin dimasukkan ; Klik insert .  Cara tersebut adalah untuk ... ?', 'Memasukkan tabel dari file yang ada', 'Memasukkan gambar yang diinginkan', 'Memasukkan tabel dari file MS EXCEL', 'Memasukkan Smart Art piihan', 'Memasukkan Link sebuah referensi ke dalam file', 'B'),
	(126, 'word3', NULL, 'Pilih tab Insert ; Pilih Picture ; Carilah file yang ingin anda masukkan ; Klik insert ; Klik Rotate pada Arrange tools ; Masukkan angka 45 derajat .  Cara tersebut adalah untuk ...?', 'Memasukkan gambar yang kita inginkan dan memberikan frame pada gambar', 'Memasukkan gambar yang kita inginkan dan menebalkan gambar', 'Memasukkan gambar yang kita inginkan dan memutar menjadi 45 derajat', 'Memasukkan gambar yang kita inginkan dan menggandakan gambar', 'Memasukkan tabel yang kita inginkan dan memutar menjadi 45 derajat', 'C'),
	(127, 'word3', NULL, 'Yang termasuk fungsi utama dari Smart Art adalah ?', 'Untuk merepresentasikan secara visual berdasarkan informasi dan ide', 'Untuk memasukkan gambar', 'Untuk membuat gambar terlihat lebih bagus', 'Untuk membuat tabel bergambar', 'Semua jawaban salah', 'A'),
	(128, 'word3', NULL, 'Manakah yang bukan reference yang ada pada Microsoft Word ?', 'Footer', 'Table of Contents<br>', 'Cititation', 'Footnote', 'Bibliography', 'A'),
	(129, 'word3', NULL, 'Bagaimanakah cara memasukkan tabel dengan desain yang ada pada Microsoft Word ?', 'Pilih Insert Tab ; Pilih table ; Pilih Table tools ; Pilih Layout Tab ; Pilih Properties', 'Pilih Insert Tab ; Pilih table ; Pilih Quick Tables ; Pilih salah satu desain tabel yang diinginkan ', 'Pilih Insert Tab ; Pilih table ; Pilih Table tools ; Pilih Design Tab ; Pilih Draw Table', 'Pilih Insert Tab ; Pilih table ; pilih Table tools ; pilih Design Tab ; Pilih Shading', 'Pilih Insert Tab ; Pilih table ; pilih Table tools ; pilih Design Tab ; Pilih Borders', 'B'),
	(130, 'word3', NULL, 'Bagaimana caranya menyisipkan Clip Art pada sebuah dokumen ?', 'Pilih Tab Insert ; Tekan tombol Picture pada group Illustrations ; Pilih gambar lalu klik tombol Insert', 'Pilih Tab Insert ; Klik Online Pictures ; Pada isian Bing Search Engine ketik Clip Art', 'Pilih Tab Design ; Klik tanda panah WordArt pada group Text ; Klik WordArt style 5 ; Pada Edit Wordart Text lalu ketikkan suatu kalimat ; Pilih Showcard Gothic pada Font & klik OK', 'Klik tombol Shape Fill ; Pilih warna Aqua ; Pada bagian Gradien pilih From Center', 'Pilih Tab Insert ; Klik Smart Art pada group Illustrator ; Pilih jenis diagram yang diinginkan lalu tekan OK', 'B'),
	(131, 'word3', NULL, 'Untuk mengisi list pada daftar pustaka, cara mudah yang harus dijalankan adalah', 'Klik tab References ; Manage Sources ', 'Klik Tab References ; Bibliography', 'Klik tab References ; Insert Caption', 'Klik tab References ; Insert Index', 'Klik tab References ; Insert Table of Authorities', 'A'),
	(132, 'word3', NULL, 'Bagaimanakah cara yang mudah untuk menambahkan header pada suatu dokumen?', 'Tab Insert ; Klik Header', 'Tab Home; Klik Header', 'Tab Design ; Klik Header', 'Klik kanan ; add Header', 'Tab Insert ; Page Number', 'A'),
	(133, 'word3', NULL, 'Cara yang paling mudah untuk menambahkan gambar pada halaman adalah ?', 'Klik Insert ; Pictures', 'Klik Insert ; Shapes', 'Klik Insert ; Smart Art', 'Klik Insert ; Image', 'Klik Insert ; Table', 'A'),
	(134, 'word3', NULL, 'Pada Tables & Border Toolbar, fungsi Excel Spreadsheet adalah?', 'Untuk menyisipkan tabel melalui dialog Insert Table', 'Untuk menyisipkan tabel dalam bentuk lembar kerja Excel', 'Untuk msenyisipkan tabel secara instan ', 'Untuk mengubah bentuk teks menjadi tabel', 'Untuk menyisipkan tabel dengan cara menggambar pada dokumen', 'B'),
	(135, 'word3', NULL, 'Bagaimanakah cara mencetak suatu dokumen ?', 'Klik tab File ; Open Document', 'Klik tab File ; Pilih New ; Pilih Blank Document', 'Klik tab File  ; Open Recent Document', 'Klik tab File ; Pilih Print ; Pilih jenis Print,halaman yang akan digandakan & halaman yang akan di print ; Klik Print', 'Klik tab File ; Save and Send', 'D'),
	(136, 'word3', NULL, 'Untuk membuat surat yang akan di kirimkan kepada banyak orang, kita dapat memanfaatkan fitur yang digunakan untuk mengisi nama penerima dan alamat secara otomatis dengan menggunakan ?', 'Mailings ; Select Recipients ', 'References ; Select Recipients', 'Design ; Select Recipients', 'Insert ; Select Recipients', 'Review ; Select Recipients', 'A'),
	(137, 'word3', NULL, 'Ketika kita telah memilih file yang berisi penerima surat, selanjutnya adalah mengisikan field pada baris yang dibuat sebelumnya dengan menggunakan tombol ?', 'Insert Merge Field', 'Greeting Line', 'Address Block', 'Start Mail Merge', 'Select Recipients', 'A'),
	(138, 'word3', NULL, 'Untuk melihat hasil Mail Merge atau Select Recipient setelah dilakukan Insert Merge Files, dapat menggunakan tombol?', 'Preview Result', 'Find Recipient', 'Check for Errors', 'Finish & Merge', 'Insert Merge Field', 'A'),
	(139, 'word3', NULL, 'Semua tipe file yang ada pada jawaban bisa digunakan sebagai source list nama dan alamat daftar penerima Mail Merge, kecuali ?', '.jpg', '.xls', '.html', ' .mdb', '.rtf', 'A'),
	(140, 'word3', NULL, 'Untuk mengakhiri Mail Merge dan mulai mengedit secara manual per halaman/dokumen, hasil dari Mail Merge dapat menggunakan tools ?', 'Edit Individual Documents', 'Print Documents', 'Send E-mail Messages', 'Finish & Merge', 'Send Email', 'A'),
	(141, 'word3', NULL, 'Untuk mencetak Mail Merge dari range record tertentu kita dapat memilih opsi apakah ?', 'From:                To:', 'Current record', 'All', 'OK', 'Cancel', 'A'),
	(142, 'word3', NULL, 'Untuk memasukkan kolom nama atau alamat pada Mail Merge maka perlu menekan tombol ?', 'Insert Merge Field', 'Greeting Line', 'Address Block', 'Highlight Merge Fields', 'Select Recipients', 'A'),
	(143, 'word3', NULL, 'Untuk mulai membuat Mail Merge, kita menggunakan tools yang berada di dalam Tab apakah ?', 'Mailings', 'Insert', 'Design', 'References', 'View', 'A'),
	(144, 'word3', NULL, 'Untuk langsung mengirim hasil Mail Merge melalui email tanpa mencetak, kita melakukan langkah apa saja ?', 'Klik Finish & Merge ; Klik Edit Individual Documents', 'Klik Finish & Merge ; Klik Print Documents', 'Klik Finish & Merge ; Klik Send Email Messages', 'Klik Start Mail Merge ; Klik Email Messages', 'Klik Start Mail Merge ; Klik Letters', 'C'),
	(145, 'word3', NULL, 'Tombol Preview Results di dalam Tab Mailings berfungsi untuk ?', 'Melihat hasil Mail Merge', 'Melihat hasil insert gambar', 'Melihat gambar bergerak', 'Memutar video di dalam Mail Merge', 'Mencetak hasil Mail Merge', 'A'),
	(149, 'excel1', NULL, 'Cara yang singkat untuk mengakses Microsoft Excel 2013 di Windows 8.1?', 'Tekan kombinasi tombol Windows + R & ketikkan Excel 2013', 'Tekan tombol Windows & ketikkan Excel 2013', 'Klik Start ; pilih All Programs ; pilih Microsoft Office 2013 ; klik Excel 2013', 'Tekan kombinasi tombol Windows + E & pada isian Search ketikkan Excel 2013 lalu jalankan', 'Klik kanan tombol Start ; Klik Programs & Features ; jalankan Excel 2013', 'B'),
	(150, 'excel1', NULL, 'Untuk dapat menampilkan shortcut berupa Abjad seperti pada gambar, maka menggunakan tombol apa?<br><img src="soal excel 1-30.20150802225606.xls-3-K.png"><br>', 'ALT', 'CTRL', 'TAB', 'SHIFT', 'ENTER', 'A'),
	(151, 'excel1', NULL, 'Untuk dapat menggunakan scroll layar satu baris ke arah atas, bawah, kiri dan kanan maka tombol yang harus di aktifkan sebelum tombol arah panah digunakan adalah', 'Num Lock', 'Scroll Lock', 'Home', 'End', 'Insert', 'B'),
	(152, 'excel1', NULL, 'Bagaimana cara yang paling mudah membuat Blank Workbook yang baru?', 'Klik File Tab ; Pilih Tombol New ; klik New Workbook', 'Jalankan aplikasi Excel 2010 lalu pilih Blank Workbook', 'Klik File Tab ; Pilih Tombol New ; klik Open Other Workbooks', 'Jalankan aplikasi Excel 2010 lalu isikan Blank Workbook pada isian Search for online templates', 'Klik File Tab ; Pilih Tombol New ; klik My Template', 'B'),
	(153, 'excel1', NULL, 'Bagaimanakah caranya memeriksa printer yang sudah terinstal pada komputer dengan menggunakan Excel 2013 ?', 'Klik File Tab pada Ribbon Excel 2013 ;Klik Print ; Pastikan Bahwa daftar printer yang ada berstatus Ready ', 'Klik Tombol Windows Menu pada taskbar ; Klik Control Panel ; Klik Printer', 'Klik Ctrl+P ; pilih Properties ; Klik Custom', 'Klik Tombol Windows pada keyboard ; Klik Devices &amp; Printers ; Klik Printer', 'Klik File Tab pada Ribbon Excel 2013 ;Pilih Print ; Klik Print', 'A'),
	(154, 'excel1', NULL, 'Operator apakah yang digunakan untuk menggabungkan dua kata menjadi satu?', 'Concatenation (&)', 'Multiplication (*)', 'Exponential (^)', 'Equal to (=)', 'Addition (+)', 'A'),
	(155, 'excel1', NULL, 'Untuk memaksimalkan fungsi help maka dapat menggunakan search engine, dan search engine apakah yang digunakan pada Excel 2013?', 'Dogpile', 'Google', 'Yahoo', 'Altavista', 'Bing', 'E'),
	(156, 'excel1', NULL, 'Yang tidak termasuk dari Format Cell adalah', 'Currency', 'Short Date', 'Time', 'Fraction', 'Formula', 'E'),
	(157, 'excel1', NULL, 'Lihatlah pada gambar, yang dinamakan Name Box adalah pada nomor?<br><img src="soal excel 1-30.20150802225606.xls-10-K.png"><br>', '1', '2', '3', '4', '5', 'A'),
	(158, 'excel1', NULL, 'Lihatlah pada gambar, disebut fungsi apakah yang diberikan tanda lingkaran merah?<br><img src="soal excel 1-30.20150802225606.xls-11-K.png"><br>', 'Formula', 'Conditional Formatting', 'Insert Function', 'Name Box', 'Bold', 'C'),
	(159, 'excel1', NULL, 'Untuk menuliskan operasi penjumlahan pada Excel 2013, maka di nomor berapakah pada gambar tempat untuk menuliskan penjumlahan tersebut?<br><img src="soal excel 1-30.20150802225606.xls-12-K.jpg"><br>', '1', '2', '3', '4', '5', 'B'),
	(160, 'excel1', NULL, 'Tipe Data apakah untuk pernyataan ini "70 Anak" ?', 'Number', 'Alphanumeric Text', 'Formula', 'Function', 'Boolean', 'B'),
	(161, 'excel1', NULL, 'Untuk operasi Hitung =5^3 adalah sama seperti operasi hitung?', '= 5 + 5 + 5', '0', '= 3 + 3 + 3 + 3 + 3', '0', '0', 'B'),
	(162, 'excel1', NULL, 'Manakah operator yang memiliki nilai Precedence yang sama?', '^ , * ', '/ , ^', '+ , =', '& , =', '+  , -', 'E'),
	(163, 'excel1', NULL, 'Berapakah hasil dari operasi hitung yang terlihat pada gambar?<br><img src="soal excel 1-30.20150802225606.xls-16-K.jpg"><br>', '23', '35', '5 * 4 + 3', '32', 'Error', 'C'),
	(164, 'excel1', NULL, 'Termasuk dalam kategori apakah fungsi Sumif?<br><img src="soal excel 1-30.20150802225606.xls-17-K.jpg"><br>', 'Financial ', 'Logical', 'Text', 'Math & Trig', 'Date ', 'D'),
	(165, 'excel1', NULL, 'Untuk Excel 2013, tipe file yang dapat disimpan selain .xlsx adalah', '.pptx', '.docx', '.mdb', '.csv', '.rpt', 'D'),
	(166, 'excel1', NULL, 'Untuk mengganti posisi kertas menjadi landscape, nomor berapakah pada gambar yang digunakan untuk mengganti posisi kertas tersebut?<br><img src="soal excel 1-30.20150802225606.xls-19-K.png"><br>', '1', '2', '3', '4', '5', 'C'),
	(167, 'excel1', NULL, 'Ketika kita ingin melakukan edit pada isi cell maka bisa dilakukan dengan menggunakan tombol ?', 'F1', 'F3', 'F2', 'F4', 'F5', 'C'),
	(168, 'excel1', NULL, 'Apakah fungsi dari Ã¢â‚¬Å“Sort AscendingÃ¢â‚¬Â yang terdapat pada sebuah Microsoft Excel ?', 'Mengacak bilangan', 'Mengurutkan abjad atau angka dari 0-9 / Z-A', 'Mengurutkan abjad atau angka A-Z / 0-9', 'Mengurutkan bilangan 0-9&nbsp; ', 'Mengurutkan abjad Z-A<br>', 'C'),
	(169, 'excel1', NULL, 'Untuk menyimpan file dengan nama file a.xlsx tetapi ingin menyimpan dengan nama file b.xlsx dan isi dokumen sama persis dapat menggunakan perintah ?', 'Pilih Tab File ; Klik Save', 'Tekan kombinasi tombol pada keyboard Ctrl + S', 'Pilih Tab File ; Klik Save As', 'Tekan kombinasi tombol pada keyboard Shift + S', 'Tekan kombinasi tombol pada keyboard Ctrl + O', 'C'),
	(170, 'excel1', NULL, 'Tombol Page Down digunakan untuk ?', 'Berpindah ke bawah sebanyak cell yang terlihat di layar monitor', 'Berpindah ke kanan sebanyak 1 cell', 'Berpindah ke atas sebanyak cell yang terlihat di layar monitor', 'Berpindah ke kiri sebanyak 1 cell', 'Berpindah ke tengah sebanyak 1 cell', 'A'),
	(171, 'excel1', NULL, 'Tombol Ctrl + N berfungsi untuk ?', 'Membuat buku kerja baru', 'Menyimpan buku kerja', 'Menghapus buku kerja', 'Mengubah buku kerja', 'Menyisipkan buku kerja', 'A'),
	(172, 'excel1', NULL, 'Pada jawaban yang termasuk tipe data utama di Excel adalah ?', 'Number', 'Boolean', 'Integer', 'Float', 'Long', 'A'),
	(173, 'excel1', NULL, 'Apabila melakukan delete pada suatu Row maka yang akan terhapus adalah ?', 'Kolom ', 'Baris ', 'Cell', 'Chart', 'Angka', 'B'),
	(174, 'excel1', NULL, 'Untuk meletakkan tulisan di bagian kiri cell menggunakan ?', 'Align Right', 'Align Left', 'Center', 'Top ', 'Bottom', 'B'),
	(175, 'excel1', NULL, 'Yang bukan termasuk operator aritmatika adalah ?', '>', '+', '/', ':', 'Ã¢â‚¬â€œ', 'A'),
	(176, 'excel1', NULL, 'Operator logika <> memiliki fungsi ?', 'Lebih Besar', 'Lebih Kecil', 'Sama Dengan', 'Pangkat', 'Tidak sama dengan', 'E'),
	(177, 'excel1', NULL, 'Berapakah Hasil dari operasi aritmatika ini : 2+4*3^1 ?', '20', '10', '12', '18', '14', 'E'),
	(178, 'excel1', NULL, 'Untuk fungsi pangkat menggunakan operator aritmatika apa ?', '-', '+', '/', '*', '^', 'E'),
	(179, 'excel1', NULL, 'Yang termasuk operator logika adalah?', '>', '<', '=', '<>', 'Semua Jawaban Benar', 'E'),
	(180, 'excel1', NULL, 'Manakah jawaban yang tepat apabila ada suatu operasi hitung : =2*3^1/3 ?', '1', '2', '3', '4', '5', 'B'),
	(181, 'excel1', NULL, 'Bagaimanakah cara membuat sebuah salinan data dalam sebuah sheet yang disalin ke sebuah sheet baru?<br><img src="soal excel 31-60.20150802225845.xls-4-K.jpg"><br>', 'Arahkan pointer mouse ke sheet yang akan di salin ; Klik kanan lalu pilih Move Collected sheets To book : ;  pilih "new book" ; pilih OK', 'Arahkan pointer mouse ke sheet yang akan di salin ; Klik kanan lalu pilih "Before Sheet :" ;  pilih (Move to End) ; pilih OK', 'Arahkan pointer mouse ke sheet yang akan di salin ; Klik kanan lalu pilih Move Collected sheets To book : ;  pilih "new book" ; Centang "Create a Copy" ; pilih OK', 'Arahkan pointer mouse ke sheet yang akan di salin ; Klik kanan lalu pilih "Before Sheet :" ;  pilih OK', 'Arahkan pointer mouse ke sheet yang akan di salin ; Klik kanan lalu pilih Arahkan pointer mouse ke sheet yang akan di salin ; Klik kanan lalu pilih "Before Sheet :" ; pilih OK<br><br>', 'C'),
	(182, 'excel1', NULL, 'Bagaimanakah cara menggunakan fungsi filter pada tabel data penjualan?<br><img src="soal excel 31-60.20150802225845.xls-5-K.jpg"><br>', 'Blok semua Cell yang paling atas pada tabel ke arah horizontal ; Klik Tab Data ; Klik Tombol Filter ', 'Blok semua Cell yang paling atas pada tabel ke arah vertikal ; Klik Tab Data ; Klik Tombol Filter', 'Blok semua Cell yang paling bawah pada tabel ke arah horizontal ; Klik Tab Data ; Klik Tombol Filter ', 'Blok semua Cell yang paling bawah pada tabel ke arah vertikal ; Klik Tab Data ; Klik Tombol Filter', 'Blok semua Cell pada suatu tabel ; Klik Tab Data ; Klik Tombol Filter', 'A'),
	(183, 'excel1', NULL, 'Bagaimanakah cara menggunakan Remove Duplicates pada kolom Reseller?<br><img src="soal excel 31-60.20150802225845.xls-6-K.jpg"><br>', 'Blok semua kolom Reseller ; Klik Tab File ; Klik Remove Duplicates', 'Blok semua kolom Reseller ; Klik Tab Home ; Klik Remove Duplicates', 'Blok semua kolom Reseller ; Klik Tab Insert ; Klik Remove Duplicates', 'Blok semua kolom Reseller ; Klik Tab Formula ; Klik Remove Duplicates', 'Blok semua kolom Reseller ; Klik Tab Data ; Klik Remove Duplicates', 'E'),
	(184, 'excel1', NULL, 'Yang tidak termasuk bagian dari fungsi Autosum adalah', 'Sum', 'Average', 'Max', 'Min', 'Vlookup', 'E'),
	(185, 'excel1', NULL, 'Kombinasi tombol apakah yang digunakan untuk membuat worksheet baru dengan cepat?', 'Shift + F12', 'Shift + F1', 'Shift + F4', 'Shift + F11', 'Shift + F8', 'D'),
	(186, 'excel1', NULL, 'Tombol apakah yang digunakan untuk membuat suatu cell menjadi Absolute misal =max($B$1:$B$12)?', 'F5', 'F6', 'F7', 'F4', 'F12', 'D'),
	(187, 'excel1', NULL, 'Yang bukan termasuk kategori dari Math &amp; Trig pada Tab Formula adalah', 'Sumif', 'Sumifs', 'Sum', 'Count', 'Subtotal', 'D'),
	(188, 'excel1', NULL, 'Apakah kegunaan dari formula bar?', 'Tempat kita memasukkan kata kata yang akan kita cari', 'Tempat kita untuk memasukkan nama sebuah file yang akan kita simpan', 'Tempat kita memasukkan informasi ke dalam cell', 'Tempat kita memilih daftar chart yang akan kita gunakan', 'Tempat kita memilih rumus yang akan kita gunakan', 'C'),
	(189, 'excel1', NULL, 'Fungsi yang digunakan untuk menampilkan data dengan kriteria yang telah ditentukan adalah?', 'Ascending', 'Descending', 'SUM', 'Filter', 'IF', 'D'),
	(190, 'excel1', NULL, 'Reference yang mempunyai nilai tetap disebut dengan?', 'Absolute Reference', 'Advanced Filter ', 'Replace', 'Find', 'Editing', 'A'),
	(191, 'excel1', NULL, 'Untuk membuat Chart seperti pada gambar, Cell mana sajakah yang perlu di sertakan ketika membuat chart?<br><img src="soal excel 31-60.20150802225845.xls-14-K.jpg"><br>', 'K2:L7', 'L2:L7', 'K2:K7', 'K2:L2', 'K3:L5', 'A'),
	(192, 'excel1', NULL, 'Termasuk dalam tipe Chart apakah Chart yang terdapat pada gambar?<br><img src="soal excel 31-60.20150802225845.xls-15-K.jpg"><br>', 'Pie', 'Bar', 'Area', 'Column', 'Line', 'D'),
	(193, 'excel1', NULL, 'Pada Pie Chart ada berbagai macam tipe dan yang nampak pada gambar adalah <br><img src="soal excel 31-60.20150802225845.xls-16-K.jpg"><br>', 'Doughnut', 'Pie of Pie', 'Bar of Pie', 'Pie', '3-D Pie', 'E'),
	(194, 'excel1', NULL, 'Untuk Menghilangkan Judul Total Penjualan pada Chart, maka pada Pilihan Add Chart Element manakah yang perlu di pilih?<br><img src="soal excel 31-60.20150802225845.xls-17-K.jpg"><br>', 'Chart title', 'DataTitle', 'Data Table', 'Legend', 'Lines', 'A'),
	(195, 'excel1', NULL, 'Pada gambar, nomor berapakah yang berfungsi sebagai remove decimal?<br><img src="soal excel 31-60.20150802225845.xls-18-K.jpg"><br>', '1', '2', '3', '4', '5', 'A'),
	(196, 'excel1', NULL, 'Bagaimanakah cara untuk menambahkan suatu data tambahan pada Chart yang sebelumnya sudah di buat?<br><img src="soal excel 31-60.20150802225845.xls-19-K.jpg"><br>', 'Klik Chart yang sudah ada ; pilih tab Design ; Klik Collect Data ; Pada tampilan Collect Data Source masukkan data secara manual dengan tombol Add', 'Klik Chart yang sudah ada ; pilih tab Format ; Klik Collect Data ; Pada tampilan Collect Data Source masukkan data secara manual dengan tombol Add', 'Klik Chart yang sudah ada ; pilih tab Design ; Klik Format ; Pada tampilan Collect Data Source masukkan data secara manual dengan tombol Add', 'Klik Chart yang sudah ada ; Klik Collect Data ; pilih tab Design ; Pada tampilan Collect Data Source masukkan data secara manual dengan tombol Add', 'Klik Chart yang sudah ada ; Klik Collect Data ; pilih tab Format ; Pada tampilan Collect Data Source masukkan data secara manual dengan tombol Add', 'A'),
	(197, 'excel1', NULL, 'Apabila ingin mengganti Background suatu Chart, maka yang harus dipilih adalah<br><img src="soal excel 31-60.20150802225845.xls-20-K.jpg"><br>', 'Shape Outline', 'Solid Fill', 'Text Box', 'Chart Style', 'Angle Axis', 'B'),
	(198, 'excel1', NULL, 'Pada 3D Rotation, pilihan manakah yang harus dihilangkan agar tampilan chart tampak seperti tampilan 3D?<br><img src="soal excel 31-60.20150802225845.xls-21-K.jpg"><br>', 'Center Angle Axis', 'Left Angle Axis', 'Right Angle Axis', 'Bottom Angle Axis', 'Top Angle Axis', 'C'),
	(199, 'excel1', NULL, 'Untuk merubah tampilan digit angka seperti pada gambar, maka pada Axis Options yang perlu di rubah tampilan nilainya menjadi Thousand adalah<br><img src="soal excel 31-60.20150802225845.xls-22-K.jpg"><br>', 'Bounds Minimum', 'Units Major', 'Axis Value', 'Display Units', 'Logarithmic Scale', 'D'),
	(200, 'excel1', NULL, 'Untuk menjadikan garis target menjadi putus-putus yang nampak pada gambar, maka yang perlu dirubah adalah pada pilihan?<br><img src="soal excel 31-60.20150802225845.xls-23-K.jpg"><br>', 'Join Type', 'Cap Type', 'Compound Type', 'Width', 'Dash Type', 'E'),
	(201, 'excel1', NULL, 'Untuk memindahkan Chart ke Sheet yang sudah ada, maka yang perlu dipilih pada opsi Move Chart adalah', 'New Sheet ', 'Existing Sheet', 'Blank Sheet', 'Object In', 'Recently Sheet', 'D'),
	(202, 'excel1', NULL, 'Tab yang digunakan untuk mengatur halaman suatu dokumen adalah', 'Normal ', 'Page Break Preview', 'Page Layout', 'Custom Views', 'Simple Layout', 'C'),
	(203, 'excel1', NULL, 'Untuk membuat tampilan 3D Pie Chart menjadi lebih atraktif dengan memisahkan potongan 3D Pie Chart, maka opsi yang perlu dipilih adalah<br><img src="soal excel 31-60.20150802225845.xls-26-K.jpg"><br>', 'Angle of first slice', 'Point Explosion', 'Material', 'Contour', 'Bottom bevel', 'B'),
	(204, 'excel1', NULL, 'Apabila suatu tabel akan di buat suatu Chart, tetapi bingung untuk memilih bentuk Chart maka dapat menggunakan fungsi ?', 'Recommended Chart', 'Pivot Chart', 'Power View', 'Recommended Pivot Tables', 'Illustrations', 'A'),
	(205, 'excel1', NULL, 'Ketika meng-klik suatu Chart maka akan muncul Tab Design, dan yang bukan termasuk bagian Tab Design adalah', 'Add Chart Element', 'Change Chart Type', 'Quick Layout', 'Shape Fill', 'Chart Styles', 'D'),
	(206, 'excel1', NULL, 'Ketika meng-klik suatu Chart maka akan muncul Tab Format dan yang bukan termasuk bagian Tab Format adalah', 'Shape Effects', 'Shape Outline', 'Quick Layout', 'Shape Fill', 'Shape Styles', 'D'),
	(207, 'excel1', NULL, 'Untuk mengubah satuan ukuran di dalam Excel, digunakan perintah?', 'Klik kanan pada Mouse lalu pilih Format Cells  ; Pilih Number ; Pilih Currency ; Pilih Symbol ', 'Pilih Tools ; Pilih Options ; Pilih Print', 'Pilih File Tab ; Pilih Open', 'Pilih File Tab ; Pilih Excel Options ; Pilih Save ; pilih Default File Location', 'Pilih File Tab ; Pilih Excel Options ; pilih Advanced ; Pilih Display ; Pilih Ruler Units', 'A'),
	(208, 'excel1', NULL, '', '', '', '', '', '', ''),
	(212, 'ppoint1', NULL, 'Untuk Menampilkan Slide halaman pertama, dapat menggunakan tombol apa ?', 'F6', 'F5', 'Shift + F5', 'Ctrl + V', 'Ctrl + C', 'B'),
	(213, 'ppoint1', NULL, 'Menu Tab yang hanya ada di Microsoft Power Point tetapi tidak ada di Microsoft Excel adalah', 'Menu Home', 'Menu View', 'Menu SlideShow', 'Menu Insert', 'Menu Review', 'C'),
	(214, 'ppoint1', NULL, 'Kita dapat membuat desain slide theme sendiri dan dapat digunakan berulang kali, di sebut juga dengan ?', 'Slide Template', 'Slide Transition', 'Slide Layout', 'Slide Preview', 'Slide Package', 'A'),
	(215, 'ppoint1', NULL, 'Jika ingin membuat sebuah file presentasi powerpoint baru dan bebas menentukan sendiri seluruh format, slide design, slide layout maka hendaknya memilih ?', 'blank presentation', 'theme template', 'design template', 'autocontent wizard', 'new presentation', 'A'),
	(216, 'ppoint1', NULL, 'Tab yang berisi fungsi untuk mengubah transisi slide dengan efek audio dan visual adalah', 'Animations', 'Slide Show', 'Transitions', 'Design', 'Insert', 'C'),
	(217, 'ppoint1', NULL, 'Menu yang berfungsi sebagai preview untuk semua slide disebut juga dengan ?', 'View Pane', 'Notes Pane', 'Normal View', 'Slides/Outline Pane', 'Slide Sorter View', 'D'),
	(218, 'ppoint1', NULL, 'Apabila ingin menambahkan gambar pada slide tanpa perlu menutupi tulisan pada slide tersebut adalah', 'Send to Back', 'Bring to Front', 'Insert Picture', 'Remove Background', 'Smart Art', 'A'),
	(219, 'ppoint1', NULL, 'Untuk melakukan Transparansi gambar atau text pada PowerPoint 2013 terdapat di dalam menu?', 'Shape Fill', 'Colours', 'Animations', 'Transitions', 'Picture', 'B'),
	(220, 'ppoint1', NULL, 'Jika kita ingin menambahkan berbagai macam bentuk objek misal bentuk oval, maka pada slide maka kita bisa memilih menu?', 'Shapes', 'Table', 'Word Art', 'Smart Art', 'Chart', 'A'),
	(221, 'ppoint1', NULL, 'Untuk membuat slide baru kita bisa menggunakan kombinasi tombol, yaitu?', 'Ctrl + Enter', 'Alt + F4', 'Alt + Tab', 'Shift + Enter', 'Alt + Enter', 'A'),
	(222, 'ppoint1', NULL, 'Untuk menyisipkan struktur organisasi ke dalam slide Powerpoint dapat menggunakan fitur ?', 'Grafik', 'Smart Art', 'Comment', 'Page Number', 'Chart', 'B'),
	(223, 'ppoint1', NULL, 'Yang bukan merupakan kategori Text Effects yang terdapat pada Microsoft Power Point ?', 'Shadow', 'Reflection', 'Glow', 'Embose', '3-D Rotation', 'D'),
	(224, 'ppoint1', NULL, 'Yang dapat dilakukan dengan fitur Correction untuk gambar pada Power Point adalah untuk mengatur?', 'Brigthness/Contrast', 'Artistic Effect', 'Picture border', 'Align left', 'Crop', 'A'),
	(225, 'ppoint1', NULL, 'Fitur yang dapat digunakan dalam fitur Color pada tab Format Picture adalah?', 'Color Saturation', 'Sharpen/Soften', 'Brightness/Contrast', 'Reset Picture', 'Compress Picture', 'A'),
	(226, 'ppoint1', NULL, 'Untuk memberi efek pada gambar agar terlihat lebih tajam atau blur pada Power Point, dapat menggunakan fitur?', 'Brightness/Contrast', 'Color Tone', 'Crop', 'Sharpen/Soften', 'Saturation', 'D'),
	(227, 'ppoint1', NULL, 'Jawaban berikut ini adalah beberapa fungsi fitur Color pada Tab Format untuk Picture, kecuali ?', 'Remove background', 'Set Transparent Color', 'Color Tone', 'Recolor', 'Color Saturation', 'A'),
	(228, 'ppoint1', NULL, 'Untuk memberikan effect seperti Sketch, Paint Brush, Watercolor dan Pencil ketika klik suatu gambar di Power Point, dapat menggunakan fitur?', 'Artistic Effect', 'Correction', 'Color', 'Picture Border', 'Picture Layout', 'A'),
	(229, 'ppoint1', NULL, 'Ketika Anda menambahkan gambar, Picture Effects yang dapat digunakan untuk memberikan efek 3D pada gambar adalah?', 'Soft Edges', 'Reflection', '3D Rotation', 'Glow', 'Shadow', 'C'),
	(230, 'ppoint1', NULL, 'Salah satu fungsi Remove Background yang digunakan untuk menghapus obyek gambar tertentu, dapat menggunakan menu?', 'Mark Areas to Keep', 'Mark Areas to Remove', 'Delete Mark', 'Discard All Changes', 'Keep Changes', 'B'),
	(231, 'ppoint1', NULL, 'Tipe Smart Art yang dapat digunakan dalam Power Point, kecuali?', 'List', 'Process', 'Hierarchy', 'Cycle', 'Chart', 'E'),
	(232, 'ppoint1', NULL, 'Pada tab Design untuk Smart Art, menu untuk mengembalikan pengaturan design Smart Art menjadi default adalah?', 'Add Shape', 'Change Colors', 'Reset Graphic', 'Convert', 'Change Shape', 'C'),
	(233, 'ppoint1', NULL, 'Tombol untuk menampilkan panel text agar lebih mudah mengedit text pada Smart Art adalah?', 'Text Pane', 'Right to Left', 'Add Bullet', 'Move Up', 'Move Down', 'A'),
	(234, 'ppoint1', NULL, 'Untuk memindahkan bagian Smart Art ke hierarki yang berada diatasnya, dapat menggunakan tombol?', 'Promote', 'Demote', 'Text Pane', 'Right to Left', 'Add Bullet', 'A'),
	(235, 'ppoint1', NULL, 'Untuk memindahkan bagian Smart Art ke hierarki yang berada dibawahnya, dapat menggunakan tombol?', 'Promote', 'Demote', 'Text Pane', 'Right to Left', 'Add Bullet', 'B'),
	(236, 'ppoint1', NULL, 'Untuk merubah Smart Art menjadi text pada Power Point, dapat menggunakan tombol?', 'Convert to Text', 'Convert to Shape', 'Change Colors', 'Add Shape', 'Text Pane', 'A'),
	(237, 'ppoint1', NULL, 'Untuk menambahkan shape secara manual di Smart Art pada Power Point dapat menggunakan tombol?', 'Add Shape', 'Demote', 'Promote', 'Move up', 'Move Down', 'A'),
	(238, 'ppoint1', NULL, 'Untuk menukar posisi bagian Smart Art dari sebelah kanan menjadi ke sebelah kiri dan sebaliknya beserta hierarki dibawahnya sekaligus , dapat menggunakan tombol?', 'Promote', 'Demote', 'Text Pane', 'Right to Left', 'Add Bullet', 'D'),
	(239, 'ppoint1', NULL, 'Untuk merubah bentuk shape pada Smart Art di Power Point, dapat menggunakan tombol?', 'Change Shape', 'Larger', 'Smaller', 'Shape Fill', 'Shape Effect', 'A'),
	(240, 'ppoint1', NULL, 'Beberapa tipe Chart yang dapat digunakan, kecuali?', 'Column', 'Line', 'Legend', 'Pie', 'Bar', 'C'),
	(241, 'ppoint1', NULL, 'Untuk merubah tipe Chart, pada tab Design dapat menggunakan fungsi ?', 'Change Chart Type', 'Edit Data', 'Select Data', 'Quick Layout', 'Add Chart Element', 'A'),
	(242, 'ppoint1', NULL, 'Pada tab Design, dapat dilakukan perubahan chart data dengan menggunakan fungsi ?', 'Select Data', 'Edit Data', 'Change Colors', 'Format Data Labels', 'Format Data Series', 'B'),
	(243, 'ppoint1', NULL, 'Fungsi pada tab Design untuk memilih data yang akan digunakan pada chart adalah', 'Change Chart Type', 'Edit Data', 'Quick Layout', 'Select Data', 'Switch Row/Column', 'D'),
	(244, 'ppoint1', NULL, 'Untuk merubah Chart Layout pada Power Point, dapat menggunakan tombol ?', 'Quick Layout', 'Add Chart Element', 'Quick Page Layout', 'Change Colors', 'Change Chart Type', 'A'),
	(245, 'ppoint1', NULL, 'Opsi pilihan animasi untuk membuat efek tulisan membesar saat presentasi ada pada bagian?<br>', 'None', 'Entrance', 'Emphasis', 'Exit', 'Semua Jawaban Salah', 'C'),
	(246, 'ppoint1', NULL, 'Kita dapat memainkan video secara otomatis di dalam slide saat presentasi dijalankan dengan mengaktifkan opsi ?', 'Start Automatically', 'Play', 'Trim Video', 'Fade In', 'Rewind after Playing', 'A'),
	(247, 'ppoint1', NULL, 'Tool apakah yang digunakan untuk memotong durasi video yang di sertakan pada suatu slide ?', 'Play', 'Fade In', 'Fade Out', 'Trim Video', 'Rewind after Playing', 'D'),
	(248, 'ppoint1', NULL, 'Agar musik yang dimasukkan ke slide dapat diputar terus-menerus tanpa henti saat presentasi, kita harus mengaktifkan opsi ?', 'Hide During Show', 'Fade In', 'Loop until Stopped', 'Rewind after Playing', 'Volume', 'C'),
	(249, 'ppoint1', NULL, 'Opsi untuk memasukkan suara berupa musik ke dalam slide adalah', 'Insert Audio', 'Insert Music', 'Insert Video', 'Insert Animation', 'Insert PPT', 'A'),
	(250, 'ppoint1', NULL, 'Tool untuk mengedit animasi berada pada Tab ?', 'Animations', 'Transition', 'Slide Show', 'Design', 'View', 'A'),
	(251, 'ppoint1', NULL, 'Termasuk kategori apakah animasi untuk membuat objek di dalam slide bergerak ?', 'Entrance', 'Emphasis', 'Exit', 'Motion Paths', 'Fly In', 'A'),
	(252, 'ppoint1', NULL, 'Saat presentasi, untuk berpindah ke slide selanjutnya dapat menggunakan ?', 'Tombol Enter', 'Tombol spasi', 'Tombol panah kanan', 'Tombol Huruf N', 'Semua Jawaban Benar', 'E'),
	(253, 'ppoint1', NULL, 'Efek animasi yang digunakan untuk memperbesar objek di dalam slide adalah', 'Grow', 'Pulse', 'Fade', 'Float In', 'Spin', 'A'),
	(254, 'ppoint1', NULL, 'Apakah fungsi tombol yang ada pada gambar ?<br><img src="soal ppt 31-60.20150802231741.xls-14-K.jpg"><br>', 'Menjalankan animasi', 'Memutar musik', 'Memutar video', 'Memulai presentasi', 'Semua Jawaban Salah ', 'A'),
	(255, 'ppoint1', NULL, 'Untuk membuat animasi objek terbang dari luar ke dalam slide dapat menggunakan efek ?', 'Fly In', 'Fly Out', 'Fly by Wire', 'Jump In', 'Jump Out', 'A'),
	(256, 'ppoint1', NULL, 'Untuk membuat animasi perpindahan antar slide terdapat pada tab?<br><br>', 'Design', 'Transitions', 'Animations', 'Slide Show', 'Review', 'B'),
	(257, 'ppoint1', NULL, 'Pada opsi pilihan Save, tipe file apa sajakah yang dapat disimpan oleh Power Point', 'Semua Jawaban Benar', 'PDF', 'JPG', 'PPTX', 'PPT', 'A'),
	(258, 'ppoint1', NULL, 'Untuk memasukkan file .mp3 ke dalam slide dapat menggunakan tool ?', 'Insert Audio', 'Insert Music', 'Insert Video', 'Insert Picture', 'Insert File', 'A'),
	(259, 'ppoint1', NULL, 'Kombinasi tombol apakah yang dapat digunakan untuk menampilkan presentasi yang sedang dibuka ?', 'Shift-F5', 'Shift-F9', 'Ctrl-C', 'Ctrl-V', 'Ctrl-Alt-Del', 'A'),
	(260, 'ppoint1', NULL, 'Apabila memilih efek animasi Ã¢â‚¬ËœNoneÃ¢â‚¬â„¢ maka yang terjadi dengan objek adalah', 'Diam saja', 'Membesar', 'Mengecil', 'Kedip-kedip', 'Terbang keluar slide', 'A'),
	(261, 'ppoint1', NULL, 'Print Ã¢â‚¬ËœHandoutsÃ¢â‚¬â„¢ di dalam PowerPoint 2013 berguna untuk ?', 'Mencetak Handout untuk peserta presentasi', 'Mencetak presentasi dalam bentuk poster ', 'Mencetak komentar di dalam slide', 'Mencetak gambar di dalam slide tanpa disertai text', 'Mencetak slide dalam resolusi yang tinggi', 'A'),
	(262, 'ppoint1', NULL, 'Fungsi Ã¢â‚¬ËœHide SlideÃ¢â‚¬â„¢ adalah untuk ?', 'Menyembunyikan slide', 'Menyembunyikan Gambar', 'Menyembunyikan Text', 'Menyembunyikan Suara', 'Menyimpan Slide', 'A'),
	(263, 'ppoint1', NULL, 'Untuk merekam seluruh kegiatan saat presentasi dijalankan berada di dalam Tab ?', 'Slide Show', 'Design', 'Animation', 'Transition', 'Review', 'A'),
	(264, 'ppoint1', NULL, 'Animasi pada kategori Ã¢â‚¬ËœExitÃ¢â‚¬â„¢ dipergunakan untuk membuat animasi saat objek akan ?', 'Muncul', 'Hilang', 'Bergerak', 'Berubah', 'Diam', 'B'),
	(265, 'ppoint1', NULL, 'Untuk membuat animasi dengan gerakan objek yang terbang keluar dari slide menggunakan efek ?', 'Fly Out', 'Fly In', 'Jump Out', 'Jump in', 'Move Out', 'A'),
	(266, 'ppoint1', NULL, 'Untuk membuat animasi dengan gerakan objek bergerak bebas sesuai yang kita inginkan menggunakan efek ?', 'Custom Path', 'Straight Path', 'Shape Path', 'My Path', 'Loop Path', 'A'),
	(267, 'ppoint1', NULL, 'Termasuk dalam kategori apakah, efek yang digunakan untuk membuat animasi saat sebuah objek muncul di dalam Slide ?', 'Entrance Effects', 'Emphasis Effects', 'Exit Effects', 'Motion Paths', 'Disappear Effects', 'A'),
	(268, 'ppoint1', NULL, 'Manakah di bawah ini yang merupakan property dari slide transitions ?', 'Agenda', 'Timing', 'Spacing', 'Line Space', 'Margin', 'B'),
	(269, 'ppoint1', NULL, 'Fungsi apakah yang digunakan untuk melihat pratinjau dokumen sebelum dokumen tersebut di cetak ?', 'Normal View', 'Slideshow view', 'Reading view', 'Outline view', 'Print preview', 'E'),
	(270, 'ppoint1', NULL, 'Yang termasuk opsi pilihan pada Video adalah', 'Online Video ', 'Movie on My PC', 'Play Movie', 'Play Media', 'Semua Jawaban Salah', 'A'),
	(271, 'ppoint1', NULL, 'Di sebut menu apakah yang terlihat pada gambar ? <br><img src="soal ppt 31-60.20150802231741.xls-31-K.jpg"><br>', 'Trigger', 'Animation Pane', 'Animation Painter', 'Animation Preview', 'Reorder Animation', 'B');
/*!40000 ALTER TABLE `exam_source` ENABLE KEYS */;

-- Dumping structure for table db_exam.exam_source_tmp
CREATE TABLE IF NOT EXISTS `exam_source_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT',
  `row_reff` int(11) NOT NULL,
  `kode_mapel` varchar(255) NOT NULL,
  `pertanyaan` varchar(1024) NOT NULL,
  `jawab_a` varchar(255) NOT NULL,
  `jawab_b` varchar(255) NOT NULL,
  `jawab_c` varchar(255) NOT NULL,
  `jawab_d` varchar(255) NOT NULL,
  `jawab_e` varchar(255) NOT NULL,
  `kunci` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL COMMENT '1:easy,2:medium,3:hard',
  `import_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.exam_source_tmp: ~0 rows (approximately)
/*!40000 ALTER TABLE `exam_source_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_source_tmp` ENABLE KEYS */;

-- Dumping structure for table db_exam.online_student
CREATE TABLE IF NOT EXISTS `online_student` (
  `no` int(11) NOT NULL,
  `id_students` varchar(45) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.online_student: ~0 rows (approximately)
/*!40000 ALTER TABLE `online_student` DISABLE KEYS */;
/*!40000 ALTER TABLE `online_student` ENABLE KEYS */;

-- Dumping structure for table db_exam.programs
CREATE TABLE IF NOT EXISTS `programs` (
  `id_program` varchar(45) NOT NULL,
  `program_name` varchar(45) DEFAULT NULL,
  `sum_question` int(10) DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `margin` enum('1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`id_program`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.programs: ~2 rows (approximately)
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` (`id_program`, `program_name`, `sum_question`, `duration`, `margin`) VALUES
	('P0001', 'Program 2', 90, 90, '1'),
	('P0002', 'Program 1', 90, 90, '2');
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;

-- Dumping structure for table db_exam.program_detail
CREATE TABLE IF NOT EXISTS `program_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_program` varchar(45) NOT NULL,
  `id_subject` varchar(45) NOT NULL,
  `percent` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.program_detail: ~7 rows (approximately)
/*!40000 ALTER TABLE `program_detail` DISABLE KEYS */;
INSERT INTO `program_detail` (`id`, `id_program`, `id_subject`, `percent`) VALUES
	(1, 'P0001', 'word1', 20),
	(2, 'P0001', 'word1', 50),
	(4, 'P0001', 'ppoint1', 30),
	(5, 'P0002', 'word1', 50),
	(6, 'P0002', 'excel1', 20),
	(7, 'P0002', 'ppoint1', 30);
/*!40000 ALTER TABLE `program_detail` ENABLE KEYS */;

-- Dumping structure for table db_exam.students
CREATE TABLE IF NOT EXISTS `students` (
  `idstudents` varchar(50) NOT NULL,
  `fname` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `batch_id` varchar(225) DEFAULT NULL,
  `our_id` varchar(225) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idstudents`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.students: ~11 rows (approximately)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`idstudents`, `fname`, `email`, `batch_id`, `our_id`, `date`) VALUES
	('145050100111081', 'RIZQI ROBI` AULIYA`', NULL, '011118.10.T1', 'C0001.011118.T2', '2018-11-01 11:00:57'),
	('155150207111021', 'MUHAMMAD SHIDQI FADLILAH', NULL, '011118.10.T5', 'C0001.011118.T3', '2018-11-06 10:09:14'),
	('165050109111027', 'MOH IQBAL TAWAKAL', NULL, '311018.09.T33', 'C0005.311018.T1', '2018-10-31 14:36:24'),
	('2342338432', 'Jhon', NULL, '011118.10.T50', 'C0001.011118.T11', '2018-11-06 10:13:09'),
	('2348283923', 'Roni', NULL, '011118.10.T12', 'C0001.011118.T5', '2018-11-06 10:10:08'),
	('2384723347', 'Dani', NULL, '011118.10.T3', 'C0001.011118.T10', '2018-11-06 10:12:42'),
	('2384734322', 'Rico', NULL, '011118.10.T10', 'C0001.011118.T8', '2018-11-06 10:11:51'),
	('2394248232', 'Rani', NULL, '011118.10.T17', 'C0001.011118.T4', '2018-11-06 10:09:42'),
	('3242943932', 'Dio', NULL, '011118.10.T8', 'C0001.011118.T6', '2018-11-06 10:10:39'),
	('3247824632', 'Jean', NULL, '011118.10.T20', 'C0001.011118.T9', '2018-11-06 10:12:13'),
	('3827424408', 'Alex', NULL, '011118.10.T7', 'C0001.011118.T7', '2018-11-06 10:10:39');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table db_exam.students_duplicate_tmp
CREATE TABLE IF NOT EXISTS `students_duplicate_tmp` (
  `file_tmp` varchar(50) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `idstudent` varchar(50) DEFAULT NULL,
  `fname` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.students_duplicate_tmp: ~0 rows (approximately)
/*!40000 ALTER TABLE `students_duplicate_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `students_duplicate_tmp` ENABLE KEYS */;

-- Dumping structure for table db_exam.students_reject_tmp
CREATE TABLE IF NOT EXISTS `students_reject_tmp` (
  `file_tmp` varchar(50) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `idstudent` varchar(50) DEFAULT NULL,
  `fname` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.students_reject_tmp: ~0 rows (approximately)
/*!40000 ALTER TABLE `students_reject_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `students_reject_tmp` ENABLE KEYS */;

-- Dumping structure for table db_exam.students_up_tmp
CREATE TABLE IF NOT EXISTS `students_up_tmp` (
  `file_tmp` varchar(50) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `idstudent` varchar(50) DEFAULT NULL,
  `fname` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.students_up_tmp: ~0 rows (approximately)
/*!40000 ALTER TABLE `students_up_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `students_up_tmp` ENABLE KEYS */;

-- Dumping structure for table db_exam.subject_ls
CREATE TABLE IF NOT EXISTS `subject_ls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_subject` varchar(45) DEFAULT NULL,
  `subject_name` varchar(45) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_subject` (`id_subject`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.subject_ls: ~5 rows (approximately)
/*!40000 ALTER TABLE `subject_ls` DISABLE KEYS */;
INSERT INTO `subject_ls` (`id`, `id_subject`, `subject_name`, `level`) VALUES
	(0, '0', '-', 0),
	(1, 'word1', 'Microsoft Word 1', 1),
	(2, 'excel1', 'Microsoft Excel 1', 1),
	(3, 'ppoint1', 'Power Point 1', 1),
	(4, 'word3', 'Microsoft Word 3', 3);
/*!40000 ALTER TABLE `subject_ls` ENABLE KEYS */;

-- Dumping structure for table db_exam.transact_voucher
CREATE TABLE IF NOT EXISTS `transact_voucher` (
  `id_voucher` varchar(45) NOT NULL,
  `id_customer` varchar(45) DEFAULT NULL,
  `id_program` varchar(45) NOT NULL,
  `quota` varchar(45) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `lastest_topup` date DEFAULT NULL,
  `type_voucher` enum('Prepaid','Postpaid','','') NOT NULL,
  PRIMARY KEY (`id_voucher`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.transact_voucher: ~5 rows (approximately)
/*!40000 ALTER TABLE `transact_voucher` DISABLE KEYS */;
INSERT INTO `transact_voucher` (`id_voucher`, `id_customer`, `id_program`, `quota`, `date_create`, `lastest_topup`, `type_voucher`) VALUES
	('VC0001', 'C0001', 'P0001', '100', '2018-11-03 00:00:00', NULL, 'Prepaid'),
	('VC0002', 'C0003', 'P0002', '50', '2018-11-03 00:00:00', NULL, 'Prepaid'),
	('VC0003', 'C0004', 'P0002', '80', '2018-11-03 08:20:57', NULL, 'Prepaid'),
	('VC0004', 'C0005', 'P0002', '100', '2018-11-07 13:32:12', NULL, 'Prepaid'),
	('VC0005', 'C0005', 'P0001', '25', '2018-11-07 13:33:19', NULL, 'Prepaid');
/*!40000 ALTER TABLE `transact_voucher` ENABLE KEYS */;

-- Dumping structure for table db_exam.upload_report
CREATE TABLE IF NOT EXISTS `upload_report` (
  `id_upload` int(11) NOT NULL,
  `id_uploader` varchar(45) DEFAULT NULL,
  `count_data` varchar(45) DEFAULT NULL,
  `date_upload` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_upload`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.upload_report: ~0 rows (approximately)
/*!40000 ALTER TABLE `upload_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_report` ENABLE KEYS */;

-- Dumping structure for table db_exam.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(50) NOT NULL,
  `fname` varchar(225) DEFAULT NULL,
  `tempat_lahir` varchar(225) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_kartu_id` varchar(125) DEFAULT NULL,
  `type_id` varchar(125) DEFAULT NULL,
  `phone` varchar(125) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `cust_group` varchar(225) DEFAULT NULL,
  `privilege` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.users: ~15 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `fname`, `tempat_lahir`, `tanggal_lahir`, `no_kartu_id`, `type_id`, `phone`, `email`, `alamat`, `cust_group`, `privilege`) VALUES
	('C0000.0', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C0000', NULL),
	('C0001.1', 'Lusi S', 'Jakarta', '2018-10-30', NULL, NULL, '+62 88 45', 'splashtrick@gmail.com', 'Surabya', 'C0001', 'PIC'),
	('C0001.2', 'Imam Fahktur Rozi\'', NULL, NULL, NULL, NULL, '123', 'audit@example.com', 'surabaya', 'C0001', 'PIC'),
	('C0001.3', 'Martono', 'Surabaya', '2018-11-06', NULL, NULL, '131', 'zacedev@gmail.com', 'Surabaya', 'C0001', 'Exam Administrator'),
	('C0001.4', 'Alan', 'Surabaya', '0000-00-00', NULL, NULL, '+63', 'audit@example.com', 'n', 'C0001', NULL),
	('C0001.5', 'test', 'test', '0000-00-00', NULL, NULL, '123', 'audit@example.com', 'surabaya', 'C0001', NULL),
	('C0001.6', 'imam', 'Surabaya', '0000-00-00', NULL, NULL, '+63', 'audit@example.com', 'surabaya', 'C0001', NULL),
	('C0002.1', 'Sari W', 'Surabaya', '2018-10-25', '2', '2', '+62', 'splashtrick@gmail.com', 'Surabya', 'C0002', 'PIC'),
	('C0002.2', 'sd', '12', '0000-00-00', NULL, NULL, '12', 'ss', 'xs', 'C0002', NULL),
	('C0002.3', 'sd', '12', '0000-00-00', NULL, NULL, '12', 'ss', 'xs', 'C0002', NULL),
	('C0002.4', 'sd', '12', '0000-00-00', NULL, NULL, '12', 'ss', 'xs', 'C0002', NULL),
	('C0002.5', 'sd', '12', '0000-00-00', NULL, NULL, '12', 'ss', 'xs', 'C0002', NULL),
	('C0004.1', 'rudi hartono', NULL, NULL, NULL, NULL, '145145', 'audit@example.com', 'surabaya', 'C0004', 'PIC'),
	('C0005.1', 'imron', NULL, NULL, NULL, NULL, '+63', 'name@host.com', 'surabaya', 'C0005', 'PIC'),
	('C0005.2', 'contoh', 'surabaya', '0000-00-00', NULL, NULL, '+62 88 4549845', 'fantasi21@gmail.com', 'surabaya', 'C0005', NULL),
	('C0005.3', 'proctor', 'proctor', '0000-00-00', NULL, NULL, '+62 88 4549845', 'audit@example.com', 'surabaya', 'C0005', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table db_exam.user_test
CREATE TABLE IF NOT EXISTS `user_test` (
  `user_id` varchar(255) NOT NULL,
  `id_peserta` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `prioritas` int(11) NOT NULL,
  `notif` int(11) NOT NULL,
  `eff_date` datetime DEFAULT NULL,
  `id_program` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.user_test: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_test` DISABLE KEYS */;
INSERT INTO `user_test` (`user_id`, `id_peserta`, `status`, `prioritas`, `notif`, `eff_date`, `id_program`) VALUES
	('165050109111027', '165050109111027.1', 1, 1, 0, '2018-11-12 15:20:54', 'P0001');
/*!40000 ALTER TABLE `user_test` ENABLE KEYS */;

-- Dumping structure for table db_exam.voucher_history
CREATE TABLE IF NOT EXISTS `voucher_history` (
  `id_voucher` varchar(45) NOT NULL,
  `exam_code` int(10) NOT NULL,
  `status` enum('Topup','Usage','','') NOT NULL,
  `date` datetime NOT NULL,
  `student_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_exam.voucher_history: ~5 rows (approximately)
/*!40000 ALTER TABLE `voucher_history` DISABLE KEYS */;
INSERT INTO `voucher_history` (`id_voucher`, `exam_code`, `status`, `date`, `student_id`) VALUES
	('VC0001', 0, 'Topup', '2018-11-03 00:00:00', ''),
	('VC0002', 0, 'Topup', '2018-11-03 00:00:00', ''),
	('VC0003', 0, 'Topup', '2018-11-03 08:20:57', ''),
	('VC0004', 0, 'Topup', '2018-11-07 13:32:12', ''),
	('VC0005', 0, 'Topup', '2018-11-07 13:33:19', '');
/*!40000 ALTER TABLE `voucher_history` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
