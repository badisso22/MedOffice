-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2026 at 09:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MedOffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `ActivityLog`
--

CREATE TABLE `ActivityLog` (
  `logID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `action` varchar(80) NOT NULL,
  `action_details` text DEFAULT NULL,
  `action_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ActivityLog`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointments`
--

CREATE TABLE `Appointments` (
  `appointmentID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `doctorID` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `appointmentTime` time DEFAULT NULL,
  `time` varchar(5) NOT NULL,
  `purpose` varchar(30) NOT NULL,
  `status` enum('pending','accepted','cancelled','completed') DEFAULT 'pending',
  `cabinetID` int(11) NOT NULL,
  `consultationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Appointments`
--

INSERT INTO `Appointments` (`appointmentID`, `patientID`, `doctorID`, `date`, `appointmentTime`, `time`, `purpose`, `status`, `cabinetID`, `consultationID`) VALUES
(1, 1, 2, '2026-01-20', '10:00:00', '10:00', 'General Consultation', 'pending', 1, NULL),
(2, 1, 2, '2026-01-25', '14:30:00', '14:30', 'Medical Follow-up', 'accepted', 1, NULL),
(3, 2, 3, '2026-02-05', '11:00:00', '11:00', 'Check-up', 'pending', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `AssistantAvailability`
--

CREATE TABLE `AssistantAvailability` (
  `assistantAvailabilityID` int(11) NOT NULL,
  `assistantID` int(11) NOT NULL,
  `dayOfWeek` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `isAvailable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AssistantAvailability`
--

INSERT INTO `AssistantAvailability` (`assistantAvailabilityID`, `assistantID`, `dayOfWeek`, `startTime`, `endTime`, `isAvailable`) VALUES
(1, 1, 'Monday', '08:00:00', '17:00:00', 1),
(2, 1, 'Tuesday', '08:00:00', '17:00:00', 1),
(3, 1, 'Wednesday', '08:00:00', '17:00:00', 1),
(4, 1, 'Thursday', '08:00:00', '17:00:00', 1),
(5, 1, 'Friday', '08:00:00', '17:00:00', 1),
(6, 1, 'Saturday', NULL, NULL, 0),
(7, 1, 'Sunday', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `AssistantProfile`
--

CREATE TABLE `AssistantProfile` (
  `assistantID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `assignedDoctorID` int(11) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `yearsExperience` decimal(3,1) DEFAULT 0.0,
  `employeeCode` varchar(30) DEFAULT NULL,
  `status` enum('available','busy','offline') DEFAULT 'available',
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AssistantProfile`
--

INSERT INTO `AssistantProfile` (`assistantID`, `userID`, `cabinetID`, `assignedDoctorID`, `isActive`, `yearsExperience`, `employeeCode`, `status`, `isArchived`, `createdAt`) VALUES
(1, 6, 1, 2, 1, 3.5, 'ASS001', 'available', 0, '2026-01-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `AssistantShifts`
--

CREATE TABLE `AssistantShifts` (
  `shiftID` int(11) NOT NULL,
  `assistantUserID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `shiftDate` date NOT NULL,
  `startedAt` datetime NOT NULL,
  `endedAt` datetime DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AssistantShifts`
--

INSERT INTO `AssistantShifts` (`shiftID`, `assistantUserID`, `cabinetID`, `shiftDate`, `startedAt`, `endedAt`, `createdAt`) VALUES
(1, 6, 1, '2026-01-06', '2026-01-06 08:00:00', NULL, '2026-01-06 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `AssistantSkills`
--

CREATE TABLE `AssistantSkills` (
  `assistantSkillID` int(11) NOT NULL,
  `assistantID` int(11) NOT NULL,
  `skillName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AssistantSkills`
--

INSERT INTO `AssistantSkills` (`assistantSkillID`, `assistantID`, `skillName`) VALUES
(1, 1, 'Patient Care'),
(2, 1, 'Communication'),
(3, 1, 'EHR Management');

-- --------------------------------------------------------

--
-- Table structure for table `CabinetFacilities`
--

CREATE TABLE `CabinetFacilities` (
  `id` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `facility` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CabinetFacilities`
--

INSERT INTO `CabinetFacilities` (`id`, `cabinetID`, `facility`) VALUES
(1, 1, 'Wheelchair'),
(2, 1, 'Parking'),
(3, 1, 'Lab'),
(4, 2, 'Wheelchair'),
(5, 2, 'Parking');

-- --------------------------------------------------------

--
-- Table structure for table `CabinetInfo`
--

CREATE TABLE `CabinetInfo` (
  `cabinetID` int(11) NOT NULL,
  `cabinetname` varchar(50) NOT NULL,
  `cabinetlocation` text NOT NULL,
  `contact_email` varchar(80) DEFAULT NULL,
  `websiteUrl` varchar(255) DEFAULT NULL,
  `facebookUrl` varchar(255) DEFAULT NULL,
  `instagramUrl` varchar(255) DEFAULT NULL,
  `twitterUrl` varchar(255) DEFAULT NULL,
  `linkedinUrl` varchar(255) DEFAULT NULL,
  `cabinetphonenumber` varchar(15) DEFAULT NULL,
  `cabinetworktime` text DEFAULT NULL,
  `workStartTime` time DEFAULT '09:00:00',
  `workEndTime` time DEFAULT '18:00:00',
  `cabinetspeciality` varchar(50) DEFAULT NULL,
  `cabinetbio` text DEFAULT NULL,
  `subscription_plan` varchar(50) DEFAULT NULL,
  `api_key` varchar(128) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `status` enum('active','suspended','archived') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CabinetInfo`
--

INSERT INTO `CabinetInfo` (`cabinetID`, `cabinetname`, `cabinetlocation`, `contact_email`, `websiteUrl`, `facebookUrl`, `instagramUrl`, `twitterUrl`, `linkedinUrl`, `cabinetphonenumber`, `cabinetworktime`, `workStartTime`, `workEndTime`, `cabinetspeciality`, `cabinetbio`, `subscription_plan`, `api_key`, `is_active`, `status`, `created_at`) VALUES
(1, 'Central Medical Cabinet', '123 Main Street, Central City', 'info@centralmedical.com', 'https://centralmedical.com', NULL, NULL, NULL, NULL, '+1234567890', '08:00-18:00', '08:00:00', '18:00:00', 'General Medicine', 'Professional medical cabinet offering comprehensive healthcare services', 'premium', NULL, 1, 'active', '2026-01-06 10:00:00'),
(2, 'Pediatric Clinic', '456 Oak Avenue, West City', 'pediatric@clinic.com', NULL, NULL, NULL, NULL, NULL, '+1987654321', '09:00-17:00', '09:00:00', '17:00:00', 'Pediatrics', 'Specialized pediatric care for children', 'basic', NULL, 1, 'active', '2026-01-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DoctorAvailability`
--

CREATE TABLE `DoctorAvailability` (
  `availabilityID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `dayOfWeek` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `isAvailable` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DoctorAvailability`
--

INSERT INTO `DoctorAvailability` (`availabilityID`, `doctorID`, `dayOfWeek`, `startTime`, `endTime`, `isAvailable`, `createdAt`) VALUES
(1, 2, 'Monday', '09:00:00', '17:00:00', 1, '2026-01-06 10:00:00'),
(2, 2, 'Tuesday', '09:00:00', '17:00:00', 1, '2026-01-06 10:00:00'),
(3, 2, 'Wednesday', '09:00:00', '17:00:00', 1, '2026-01-06 10:00:00'),
(4, 2, 'Thursday', '09:00:00', '17:00:00', 1, '2026-01-06 10:00:00'),
(5, 2, 'Friday', '09:00:00', '17:00:00', 1, '2026-01-06 10:00:00'),
(6, 3, 'Tuesday', '10:00:00', '18:00:00', 1, '2026-01-06 10:00:00'),
(7, 3, 'Thursday', '10:00:00', '18:00:00', 1, '2026-01-06 10:00:00'),
(8, 3, 'Saturday', '10:00:00', '14:00:00', 1, '2026-01-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DoctorEducation`
--

CREATE TABLE `DoctorEducation` (
  `educationID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `degree` varchar(150) NOT NULL,
  `institution` varchar(150) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DoctorEducation`
--

INSERT INTO `DoctorEducation` (`educationID`, `doctorID`, `degree`, `institution`, `year`, `createdAt`) VALUES
(1, 2, 'MD - Doctor of Medicine', 'State University Medical School', '2015', '2026-01-06 10:00:00'),
(2, 3, 'MD - Doctor of Medicine', 'Central Medical University', '2012', '2026-01-06 10:00:00'),
(3, 3, 'Pediatric Specialization', 'Children\'s Hospital Institute', '2014', '2026-01-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DoctorExperience`
--

CREATE TABLE `DoctorExperience` (
  `experienceID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `DoctorLanguages`
--

CREATE TABLE `DoctorLanguages` (
  `languageID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `language` varchar(80) NOT NULL,
  `proficiency` enum('basic','intermediate','fluent','native') DEFAULT 'fluent',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DoctorLanguages`
--

INSERT INTO `DoctorLanguages` (`languageID`, `doctorID`, `language`, `proficiency`, `createdAt`) VALUES
(1, 2, 'English', 'fluent', '2026-01-06 10:00:00'),
(2, 2, 'Spanish', 'intermediate', '2026-01-06 10:00:00'),
(3, 3, 'English', 'fluent', '2026-01-06 10:00:00'),
(4, 3, 'French', 'basic', '2026-01-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DoctorProfile`
--

CREATE TABLE `DoctorProfile` (
  `doctorID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `speciality` varchar(40) NOT NULL,
  `licenseNumber` varchar(50) DEFAULT NULL,
  `yearsOfExperience` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DoctorProfile`
--

INSERT INTO `DoctorProfile` (`doctorID`, `userID`, `cabinetID`, `speciality`, `licenseNumber`, `yearsOfExperience`, `bio`, `isActive`, `isArchived`, `createdAt`) VALUES
(2, 4, 1, 'General Medicine', 'DOC-2024-001', 12, 'Dr. Michael Thompson is an experienced general practitioner with a passion for patient care and preventive medicine.', 1, 0, '2026-01-06 10:00:00'),
(3, 5, 2, 'Pediatrics', 'DOC-2024-002', 8, 'Dr. Emily Wilson specializes in pediatric care with expertise in vaccinations and child health development.', 1, 0, '2026-01-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DoctorTimeOff`
--

CREATE TABLE `DoctorTimeOff` (
  `timeOffID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EmergencyContact`
--

CREATE TABLE `EmergencyContact` (
  `contactID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FileUploads`
--

CREATE TABLE `FileUploads` (
  `fileID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(40) DEFAULT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT current_timestamp(),
  `attachment_for` varchar(40) DEFAULT NULL,
  `referenceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `InvoiceItems`
--

CREATE TABLE `InvoiceItems` (
  `itemID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `unitPrice` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `taxPercentage` decimal(5,2) DEFAULT 0.00,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Invoices`
--

CREATE TABLE `Invoices` (
  `invoiceID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `issued` date DEFAULT NULL,
  `due` date DEFAULT NULL,
  `paid` tinyint(1) DEFAULT 0,
  `patientID` int(11) DEFAULT NULL,
  `appointmentID` int(11) DEFAULT NULL,
  `invoiceNumber` varchar(50) DEFAULT NULL,
  `taxAmount` decimal(10,2) DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT 0.00,
  `paymentStatus` enum('unpaid','partial','paid') DEFAULT 'unpaid',
  `paymentMethod` varchar(50) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Medications`
--

CREATE TABLE `Medications` (
  `medicationID` int(11) NOT NULL,
  `medicationName` varchar(100) NOT NULL,
  `activeIngredient` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `dosageForm` varchar(50) DEFAULT NULL,
  `strength` varchar(50) DEFAULT NULL,
  `indications` text DEFAULT NULL,
  `contraindications` text DEFAULT NULL,
  `sideEffects` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `recipientID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `attachmentPath` varchar(255) DEFAULT NULL,
  `isRead` tinyint(1) DEFAULT 0,
  `isArchived` tinyint(1) DEFAULT 0,
  `sentTime` datetime DEFAULT current_timestamp(),
  `readTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Notifications`
--

CREATE TABLE `Notifications` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cabinetID` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Notifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `PasswordResets`
--

CREATE TABLE `PasswordResets` (
  `resetID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `used` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PatientAllergies`
--

CREATE TABLE `PatientAllergies` (
  `allergyID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `allergen` varchar(100) NOT NULL,
  `severity` enum('mild','moderate','severe') DEFAULT 'mild',
  `reaction` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PatientConsultationInfo`
--

CREATE TABLE `PatientConsultationInfo` (
  `consultationID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `consultationdate` date NOT NULL,
  `consultationtype` enum('Check-up','Follow-up','Emergency','Other') NOT NULL,
  `symptoms` text NOT NULL,
  `diagnosis` text NOT NULL,
  `treatmentplan` text NOT NULL,
  `additionalnotes` text NOT NULL,
  `nextappointment` date NOT NULL,
  `medicalfees` decimal(10,2) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `summaryfile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PatientConsultationInfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `PatientFeedback`
--

CREATE TABLE `PatientFeedback` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `cabinet_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `medical_assistant_rating` tinyint(4) DEFAULT NULL,
  `doctor_competence_rating` tinyint(4) DEFAULT NULL,
  `appointment_punctuality_rating` tinyint(4) DEFAULT NULL,
  `cleanliness_rating` tinyint(4) DEFAULT NULL,
  `equipment_quality_rating` tinyint(4) DEFAULT NULL,
  `parking_availability_rating` tinyint(4) DEFAULT NULL,
  `appointment_method` varchar(100) DEFAULT NULL,
  `feedback_title` varchar(255) DEFAULT NULL,
  `feedback_message` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PatientFeedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `PatientInsurance`
--

CREATE TABLE `PatientInsurance` (
  `insuranceID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `provider` varchar(100) NOT NULL,
  `policyNumber` varchar(50) DEFAULT NULL,
  `groupNumber` varchar(50) DEFAULT NULL,
  `expiryDate` date DEFAULT NULL,
  `coverage` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PatientTable`
--

CREATE TABLE `PatientTable` (
  `userID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `address` varchar(70) NOT NULL,
  `phonenumber` int(10) NOT NULL,
  `dateofregistration` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `cabinetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PatientTable`
--

INSERT INTO `PatientTable` (`userID`, `patientID`, `firstname`, `lastname`, `dateofbirth`, `gender`, `address`, `phonenumber`, `dateofregistration`, `archived`, `cabinetID`) VALUES
(7, 1, 'John', 'Smith', '1990-03-15', 'male', '789 Elm Street, City Center', 5551234567, '2026-01-06 10:00:00', 0, 1),
(8, 2, 'Sarah', 'Johnson', '1985-07-22', 'female', '456 Pine Road, North District', 5559876543, '2026-01-06 10:00:00', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

CREATE TABLE `Payments` (
  `paymentID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `transactionRef` varchar(100) DEFAULT NULL,
  `paymentDate` datetime DEFAULT current_timestamp(),
  `status` enum('pending','completed','failed','cancelled') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Prescriptions`
--

CREATE TABLE `Prescriptions` (
  `prescriptionID` int(11) NOT NULL,
  `consultationID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `medicationID` int(11) NOT NULL,
  `dosage` varchar(100) NOT NULL,
  `frequency` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `prescribedDate` datetime DEFAULT current_timestamp(),
  `expiryDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Pricing`
--

CREATE TABLE `Pricing` (
  `pricingID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `serviceName` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Pricing`
--

INSERT INTO `Pricing` (`pricingID`, `cabinetID`, `serviceName`, `price`, `description`, `isActive`, `createdAt`) VALUES
(1, 1, 'General Consultation', 100.00, 'Standard consultation with general practitioner', 1, '2026-01-06 10:00:00'),
(2, 1, 'Follow-up Visit', 60.00, 'Follow-up appointment', 1, '2026-01-06 10:00:00'),
(3, 2, 'Pediatric Consultation', 85.00, 'Child health consultation', 1, '2026-01-06 10:00:00'),
(4, 2, 'Vaccination', 45.00, 'Vaccination service', 1, '2026-01-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Requests`
--

CREATE TABLE `Requests` (
  `requestID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Requests`
--

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`roleID`, `roleName`, `description`, `createdAt`) VALUES
(1, 'super_admin', 'System administrator', '2025-11-30 07:59:55'),
(2, 'admin', 'Cabinet administrator', '2025-11-30 07:59:55'),
(3, 'doctor', 'Medical doctor', '2025-11-30 07:59:55'),
(4, 'assistant', 'Medical assistant', '2025-11-30 07:59:55'),
(5, 'patient', 'Patient', '2025-11-30 07:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `SubscriptionPlan`
--

CREATE TABLE `SubscriptionPlan` (
  `planID` int(11) NOT NULL,
  `plan_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `features` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `UserProfile`
--

CREATE TABLE `UserProfile` (
  `userProfileID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `address` varchar(70) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `UserProfile`
--

INSERT INTO `UserProfile` (`userProfileID`, `userID`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `address`, `phoneNumber`, `createdAt`) VALUES
(2, 8, 'mehdi', 'moussous', '2003-11-27', 'male', 'draria', '0549802213', '2025-12-13 20:09:41'),
(5, 15, 'John', 'Pork', '1995-09-04', 'male', 'Algiers , Cheraga', '+213555443321', '2025-12-15 15:06:22'),
(6, 16, 'samia', 'boulekrinate', '1982-05-12', 'female', 'cheraga', '333333333', '2025-12-19 18:28:43'),
(20, 30, 'Kim', 'Park', '2005-05-10', 'male', 'cheraga', '0222223333', '2025-12-20 15:03:49'),
(32, 38, 'Sarah', 'Johnson', '1981-10-14', 'female', 'val d’hydra', '+213555443321', '2025-12-22 18:14:22'),
(40, 42, 'badi', 'so', '2003-11-27', NULL, 'draria', '0545454545', '2025-12-26 12:21:44'),
(41, 43, 'Moussa', 'Merah', NULL, NULL, NULL, '2149876543', '2025-12-28 18:14:05'),
(42, 44, 'testadmin', '', NULL, NULL, NULL, '0989898999', '2025-12-31 16:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `userID` int(11) NOT NULL,
  `roleID` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `account_status` enum('active','suspended','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`userID`, `roleID`, `username`, `email`, `password`, `profile_picture`, `last_login`, `account_status`) VALUES
(1, 1, 'superadmin', 'superadmin@medoffice.com', '$2y$10$xyz123abc456def789ghi0jk1lmnopqrstuvwxyzabcdefghijk.', NULL, NULL, 'active'),
(2, 2, 'cabinet_admin', 'admin@cabinet1.com', '$2y$10$abc123def456ghi789jkl0mn1opqrstuvwxyzabcdefghijklmno.', NULL, NULL, 'active'),
(4, 3, 'drthompson', 'michael.thompson@medoffice.com', '$2y$10$def456ghi789jkl0mn1op2qr3stuvwxyzabcdefghijklmnopqrs.', NULL, NULL, 'active'),
(5, 3, 'drwilson', 'emily.wilson@medoffice.com', '$2y$10$ghi789jkl0mn1op2qr3st4uv5wxyzabcdefghijklmnopqrstuv.', NULL, NULL, 'active'),
(6, 4, 'jessica_assist', 'jessica.brown@medoffice.com', '$2y$10$jkl0mn1op2qr3st4uv5wX6yz7abcdefghijklmnopqrstuvwxyza.', NULL, NULL, 'active'),
(7, 5, 'john_patient', 'john.smith@patient.com', '$2y$10$mn1op2qr3st4uv5wx6yz7A8bc9defghijklmnopqrstuvwxyzabc.', NULL, NULL, 'active'),
(8, 5, 'sarah_patient', 'sarah.johnson@patient.com', '$2y$10$op2qr3st4uv5wx6yz7ab8C9de0fghijklmnopqrstuvwxyzabcdef.', NULL, NULL, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `cabinetID` (`cabinetID`),
  ADD KEY `fk_activitylog_userID` (`userID`);

--
-- Indexes for table `Appointments`
--
ALTER TABLE `Appointments`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `cabinetID` (`cabinetID`),
  ADD KEY `consultationID` (`consultationID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `date` (`date`),
  ADD KEY `idx_appointments_doctor_date` (`doctorID`,`date`);

--
-- Indexes for table `AssistantAvailability`
--
ALTER TABLE `AssistantAvailability`
  ADD PRIMARY KEY (`assistantAvailabilityID`),
  ADD KEY `fk_assistantavailability_assistant` (`assistantID`);

--
-- Indexes for table `AssistantProfile`
--
ALTER TABLE `AssistantProfile`
  ADD PRIMARY KEY (`assistantID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `assignedDoctorID` (`assignedDoctorID`),
  ADD KEY `cabinetID` (`cabinetID`);

--
-- Indexes for table `AssistantShifts`
--
ALTER TABLE `AssistantShifts`
  ADD PRIMARY KEY (`shiftID`),
  ADD KEY `fk_assistantshifts_cabinet` (`cabinetID`),
  ADD KEY `idx_assistant_date` (`assistantUserID`,`shiftDate`);

--
-- Indexes for table `AssistantSkills`
--
ALTER TABLE `AssistantSkills`
  ADD PRIMARY KEY (`assistantSkillID`),
  ADD KEY `fk_assistantskills_assistant` (`assistantID`);

--
-- Indexes for table `CabinetFacilities`
--
ALTER TABLE `CabinetFacilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cabinet_facilities` (`cabinetID`);

--
-- Indexes for table `CabinetInfo`
--
ALTER TABLE `CabinetInfo`
  ADD PRIMARY KEY (`cabinetID`);

--
-- Indexes for table `DoctorAvailability`
--
ALTER TABLE `DoctorAvailability`
  ADD PRIMARY KEY (`availabilityID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `DoctorEducation`
--
ALTER TABLE `DoctorEducation`
  ADD PRIMARY KEY (`educationID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `DoctorExperience`
--
ALTER TABLE `DoctorExperience`
  ADD PRIMARY KEY (`experienceID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `DoctorLanguages`
--
ALTER TABLE `DoctorLanguages`
  ADD PRIMARY KEY (`languageID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  ADD PRIMARY KEY (`doctorID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `cabinetID` (`cabinetID`),
  ADD KEY `speciality` (`speciality`);

--
-- Indexes for table `DoctorTimeOff`
--
ALTER TABLE `DoctorTimeOff`
  ADD PRIMARY KEY (`timeOffID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `startDate` (`startDate`);

--
-- Indexes for table `EmergencyContact`
--
ALTER TABLE `EmergencyContact`
  ADD PRIMARY KEY (`contactID`),
  ADD KEY `patientID` (`patientID`);

--
-- Indexes for table `FileUploads`
--
ALTER TABLE `FileUploads`
  ADD PRIMARY KEY (`fileID`),
  ADD KEY `cabinetID` (`cabinetID`),
  ADD KEY `fk_fileuploads_userID` (`userID`);

--
-- Indexes for table `InvoiceItems`
--
ALTER TABLE `InvoiceItems`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `invoiceID` (`invoiceID`);

--
-- Indexes for table `Invoices`
--
ALTER TABLE `Invoices`
  ADD PRIMARY KEY (`invoiceID`),
  ADD UNIQUE KEY `invoiceNumber` (`invoiceNumber`),
  ADD KEY `cabinetID` (`cabinetID`),
  ADD KEY `invoiceNumber_2` (`invoiceNumber`),
  ADD KEY `issued` (`issued`);

--
-- Indexes for table `Medications`
--
ALTER TABLE `Medications`
  ADD PRIMARY KEY (`medicationID`),
  ADD KEY `medicationName` (`medicationName`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `cabinetID` (`cabinetID`),
  ADD KEY `recipientID` (`recipientID`),
  ADD KEY `sentTime` (`sentTime`),
  ADD KEY `isRead` (`isRead`),
  ADD KEY `idx_messages_recipient` (`recipientID`,`sentTime`);

--
-- Indexes for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PasswordResets`
--
ALTER TABLE `PasswordResets`
  ADD PRIMARY KEY (`resetID`);

--
-- Indexes for table `PatientAllergies`
--
ALTER TABLE `PatientAllergies`
  ADD PRIMARY KEY (`allergyID`),
  ADD KEY `patientID` (`patientID`);

--
-- Indexes for table `PatientConsultationInfo`
--
ALTER TABLE `PatientConsultationInfo`
  ADD PRIMARY KEY (`consultationID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `idx_consultations_patient_date` (`PatientID`,`consultationdate`);

--
-- Indexes for table `PatientFeedback`
--
ALTER TABLE `PatientFeedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pf_patient` (`patient_id`),
  ADD KEY `fk_pf_cabinet` (`cabinet_id`);

--
-- Indexes for table `PatientInsurance`
--
ALTER TABLE `PatientInsurance`
  ADD PRIMARY KEY (`insuranceID`),
  ADD UNIQUE KEY `patientID` (`patientID`),
  ADD KEY `policyNumber` (`policyNumber`);

--
-- Indexes for table `PatientTable`
--
ALTER TABLE `PatientTable`
  ADD PRIMARY KEY (`patientID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `cabinetID` (`cabinetID`);

--
-- Indexes for table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `invoiceID` (`invoiceID`),
  ADD KEY `paymentDate` (`paymentDate`);

--
-- Indexes for table `Prescriptions`
--
ALTER TABLE `Prescriptions`
  ADD PRIMARY KEY (`prescriptionID`),
  ADD KEY `consultationID` (`consultationID`),
  ADD KEY `medicationID` (`medicationID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `doctorID` (`doctorID`),
  ADD KEY `prescribedDate` (`prescribedDate`),
  ADD KEY `idx_prescriptions_patient` (`patientID`);

--
-- Indexes for table `Pricing`
--
ALTER TABLE `Pricing`
  ADD PRIMARY KEY (`pricingID`),
  ADD KEY `fk_pricing_cabinet` (`cabinetID`);

--
-- Indexes for table `Requests`
--
ALTER TABLE `Requests`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `email` (`email`),
  ADD KEY `status` (`status`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`roleID`),
  ADD UNIQUE KEY `roleName` (`roleName`);

--
-- Indexes for table `SubscriptionPlan`
--
ALTER TABLE `SubscriptionPlan`
  ADD PRIMARY KEY (`planID`);

--
-- Indexes for table `UserProfile`
--
ALTER TABLE `UserProfile`
  ADD PRIMARY KEY (`userProfileID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `firstName` (`firstName`),
  ADD KEY `lastName` (`lastName`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_cabinet_role` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Appointments`
--
ALTER TABLE `Appointments`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `AssistantAvailability`
--
ALTER TABLE `AssistantAvailability`
  MODIFY `assistantAvailabilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `AssistantProfile`
--
ALTER TABLE `AssistantProfile`
  MODIFY `assistantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `AssistantShifts`
--
ALTER TABLE `AssistantShifts`
  MODIFY `shiftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `AssistantSkills`
--
ALTER TABLE `AssistantSkills`
  MODIFY `assistantSkillID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `CabinetFacilities`
--
ALTER TABLE `CabinetFacilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `CabinetInfo`
--
ALTER TABLE `CabinetInfo`
  MODIFY `cabinetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `DoctorAvailability`
--
ALTER TABLE `DoctorAvailability`
  MODIFY `availabilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `DoctorEducation`
--
ALTER TABLE `DoctorEducation`
  MODIFY `educationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `DoctorExperience`
--
ALTER TABLE `DoctorExperience`
  MODIFY `experienceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DoctorLanguages`
--
ALTER TABLE `DoctorLanguages`
  MODIFY `languageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `DoctorTimeOff`
--
ALTER TABLE `DoctorTimeOff`
  MODIFY `timeOffID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EmergencyContact`
--
ALTER TABLE `EmergencyContact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `FileUploads`
--
ALTER TABLE `FileUploads`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `InvoiceItems`
--
ALTER TABLE `InvoiceItems`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Invoices`
--
ALTER TABLE `Invoices`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Medications`
--
ALTER TABLE `Medications`
  MODIFY `medicationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `PasswordResets`
--
ALTER TABLE `PasswordResets`
  MODIFY `resetID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PatientAllergies`
--
ALTER TABLE `PatientAllergies`
  MODIFY `allergyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PatientConsultationInfo`
--
ALTER TABLE `PatientConsultationInfo`
  MODIFY `consultationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `PatientFeedback`
--
ALTER TABLE `PatientFeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `PatientInsurance`
--
ALTER TABLE `PatientInsurance`
  MODIFY `insuranceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PatientTable`
--
ALTER TABLE `PatientTable`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Prescriptions`
--
ALTER TABLE `Prescriptions`
  MODIFY `prescriptionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pricing`
--
ALTER TABLE `Pricing`
  MODIFY `pricingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Requests`
--
ALTER TABLE `Requests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `SubscriptionPlan`
--
ALTER TABLE `SubscriptionPlan`
  MODIFY `planID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserProfile`
--
ALTER TABLE `UserProfile`
  MODIFY `userProfileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  ADD CONSTRAINT `activitylog_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`),
  ADD CONSTRAINT `activitylog_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`),
  ADD CONSTRAINT `fk_activitylog_userID` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `Appointments`
--
ALTER TABLE `Appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `PatientTable` (`patientID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`consultationID`) REFERENCES `PatientConsultationInfo` (`consultationID`) ON DELETE SET NULL;

--
-- Constraints for table `AssistantAvailability`
--
ALTER TABLE `AssistantAvailability`
  ADD CONSTRAINT `fk_assistantavailability_assistant` FOREIGN KEY (`assistantID`) REFERENCES `AssistantProfile` (`assistantID`) ON DELETE CASCADE;

--
-- Constraints for table `AssistantProfile`
--
ALTER TABLE `AssistantProfile`
  ADD CONSTRAINT `assistantprofile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistantprofile_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistantprofile_ibfk_3` FOREIGN KEY (`assignedDoctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE SET NULL;

--
-- Constraints for table `AssistantShifts`
--
ALTER TABLE `AssistantShifts`
  ADD CONSTRAINT `fk_assistantshifts_cabinet` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_assistantshifts_user` FOREIGN KEY (`assistantUserID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `AssistantSkills`
--
ALTER TABLE `AssistantSkills`
  ADD CONSTRAINT `fk_assistantskills_assistant` FOREIGN KEY (`assistantID`) REFERENCES `AssistantProfile` (`assistantID`) ON DELETE CASCADE;

--
-- Constraints for table `CabinetFacilities`
--
ALTER TABLE `CabinetFacilities`
  ADD CONSTRAINT `fk_cabinet_facilities` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorAvailability`
--
ALTER TABLE `DoctorAvailability`
  ADD CONSTRAINT `doctoravailability_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorEducation`
--
ALTER TABLE `DoctorEducation`
  ADD CONSTRAINT `doctoreducation_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorExperience`
--
ALTER TABLE `DoctorExperience`
  ADD CONSTRAINT `doctorexperience_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorLanguages`
--
ALTER TABLE `DoctorLanguages`
  ADD CONSTRAINT `doctorlanguages_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  ADD CONSTRAINT `doctorprofile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctorprofile_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorTimeOff`
--
ALTER TABLE `DoctorTimeOff`
  ADD CONSTRAINT `doctortimeoff_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE CASCADE;

--
-- Constraints for table `EmergencyContact`
--
ALTER TABLE `EmergencyContact`
  ADD CONSTRAINT `emergencycontact_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `PatientTable` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `FileUploads`
--
ALTER TABLE `FileUploads`
  ADD CONSTRAINT `fileuploads_ibfk_1` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`),
  ADD CONSTRAINT `fk_fileuploads_userID` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `InvoiceItems`
--
ALTER TABLE `InvoiceItems`
  ADD CONSTRAINT `invoiceitems_ibfk_1` FOREIGN KEY (`invoiceID`) REFERENCES `Invoices` (`invoiceID`) ON DELETE CASCADE;

--
-- Constraints for table `Invoices`
--
ALTER TABLE `Invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`);

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recipientID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE;

--
-- Constraints for table `PatientAllergies`
--
ALTER TABLE `PatientAllergies`
  ADD CONSTRAINT `patientallergies_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `PatientTable` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `PatientConsultationInfo`
--
ALTER TABLE `PatientConsultationInfo`
  ADD CONSTRAINT `patientconsultationinfo_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `PatientTable` (`patientID`);

--
-- Constraints for table `PatientFeedback`
--
ALTER TABLE `PatientFeedback`
  ADD CONSTRAINT `fk_pf_cabinet` FOREIGN KEY (`cabinet_id`) REFERENCES `CabinetInfo` (`cabinetID`),
  ADD CONSTRAINT `fk_pf_patient` FOREIGN KEY (`patient_id`) REFERENCES `Users` (`userID`);

--
-- Constraints for table `PatientInsurance`
--
ALTER TABLE `PatientInsurance`
  ADD CONSTRAINT `patientinsurance_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `PatientTable` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `PatientTable`
--
ALTER TABLE `PatientTable`
  ADD CONSTRAINT `patienttable_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`),
  ADD CONSTRAINT `patienttable_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`);

--
-- Constraints for table `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`invoiceID`) REFERENCES `Invoices` (`invoiceID`) ON DELETE CASCADE;

--
-- Constraints for table `Prescriptions`
--
ALTER TABLE `Prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`consultationID`) REFERENCES `PatientConsultationInfo` (`consultationID`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `PatientTable` (`patientID`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_ibfk_3` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_ibfk_4` FOREIGN KEY (`medicationID`) REFERENCES `Medications` (`medicationID`);

--
-- Constraints for table `Pricing`
--
ALTER TABLE `Pricing`
  ADD CONSTRAINT `fk_pricing_cabinet` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE;

--
-- Constraints for table `Requests`
--
ALTER TABLE `Requests`
  ADD CONSTRAINT `fk_requests_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `Users` (`userID`);

--
-- Constraints for table `UserProfile`
--
ALTER TABLE `UserProfile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `Roles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
