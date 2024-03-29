-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th3 22, 2024 lúc 05:56 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `student-management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `student_id` char(50) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`account_id`, `student_id`, `password`) VALUES
(1, '4451050225', 'vonguyen123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `activities`
--

INSERT INTO `activities` (`activity_id`, `activity_name`, `description`, `date`, `location`, `notes`) VALUES
(1, 'Chương trình chào tân sinh viên K46', 'Chào mừng các sinh viên khoa CNTT K46', '2023-09-30 00:00:00', 'Hội trường A', ''),
(2, 'Cuộc thi thủ lĩnh sinh viên tỉnh Bình Định', 'Cuộc thi thủ lĩnh sinh viên tỉnh Bình Định tại trường ĐH Quy Nhơn', '2023-09-30 00:00:00', 'Sân công Đoàn', ''),
(3, 'Talkshow Hiên ngang vào đời', 'Tham gia talkshow cùng với các diễn giả đã có kinh nghiệm trong công việc', '2023-10-02 00:00:00', 'Hội trường B', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `phone_number` char(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `phone_number`, `email`, `password`) VALUES
(1, 'Hoàng Đặng Tuấn', '0687563281', 'dangtuan@gmail.com', 'dangtuan123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `notice_title` varchar(255) NOT NULL,
  `notice_message` varchar(1000) NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_title`, `notice_message`, `creation_date`) VALUES
(1, 'Thông báo: Nộp học phí', 'Thời gian nộp học phí: từ ngày 01/05/2024 đến ngày 30/05/2024.', '2024-01-12 00:00:00'),
(2, 'Hoàn thành nhập điểm rèn luyện HKI 2023-2024', 'Hiện tại các khoa đã nhập xong kết quả rèn luyện học kỳ 1, năm học 2023-2024 cho các sinh viên khoá 42 (hệ 4,5 năm). Các sinh viên đăng nhập vào tài khoản cá nhân của mình để kiểm tra, nếu sai sót phản hồi cho khoa của mình trước 9h sáng ngày 15/01/2024.', '2024-01-12 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `student_id` char(15) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `citizen_id_card` char(40) NOT NULL,
  `batch` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `phone_number` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parents_name` varchar(50) NOT NULL,
  `parents_phonenumber` char(10) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`student_id`, `name`, `gender`, `date`, `address`, `citizen_id_card`, `batch`, `class`, `phone_number`, `email`, `parents_name`, `parents_phonenumber`, `status`) VALUES
('4451050215', 'Trịnh Huỳnh Bảo Ngân', 'Female', '2003-12-21 00:00:00', 'Bình Định', '123678459', 44, 'CNTT44B', '0932567283', 'baongan@gmail.com', 'Trịnh Thanh Tân', '0879567374', 'Still learning'),
('4451050225', 'Đoàn Võ Nguyên', 'Male', '2003-04-05 00:00:00', 'Bình Định', '0123456789', 44, 'CNTT44B', '0582967431', 'dvn@gmail.com', 'Đoàn Ngọc Sơn', '0911156305', 'Still leanring');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `study_score`
--

CREATE TABLE `study_score` (
  `score_id` int(10) NOT NULL,
  `student_id` char(15) NOT NULL,
  `subject_id` int(15) NOT NULL,
  `process_score` float NOT NULL,
  `final_score` float NOT NULL,
  `tenscale_score` float NOT NULL,
  `fourscale_score` float NOT NULL,
  `letter_score` char(5) NOT NULL,
  `result` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `study_score`
--

INSERT INTO `study_score` (`score_id`, `student_id`, `subject_id`, `process_score`, `final_score`, `tenscale_score`, `fourscale_score`, `letter_score`, `result`) VALUES
(1, '4451050225', 1010038, 5, 8, 7.1, 3, 'B+', 'https://daotao.qnu.edu.vn/Content/images/Dau.png'),
(2, '4451050225', 1050273, 9.3, 9.5, 9.4, 4, 'A+', 'https://daotao.qnu.edu.vn/Content/images/Dau.png'),
(3, '4451050225', 1050074, 9, 7, 7.6, 3, 'B+', 'https://daotao.qnu.edu.vn/Content/images/Dau.png'),
(4, '4451050225', 1010245, 10, 5, 6.9, 2.5, 'B', 'https://daotao.qnu.edu.vn/Content/images/Dau.png'),
(5, '4451050225', 1090061, 9.9, 8.5, 8.9, 3.5, 'A', 'https://daotao.qnu.edu.vn/Content/images/Dau.png'),
(6, '4451050225', 2030003, 9.2, 8.5, 8.9, 3.5, 'A', 'https://daotao.qnu.edu.vn/Content/images/Dau.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(10) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `credits` int(11) NOT NULL,
  `semester` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `credits`, `semester`) VALUES
(1010038, 'Đại số tuyến tính', 3, 'HKI'),
(1010245, 'Giải tích', 3, 'HKI'),
(1050124, 'Thực hành lắp ráp máy tính', 1, 'HKI'),
(1050273, 'Lập trình cơ bản', 3, 'HKI'),
(1090061, 'Tiếng Anh 1', 3, 'HKI'),
(2030003, 'Kỹ năng giao tiếp', 2, 'HKI');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `training_score`
--

CREATE TABLE `training_score` (
  `ID` int(11) NOT NULL,
  `student_id` char(15) NOT NULL,
  `school_year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `training_score_activities`
--

CREATE TABLE `training_score_activities` (
  `ID` int(11) NOT NULL,
  `student_id` char(15) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `semester` char(5) NOT NULL,
  `proof` mediumblob NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `training_score_activities`
--

INSERT INTO `training_score_activities` (`ID`, `student_id`, `activity_id`, `semester`, `proof`, `status`) VALUES
(1, '4451050225', 1, 'HKI', 0x42e1bab16e672e6a706567, 'Pending');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Chỉ mục cho bảng `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Chỉ mục cho bảng `study_score`
--
ALTER TABLE `study_score`
  ADD PRIMARY KEY (`score_id`);

--
-- Chỉ mục cho bảng `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Chỉ mục cho bảng `training_score`
--
ALTER TABLE `training_score`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `training_score_activities`
--
ALTER TABLE `training_score_activities`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `study_score`
--
ALTER TABLE `study_score`
  MODIFY `score_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `training_score`
--
ALTER TABLE `training_score`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `training_score_activities`
--
ALTER TABLE `training_score_activities`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
