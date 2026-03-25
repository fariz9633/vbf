# VBF Database Setup - Quick Summary

## 📁 Files Created

1. **`database/vbf_database.sql`** (724 lines)
   - Complete database schema with 42 tables
   - Sample data for admin, roles, modules, and lookup tables
   - Ready to import into MySQL

2. **`database/README_DATABASE.md`**
   - Comprehensive documentation
   - Installation instructions
   - Database structure overview
   - Troubleshooting guide

3. **`database/import_database.bat`**
   - Windows/XAMPP automated import script
   - Interactive prompts for safety

4. **`database/import_database.sh`**
   - Linux/Mac automated import script
   - Bash script with error handling

## 🚀 Quick Start (Choose One Method)

### Method 1: Automated Script (Recommended)

**For Windows/XAMPP:**
```bash
cd database
import_database.bat
```

**For Linux/Mac:**
```bash
cd database
chmod +x import_database.sh
./import_database.sh
```

### Method 2: Manual Import via phpMyAdmin
1. Open `http://localhost/phpmyadmin`
2. Create database `mlaravi`
3. Import `database/vbf_database.sql`

### Method 3: MySQL Command Line
```bash
mysql -u root -p
CREATE DATABASE mlaravi CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mlaravi;
SOURCE d:/xampp/htdocs/vbf/database/vbf_database.sql;
```

## 📊 Database Overview

### Total Tables: 42

**Laravel Core (5 tables)**
- users, password_resets, failed_jobs, personal_access_tokens, migrations

**Authentication (3 tables)**
- pwa_admin, customers, customerotp

**Content Management (9 tables)**
- pwa_banner, pwa_news, pwa_events, pwa_gallery, pwa_about, pwa_terms, pwa_scheme, pwa_activities, pwa_media

**Organization (6 tables)**
- pwa_department, pwa_department_mem, pwa_designation, pwa_chapter, pwa_category, pwa_subcategory

**Meetings (4 tables)**
- pwa_meetings, pwa_meetings_mom, pwa_meetings_attendance, calender

**Opportunities (5 tables)**
- opportunity, pwa_referencetype, pwa_opportunitytype, pwa_referalstatus, pwa_opportunityconnect

**Roles & Permissions (6 tables)**
- pwa_roles, pwa_permissions, pwa_user_roles, pwa_user_capabilities, pwa_modules, pwa_submodules

**Others (4 tables)**
- pwa_document, pwa_support, pwa_services, pwa_nature, pwa_country, pwa_state, etc.

## 🔐 Default Credentials

**Admin Login:**
- Email: `admin@vbf.com`
- Password: `admin123`
- Phone: `9876543210`

⚠️ **IMPORTANT:** Change this password immediately after first login!

## 📝 Sample Data Included

✅ 1 Admin user
✅ 4 Roles (Super Admin, Admin, Manager, User)
✅ 8 System modules
✅ 4 Opportunity types
✅ 4 Reference types
✅ 4 Referral statuses
✅ 4 Opportunity connect methods

## ⚙️ Post-Installation Steps

1. **Update `.env` file:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mlaravi
DB_USERNAME=root
DB_PASSWORD=
```

2. **Run Laravel commands:**
```bash
php artisan key:generate
php artisan config:clear
php artisan cache:clear
```

3. **Test database connection:**
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

4. **Start the application:**
```bash
php artisan serve
```

5. **Access admin panel:**
```
http://localhost:8000/admin
```

## ✅ Verification Checklist

- [ ] Database `mlaravi` created
- [ ] All 42 tables imported successfully
- [ ] Sample data inserted
- [ ] `.env` file updated with database credentials
- [ ] Laravel key generated
- [ ] Cache cleared
- [ ] Database connection tested
- [ ] Admin login works
- [ ] Default password changed

## 🔧 Troubleshooting

**Error: "Access denied"**
- Check MySQL username/password in `.env`
- Ensure MySQL is running in XAMPP

**Error: "Unknown database"**
- Create database first: `CREATE DATABASE mlaravi;`

**Error: "Table already exists"**
- Drop existing database: `DROP DATABASE mlaravi;`
- Then re-import

## 📚 Additional Resources

- Full documentation: `database/README_DATABASE.md`
- Laravel docs: https://laravel.com/docs/8.x/database
- MySQL docs: https://dev.mysql.com/doc/

## 🎯 Next Steps

After successful database setup:
1. Configure SMS settings in `.env`
2. Set up email configuration
3. Upload banner images
4. Add business categories
5. Create customer accounts
6. Start using the application!

---

**Need Help?** Check `database/README_DATABASE.md` for detailed documentation.

