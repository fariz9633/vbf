# VBF Database Setup Guide

## Overview
This directory contains the complete database schema for the **Vipra Business Forum (VBF)** application.

## Database Information
- **Database Name**: `mlaravi` (as configured in `.env.example`)
- **Database Type**: MySQL
- **Charset**: utf8mb4
- **Collation**: utf8mb4_unicode_ci

## Files
- `vbf_database.sql` - Complete database schema with all tables and sample data

## Installation Methods

### Method 1: Using phpMyAdmin (Recommended for XAMPP)
1. Open phpMyAdmin in your browser: `http://localhost/phpmyadmin`
2. Create a new database named `mlaravi`
3. Select the database
4. Click on the "Import" tab
5. Choose the file `database/vbf_database.sql`
6. Click "Go" to execute

### Method 2: Using MySQL Command Line
```bash
# Login to MySQL
mysql -u root -p

# Create database
CREATE DATABASE mlaravi CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Use the database
USE mlaravi;

# Import the SQL file
SOURCE d:/xampp/htdocs/vbf/database/vbf_database.sql;

# Or from command line directly
mysql -u root -p mlaravi < d:/xampp/htdocs/vbf/database/vbf_database.sql
```

### Method 3: Using Laravel Migrations (Alternative)
```bash
# Run Laravel migrations
php artisan migrate

# Note: This will only create default Laravel tables
# You'll need to import vbf_database.sql for custom tables
```

## Database Structure

### Core Tables (42 tables total)

#### Laravel Default Tables
- `users` - Laravel default users
- `password_resets` - Password reset tokens
- `failed_jobs` - Failed queue jobs
- `personal_access_tokens` - API tokens
- `migrations` - Migration tracking

#### Authentication & Users
- `pwa_admin` - Admin users
- `customers` - Customer/member accounts
- `customerotp` - OTP verification

#### Content Management
- `pwa_banner` - Homepage banners
- `pwa_news` - News articles
- `pwa_events` - Events
- `pwa_gallery` - Image gallery
- `pwa_about` - About content
- `pwa_terms` - Terms & conditions
- `pwa_scheme` - Schemes/programs
- `pwa_activities` - Activities
- `pwa_media` - Media links
- `pwa_content` - General content

#### Organization Structure
- `pwa_department` - Departments
- `pwa_department_mem` - Department members
- `pwa_designation` - Designations
- `pwa_chapter` - Chapters
- `pwa_category` - Business categories
- `pwa_subcategory` - Business subcategories

#### Meetings & Calendar
- `pwa_meetings` - Meetings
- `pwa_meetings_mom` - Minutes of meetings
- `pwa_meetings_attendance` - Meeting attendance
- `calender` - Calendar events

#### Documents
- `pwa_document` - Document management

#### Opportunities
- `opportunity` - Business opportunities
- `pwa_referencetype` - Reference types
- `pwa_opportunitytype` - Opportunity types
- `pwa_referalstatus` - Referral status
- `pwa_opportunityconnect` - Connection methods

#### Roles & Permissions
- `pwa_roles` - User roles
- `pwa_permissions` - Permissions
- `pwa_user_roles` - User-role mapping
- `pwa_user_capabilities` - User capabilities
- `pwa_modules` - System modules
- `pwa_submodules` - Submodules

#### Location & Support
- `pwa_country` - Countries
- `pwa_state` - States
- `pwa_support` - Support tickets

#### Additional
- `pwa_services` - Services
- `pwa_nature` - Nature of business
- `pwa_appversions` - App versions
- `pwa_versions` - Version history
- `order` - Orders
- `registrations` - Registration data

## Default Credentials

### Admin Login
- **Email**: admin@vbf.com
- **Password**: admin123
- **Phone**: 9876543210

**IMPORTANT**: Change the default admin password immediately after installation!

## Sample Data Included

The SQL file includes sample data for:
- 1 Admin user
- 4 Default roles (Super Admin, Admin, Manager, User)
- 8 System modules
- 4 Opportunity types
- 4 Reference types
- 4 Referral statuses
- 4 Opportunity connect methods

## Post-Installation Steps

1. **Update .env file**:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mlaravi
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

3. **Clear cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

4. **Test database connection**:
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

## Troubleshooting

### Error: "Access denied for user"
- Check your MySQL username and password in `.env`
- Ensure MySQL service is running in XAMPP

### Error: "Unknown database"
- Create the database first: `CREATE DATABASE mlaravi;`

### Error: "Syntax error"
- Ensure you're using MySQL 5.7+ or MariaDB 10.2+
- Check that the SQL file is not corrupted

## Backup & Restore

### Create Backup
```bash
mysqldump -u root -p mlaravi > backup_$(date +%Y%m%d).sql
```

### Restore from Backup
```bash
mysql -u root -p mlaravi < backup_20231204.sql
```

## Support
For issues or questions, contact the development team.

