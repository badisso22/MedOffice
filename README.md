# MedOffice - Medical Practice Management System

## Overview

MedOffice is a comprehensive, web-based **HIPAA-compliant multi-tenant medical practice management system** designed to streamline healthcare operations. It enables medical offices, clinics, and healthcare practitioners to manage patient appointments, medical records, staff coordination, and compliance—all within a single integrated platform.

## 🎯 Key Features

### Core Functionality
- **Multi-Tenant Architecture**: Support for multiple independent medical cabinets/offices
- **Role-Based Access Control**: Different user roles with specific permissions
- **Appointment Management**: Calendar-based appointment scheduling and management
- **Patient Records Management**: Digital storage and retrieval of medical records
- **Prescription Management**: Creation and tracking of patient prescriptions
- **User Profiles**: Comprehensive profile management for all user types
- **Analytics & Reporting**: Performance analytics and operational reports
- **Notifications System**: Real-time alerts and notifications
- **Messaging**: Inter-user communication system

## 👥 User Roles

The system supports multiple user roles with distinct functionalities:

### 1. **Super Admin**
   - Manage multiple medical cabinets/offices
   - Create and archive cabinets
   - User management and oversight
   - View system-wide analytics and reports
   - Handle billing and subscriptions
   - Manage security and compliance

### 2. **Admin/Cabinet Admin**
   - Manage a specific medical cabinet
   - Add/edit/archive doctors, patients, and assistants
   - Appointment management and scheduling
   - Cabinet profile and settings management
   - View cabinet-specific analytics
   - Manage assistant shifts and schedules
   - Handle medical records and prescriptions

### 3. **Doctor**
   - View assigned appointments
   - Manage patient consultations
   - Create and update prescriptions
   - Add medical records
   - View patient profiles and history
   - Track analytics (patient load, appointments completed)
   - Manage assistant assignments
   - Access appointment details and consultation notes

### 4. **Assistant**
   - Manage daily appointment queue
   - Check appointment status
   - Shift management (start/end shift)
   - Track pending appointments
   - View patient information
   - Activity analytics
   - Patient management support

### 5. **Patient**
   - Browse and book appointments with doctors
   - Search doctors by specialty
   - View appointment calendar and history
   - Cancel appointments
   - Access medical records and prescriptions
   - View doctor profiles and ratings
   - Update personal profile and settings
   - Upload/manage profile pictures
   - Receive notifications
   - Patient feedback system

## 📁 Project Structure

```
MedOffice/
├── AdminDoctor/              # Admin/Cabinet Admin module (33 files)
├── Doctor/                   # Doctor module (24 files)
├── Assistant/                # Assistant module (16 files)
├── Patient/                  # Patient module (20 files)
├── SuperAdmin/               # Super Admin module (15 files)
├── api/                      # Backend API endpoints (80+ files)
├── ajax/                     # Frontend AJAX handlers (70+ files)
├── CSS/                      # Stylesheets
├── JS/                       # Frontend JavaScript utilities
├── config/                   # Configuration files
├── login-forms/              # Authentication forms
├── Data-Base/                # Database schema and migrations
├── uploads/                  # User-generated content storage
├── vendor/                   # Composer dependencies
├── index.html                # Landing page
├── cabinet_onboarding.php    # Cabinet onboarding flow
├── composer.json             # PHP dependencies
└── LICENSE
```

## 🔧 Technology Stack

### Backend
- **Language**: PHP (7.4+)
- **Database**: MySQL/MariaDB
- **Server**: Apache (via XAMPP)

### Frontend
- **HTML5**: Semantic markup
- **CSS3**: Responsive styling
- **JavaScript**: Vanilla JS (no external frameworks)
- **AJAX**: Asynchronous data loading

### Libraries & Dependencies
- **PHPMailer**: Email functionality
- **MySQL**: Database driver (MySQLi)

## 🚀 Getting Started

### Prerequisites
- XAMPP (or similar local development environment)
- PHP 7.4 or higher
- MySQL/MariaDB database
- Composer (for dependency management)

### Installation

1. **Clone/Place Project**
   ```bash
   # Place the project in XAMPP's htdocs
   /Applications/XAMPP/xamppfiles/htdocs/MedOffice
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment**
   - Create `.env` file in the project root
   - Set database credentials:
     ```
     DB_HOST=localhost
     DB_USER=root
     DB_PASS=
     DB_NAME=medoffice
     DB_PORT=3306
     ```

4. **Create Database**
   - Import database schema from `Data-Base/` directory
   - Set up required tables and initial data

5. **Start XAMPP**
   - Launch Apache and MySQL services
   - Access the application at `http://localhost/MedOffice`

### Default Access
- **Landing Page**: `http://localhost/MedOffice/index.html`
- **Login**: `http://localhost/MedOffice/login-forms/login.php`
- **Cabinet Request**: `http://localhost/MedOffice/login-forms/requestCab.php`

## 🔐 Test Credentials

The database includes fake/dummy data for testing purposes. Use any of these credentials to log in:

