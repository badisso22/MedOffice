-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2025 at 04:10 PM
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
  `status` enum('pending','accepted','cancelled') DEFAULT 'pending',
  `cabinetID` int(11) NOT NULL,
  `consultationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `AssistantTable`
--

CREATE TABLE `AssistantTable` (
  `userID` int(11) NOT NULL,
  `assistantID` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `CabinetInfo`
--

CREATE TABLE `CabinetInfo` (
  `cabinetID` int(11) NOT NULL,
  `cabinetname` varchar(50) NOT NULL,
  `cabinetlocation` text NOT NULL,
  `contact_email` varchar(80) DEFAULT NULL,
  `cabinetphonenumber` varchar(15) DEFAULT NULL,
  `cabinetworktime` text DEFAULT NULL,
  `cabinetspeciality` varchar(50) DEFAULT NULL,
  `subscription_plan` varchar(50) DEFAULT NULL,
  `api_key` varchar(128) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `DoctorTable`
--

CREATE TABLE `DoctorTable` (
  `userID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `address` varchar(70) NOT NULL,
  `phonenumber` int(10) NOT NULL,
  `speciality` varchar(40) NOT NULL,
  `dateofregistration` timestamp NOT NULL DEFAULT current_timestamp(),
  `cabinetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `userID` int(11) NOT NULL,
  `cabinetID` int(11) NOT NULL,
  `roleID` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `account_status` enum('active','suspended','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `AssistantProfile`
--
ALTER TABLE `AssistantProfile`
  ADD PRIMARY KEY (`assistantID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `assignedDoctorID` (`assignedDoctorID`),
  ADD KEY `cabinetID` (`cabinetID`);

--
-- Indexes for table `AssistantTable`
--
ALTER TABLE `AssistantTable`
  ADD PRIMARY KEY (`assistantID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `cabinetID` (`cabinetID`);

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
-- Indexes for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  ADD PRIMARY KEY (`doctorID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `cabinetID` (`cabinetID`),
  ADD KEY `speciality` (`speciality`);

--
-- Indexes for table `DoctorTable`
--
ALTER TABLE `DoctorTable`
  ADD PRIMARY KEY (`doctorID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `cabinetID` (`cabinetID`);

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
  ADD KEY `roleID` (`roleID`),
  ADD KEY `idx_users_cabinet_role` (`cabinetID`,`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Appointments`
--
ALTER TABLE `Appointments`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `AssistantProfile`
--
ALTER TABLE `AssistantProfile`
  MODIFY `assistantID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `AssistantTable`
--
ALTER TABLE `AssistantTable`
  MODIFY `assistantID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CabinetInfo`
--
ALTER TABLE `CabinetInfo`
  MODIFY `cabinetID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DoctorAvailability`
--
ALTER TABLE `DoctorAvailability`
  MODIFY `availabilityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `DoctorTable`
--
ALTER TABLE `DoctorTable`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `consultationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PatientInsurance`
--
ALTER TABLE `PatientInsurance`
  MODIFY `insuranceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PatientTable`
--
ALTER TABLE `PatientTable`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `userProfileID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `AssistantProfile`
--
ALTER TABLE `AssistantProfile`
  ADD CONSTRAINT `assistantprofile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistantprofile_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistantprofile_ibfk_3` FOREIGN KEY (`assignedDoctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE SET NULL;

--
-- Constraints for table `AssistantTable`
--
ALTER TABLE `AssistantTable`
  ADD CONSTRAINT `assistanttable_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`),
  ADD CONSTRAINT `assistanttable_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`);

--
-- Constraints for table `DoctorAvailability`
--
ALTER TABLE `DoctorAvailability`
  ADD CONSTRAINT `doctoravailability_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `DoctorProfile` (`doctorID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  ADD CONSTRAINT `doctorprofile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctorprofile_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorTable`
--
ALTER TABLE `DoctorTable`
  ADD CONSTRAINT `doctortable_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`),
  ADD CONSTRAINT `doctortable_ibfk_2` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`);

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
-- Constraints for table `UserProfile`
--
ALTER TABLE `UserProfile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `fk_users_cabinetID` FOREIGN KEY (`cabinetID`) REFERENCES `CabinetInfo` (`cabinetID`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `Roles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
