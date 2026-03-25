# VBF XAMPP Setup & Troubleshooting Guide

## Issue Fixed: "Failed to open stream: No such file or directory"

### What Was Wrong?
The root `index.php` file had incorrect path separators for Windows, and the `.htaccess` file wasn't properly configured to redirect requests to the `public` folder.

### What Was Fixed?
1. ✅ Updated `index.php` to use `DIRECTORY_SEPARATOR` for cross-platform compatibility
2. ✅ Updated `.htaccess` to redirect all requests to the `public` folder

## Complete XAMPP Setup Instructions

### Step 1: Verify XAMPP Installation
1. Open XAMPP Control Panel
2. Start **Apache** and **MySQL** services
3. Verify they're running (green indicators)

### Step 2: Access Your Application

**Option A: Using localhost (Recommended)**
```
http://localhost/vbf/
```

**Option B: Using 127.0.0.1**
```
http://127.0.0.1/vbf/
```

**Option C: Direct public folder access**
```
http://localhost/vbf/public/
```

### Step 3: Configure Virtual Host (Optional but Recommended)

This allows you to use a custom domain like `http://vbf.local`

**1. Edit Windows hosts file:**
- Open as Administrator: `C:\Windows\System32\drivers\etc\hosts`
- Add this line:
```
127.0.0.1    vbf.local
```

**2. Edit XAMPP httpd-vhosts.conf:**
- Location: `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
- Add this configuration:
```apache
<VirtualHost *:80>
    DocumentRoot "D:/xampp/htdocs/vbf/public"
    ServerName vbf.local
    
    <Directory "D:/xampp/htdocs/vbf/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog "logs/vbf-error.log"
    CustomLog "logs/vbf-access.log" common
</VirtualHost>
```

**3. Restart Apache in XAMPP**

**4. Access your site:**
```
http://vbf.local
```

### Step 4: Database Setup

**1. Import Database:**
```bash
# Open command prompt in project directory
cd D:\xampp\htdocs\vbf\database
import_database.bat
```

**OR use phpMyAdmin:**
1. Go to `http://localhost/phpmyadmin`
2. Create database `mlaravi`
3. Import `database/vbf_database.sql`

**2. Configure .env file:**
```env
APP_NAME=VBF
APP_ENV=local
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost/vbf

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mlaravi
DB_USERNAME=root
DB_PASSWORD=
```

**3. Generate Application Key:**
```bash
php artisan key:generate
```

**4. Clear Cache:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 5: Set Permissions (Important!)

**For Windows:**
Right-click on these folders and ensure they're not read-only:
- `storage/`
- `bootstrap/cache/`

**Set full permissions:**
```bash
# Run in Command Prompt as Administrator
icacls "D:\xampp\htdocs\vbf\storage" /grant Everyone:(OI)(CI)F /T
icacls "D:\xampp\htdocs\vbf\bootstrap\cache" /grant Everyone:(OI)(CI)F /T
```

## Common Issues & Solutions

### Issue 1: "Failed to open stream" Error
**Solution:** Already fixed! The `index.php` and `.htaccess` files have been updated.

### Issue 2: Blank White Page
**Causes:**
- PHP errors with display_errors off
- Missing vendor folder
- Permission issues

**Solutions:**
```bash
# Check if vendor exists
dir vendor

# If not, install dependencies
composer install

# Enable error display temporarily
# Edit public/index.php and add at the top:
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### Issue 3: 404 Not Found
**Causes:**
- mod_rewrite not enabled
- .htaccess not working

**Solutions:**
1. Enable mod_rewrite in XAMPP:
   - Edit `C:\xampp\apache\conf\httpd.conf`
   - Find and uncomment: `LoadModule rewrite_module modules/mod_rewrite.so`
   - Restart Apache

2. Allow .htaccess override:
   - In same file, find `<Directory "D:/xampp/htdocs">`
   - Change `AllowOverride None` to `AllowOverride All`
   - Restart Apache

### Issue 4: Database Connection Error
**Solutions:**
```bash
# Test MySQL connection
mysql -u root -p

# Check if MySQL is running in XAMPP
# Verify .env database credentials
# Run this to test connection:
php artisan tinker
>>> DB::connection()->getPdo();
```

### Issue 5: "Class not found" Errors
**Solution:**
```bash
# Regenerate autoload files
composer dump-autoload

# Clear all caches
php artisan optimize:clear
```

### Issue 6: CSS/JS Not Loading
**Causes:**
- Wrong asset paths
- Missing public files

**Solutions:**
1. Check if files exist in `public/` folder
2. Update asset URLs in blade files:
```php
// Instead of:
<link href="/css/style.css">

// Use:
<link href="{{ asset('css/style.css') }}">
```

3. Run Laravel Mix (if using):
```bash
npm install
npm run dev
```

### Issue 7: Session/Cache Issues
**Solution:**
```bash
# Clear all Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Clear session
php artisan session:flush
```

## Verification Checklist

- [ ] XAMPP Apache is running
- [ ] XAMPP MySQL is running
- [ ] Database `mlaravi` created and imported
- [ ] `.env` file configured correctly
- [ ] Application key generated
- [ ] Vendor folder exists (run `composer install` if not)
- [ ] Storage and cache folders are writable
- [ ] mod_rewrite is enabled in Apache
- [ ] Can access `http://localhost/vbf/`
- [ ] No errors in browser console
- [ ] Can login to admin panel

## Testing Your Setup

### 1. Test Homepage
```
http://localhost/vbf/
```
Should show the VBF homepage

### 2. Test Admin Login
```
http://localhost/vbf/admin
```
Login with:
- Email: admin@vbf.com
- Password: admin123

### 3. Test Database Connection
```bash
php artisan tinker
>>> DB::table('pwa_admin')->count();
```
Should return: 1

### 4. Check Logs
If errors occur, check:
- `storage/logs/laravel.log`
- `C:\xampp\apache\logs\error.log`

## Performance Optimization

### 1. Enable OPcache
Edit `C:\xampp\php\php.ini`:
```ini
[opcache]
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
```

### 2. Optimize Laravel
```bash
# For production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# For development (don't cache)
php artisan optimize:clear
```

## Useful Commands

```bash
# Check PHP version
php -v

# Check Laravel version
php artisan --version

# List all routes
php artisan route:list

# Create storage link
php artisan storage:link

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Start development server (alternative to XAMPP)
php artisan serve
# Then access: http://localhost:8000
```

## Getting Help

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check Apache logs: `C:\xampp\apache\logs\error.log`
3. Enable debug mode in `.env`: `APP_DEBUG=true`
4. Check browser console for JavaScript errors

## Next Steps

After successful setup:
1. Change admin password
2. Configure SMS settings
3. Set up email configuration
4. Upload banner images
5. Add business categories
6. Create test customer accounts

---

**Your application should now be running successfully!**

Access it at: `http://localhost/vbf/`