### Super Admin
| Role | Username | Email | Password |
|------|----------|-------|----------|
| Super Admin | `superadmin` | superadmin@medoffice.com | `Test@123` |

### Cabinet Admins
| Role | Username | Email | Password |
|------|----------|-------|----------|
| Cabinet Admin 1 | `cabinet_admin` | admin@cabinet1.com | `Test@123` |

### Doctors
| Role | Username | Email | Password |
|------|----------|-------|----------|
| General Medicine | `drthompson` | michael.thompson@medoffice.com | `Test@123` |
| Pediatrics | `drwilson` | emily.wilson@medoffice.com | `Test@123` |

### Medical Assistants
| Role | Username | Email | Password |
|------|----------|-------|----------|
| Assistant | `jessica_assist` | jessica.brown@medoffice.com | `Test@123` |

### Patients
| Role | Username | Email | Password |
|------|----------|-------|----------|
| Patient 1 | `john_patient` | john.smith@patient.com | `Test@123` |
| Patient 2 | `sarah_patient` | sarah.johnson@patient.com | `Test@123` |

**Default Password for all test accounts**: `Test@123`

> **Note**: These are dummy credentials for development and testing only. Never use these in production.

## 📋 Main Modules

### Admin Module (`AdminDoctor/`)
- Cabinet management and profile
- Doctor, patient, and assistant management
- Appointment scheduling and consultation
- Medical records and prescriptions
- Staff archiving and unarchiving
- Analytics and reporting

### Doctor Module (`Doctor/`)
- Dashboard with key metrics
- Patient management
- Appointment management
- Medical record creation
- Prescription management
- Consultant notes and records
- Analytics tracking

### Assistant Module (`Assistant/`)
- Daily appointment queue management
- Shift tracking (start/end)
- Patient management support
- Appointment status updates
- Activity tracking and analytics

### Patient Module (`Patient/`)
- Dashboard with appointments and health info
- Doctor search and appointment booking
- Medical records and prescriptions access
- Profile management
- Calendar-based appointment view
- Feedback submission

### Super Admin Module (`SuperAdmin/`)
- Cabinet creation and management
- User administration
- Billing and subscriptions
- Suspended and archived cabinet management
- System-wide analytics
- Security and compliance management

## 🔐 Security Features

- **Role-Based Access Control (RBAC)**: Granular permission management
- **Session Management**: Secure session handling
- **HIPAA Compliance**: Built with healthcare compliance in mind
- **Input Validation**: Data sanitization and validation
- **SQL Injection Prevention**: Prepared statements with parameterized queries

## ⚠️ Known Limitations & Missing Features

This project is **incomplete** and the following features are **not yet implemented** or **partially implemented**:

### Missing/Incomplete Features
- ❌ **Complete Payment/Billing System**: Subscription management is partially implemented
- ❌ **Advanced Analytics Dashboard**: Full reporting features need implementation
- ❌ **Patient-Doctor Ratings System**: Review/rating infrastructure incomplete
- ❌ **Automated Appointment Reminders**: Email/SMS notification system not fully implemented
- ❌ **Medical AI Features**: The `medAi.php` and `medAi_chat.php` files exist but are not fully integrated
- ❌ **Complete Notification System**: Real-time notifications need socket implementation
- ❌ **Document Upload/Management**: Advanced file handling features
- ❌ **Telemedicine/Video Consultation**: Remote appointment features
- ❌ **Advanced Search Filters**: Full-featured search and filtering
- ❌ **Appointment Availability Automation**: Dynamic availability scheduling
- ❌ **Complete Error Handling**: Some edge cases not fully handled
- ❌ **Comprehensive Unit Tests**: Test coverage is minimal
- ❌ **API Documentation**: OpenAPI/Swagger documentation missing
- ❌ **Mobile Responsiveness**: Some pages need mobile optimization

### Partially Implemented
- 🟡 **Cabinet Onboarding**: Basic flow exists, needs refinement
- 🟡 **Email Notifications**: PHPMailer installed but not fully integrated
- 🟡 **User Authentication**: Basic login/session management implemented
- 🟡 **Medical Records**: Basic functionality, needs document handling improvements
- 🟡 **Appointment Management**: Core features exist, needs advanced scheduling

## 🛠️ Development Notes

### Frontend Framework Notes
- No JavaScript framework (Vue.js, React, Angular) - uses vanilla JavaScript
- AJAX for asynchronous operations
- CSS Grid and Flexbox for layouts
- SVG icons for UI elements

## 📝 License

See the [LICENSE](LICENSE) file for details.

## 👨‍🎓 Educational Purpose

This project was developed as an educational exercise and demonstrates:
- Multi-tenant application architecture
- Role-based access control systems
- Database design for healthcare applications
- AJAX and asynchronous programming
- RESTful API principles
- HTML/CSS/JavaScript frontend development
- PHP backend development
- MySQL database operations

---

**Last Updated**: January 2026  
**Status**: 🚧 **Under Development** - Not Production Ready

---

> This README will be updated as features are completed and refined.
