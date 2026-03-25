@echo off
REM ============================================
REM VBF - System Diagnostic Tool
REM ============================================

echo.
echo ========================================
echo VBF System Diagnostic
echo ========================================
echo.

cd /d "%~dp0"

echo Checking VBF Installation...
echo.
echo ========================================
echo 1. DIRECTORY STRUCTURE
echo ========================================
echo.

echo Current Directory: %CD%
echo.

echo Checking critical files and folders...
if exist "artisan" (echo [OK] artisan file found) else (echo [FAIL] artisan file NOT found)
if exist "composer.json" (echo [OK] composer.json found) else (echo [FAIL] composer.json NOT found)
if exist ".env" (echo [OK] .env file found) else (echo [WARN] .env file NOT found - copy from .env.example)
if exist "vendor" (echo [OK] vendor folder found) else (echo [FAIL] vendor folder NOT found - run: composer install)
if exist "public\index.php" (echo [OK] public/index.php found) else (echo [FAIL] public/index.php NOT found)
if exist "storage" (echo [OK] storage folder found) else (echo [FAIL] storage folder NOT found)
if exist "bootstrap\cache" (echo [OK] bootstrap/cache found) else (echo [FAIL] bootstrap/cache NOT found)

echo.
echo ========================================
echo 2. PHP CONFIGURATION
echo ========================================
echo.

php -v
if errorlevel 1 (
    echo [FAIL] PHP not found in PATH
    echo Please add PHP to your system PATH or use XAMPP shell
) else (
    echo [OK] PHP is accessible
)

echo.
echo PHP Extensions:
php -m | findstr /C:"pdo_mysql" >nul && echo [OK] pdo_mysql enabled || echo [FAIL] pdo_mysql NOT enabled
php -m | findstr /C:"mbstring" >nul && echo [OK] mbstring enabled || echo [FAIL] mbstring NOT enabled
php -m | findstr /C:"openssl" >nul && echo [OK] openssl enabled || echo [FAIL] openssl NOT enabled
php -m | findstr /C:"tokenizer" >nul && echo [OK] tokenizer enabled || echo [FAIL] tokenizer NOT enabled
php -m | findstr /C:"xml" >nul && echo [OK] xml enabled || echo [FAIL] xml NOT enabled
php -m | findstr /C:"ctype" >nul && echo [OK] ctype enabled || echo [FAIL] ctype NOT enabled
php -m | findstr /C:"json" >nul && echo [OK] json enabled || echo [FAIL] json NOT enabled

echo.
echo ========================================
echo 3. COMPOSER
echo ========================================
echo.

composer --version >nul 2>&1
if errorlevel 1 (
    echo [WARN] Composer not found in PATH
    echo You may need to install Composer or add it to PATH
) else (
    composer --version
    echo [OK] Composer is accessible
)

echo.
echo ========================================
echo 4. LARAVEL CONFIGURATION
echo ========================================
echo.

if exist "artisan" (
    echo Laravel Version:
    php artisan --version
    
    echo.
    echo Environment:
    php artisan env
    
    echo.
    echo Checking .env configuration...
    if exist ".env" (
        findstr /C:"APP_KEY=" .env >nul
        if errorlevel 1 (
            echo [FAIL] APP_KEY not set in .env
            echo Run: php artisan key:generate
        ) else (
            findstr /C:"APP_KEY=base64:" .env >nul
            if errorlevel 1 (
                echo [WARN] APP_KEY exists but may not be generated
                echo Run: php artisan key:generate
            ) else (
                echo [OK] APP_KEY is set
            )
        )
        
        echo.
        echo Database Configuration:
        findstr /C:"DB_DATABASE=" .env
        findstr /C:"DB_USERNAME=" .env
        
    ) else (
        echo [FAIL] .env file not found
    )
) else (
    echo [FAIL] artisan not found - not a Laravel project?
)

echo.
echo ========================================
echo 5. FILE PERMISSIONS
echo ========================================
echo.

echo Checking writable directories...
if exist "storage" (
    echo [CHECK] storage folder exists
    dir /a "storage" >nul 2>&1 && echo [OK] storage is accessible
) else (
    echo [FAIL] storage folder not found
)

if exist "bootstrap\cache" (
    echo [CHECK] bootstrap/cache folder exists
    dir /a "bootstrap\cache" >nul 2>&1 && echo [OK] bootstrap/cache is accessible
) else (
    echo [FAIL] bootstrap/cache folder not found
)

echo.
echo ========================================
echo 6. DATABASE CONNECTION
echo ========================================
echo.

if exist ".env" (
    echo Testing database connection...
    php artisan tinker --execute="echo 'Testing DB connection...'; try { DB::connection()->getPdo(); echo 'Database connection: OK'; } catch (Exception $e) { echo 'Database connection: FAILED - ' . $e->getMessage(); }"
) else (
    echo [SKIP] Cannot test - .env not found
)

echo.
echo ========================================
echo 7. WEB SERVER
echo ========================================
echo.

echo Checking if Apache is running...
netstat -ano | findstr ":80" >nul
if errorlevel 1 (
    echo [WARN] Port 80 not in use - Apache may not be running
    echo Start Apache in XAMPP Control Panel
) else (
    echo [OK] Port 80 is in use (Apache likely running)
)

echo.
echo Checking if MySQL is running...
netstat -ano | findstr ":3306" >nul
if errorlevel 1 (
    echo [WARN] Port 3306 not in use - MySQL may not be running
    echo Start MySQL in XAMPP Control Panel
) else (
    echo [OK] Port 3306 is in use (MySQL likely running)
)

echo.
echo ========================================
echo 8. RECENT ERRORS
echo ========================================
echo.

if exist "storage\logs\laravel.log" (
    echo Last 10 lines of laravel.log:
    echo.
    powershell -Command "Get-Content 'storage\logs\laravel.log' -Tail 10"
) else (
    echo [INFO] No laravel.log file found (no errors yet)
)

echo.
echo ========================================
echo DIAGNOSTIC COMPLETE
echo ========================================
echo.
echo Summary:
echo - Check items marked [FAIL] or [WARN] above
echo - Fix any issues before proceeding
echo.
echo Common fixes:
echo 1. Run: composer install (if vendor missing)
echo 2. Run: fix_permissions.bat (for permission issues)
echo 3. Run: database\import_database.bat (for database setup)
echo 4. Copy .env.example to .env and configure
echo 5. Run: php artisan key:generate
echo.
echo Access your application:
echo http://localhost/vbf/
echo.
pause

