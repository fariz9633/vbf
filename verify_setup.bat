@echo off
REM ============================================
REM VBF - Verify Setup and URL Configuration
REM ============================================

echo.
echo ========================================
echo VBF Setup Verification
echo ========================================
echo.

cd /d "%~dp0"

echo Checking configuration...
echo.

REM Check .htaccess files
echo [1] Checking .htaccess files...
if exist ".htaccess" (
    echo    [OK] Root .htaccess found
) else (
    echo    [FAIL] Root .htaccess NOT found
)

if exist "public\.htaccess" (
    echo    [OK] Public .htaccess found
) else (
    echo    [FAIL] Public .htaccess NOT found
)

echo.

REM Check critical files
echo [2] Checking critical files...
if exist "public\index.php" (
    echo    [OK] public/index.php found
) else (
    echo    [FAIL] public/index.php NOT found
)

if exist "index.php" (
    echo    [OK] Root index.php found
) else (
    echo    [FAIL] Root index.php NOT found
)

if exist ".env" (
    echo    [OK] .env file found
) else (
    echo    [FAIL] .env file NOT found
)

echo.

REM Check Apache mod_rewrite
echo [3] Checking Apache configuration...
echo    Checking if mod_rewrite is enabled...

findstr /C:"LoadModule rewrite_module" "C:\xampp\apache\conf\httpd.conf" | findstr /V "#" >nul
if errorlevel 1 (
    echo    [WARN] mod_rewrite may not be enabled
    echo    Solution: Edit C:\xampp\apache\conf\httpd.conf
    echo              Uncomment: LoadModule rewrite_module modules/mod_rewrite.so
) else (
    echo    [OK] mod_rewrite appears to be enabled
)

echo.

REM Check AllowOverride
echo [4] Checking AllowOverride setting...
findstr /C:"AllowOverride All" "C:\xampp\apache\conf\httpd.conf" >nul
if errorlevel 1 (
    echo    [WARN] AllowOverride may not be set to All
    echo    Solution: Edit C:\xampp\apache\conf\httpd.conf
    echo              Change: AllowOverride None to AllowOverride All
) else (
    echo    [OK] AllowOverride is set to All
)

echo.

REM Check if Apache is running
echo [5] Checking if Apache is running...
netstat -ano | findstr ":80 " | findstr "LISTENING" >nul
if errorlevel 1 (
    echo    [FAIL] Apache is NOT running on port 80
    echo    Solution: Start Apache in XAMPP Control Panel
) else (
    echo    [OK] Apache is running on port 80
)

echo.

REM Check if MySQL is running
echo [6] Checking if MySQL is running...
netstat -ano | findstr ":3306 " | findstr "LISTENING" >nul
if errorlevel 1 (
    echo    [FAIL] MySQL is NOT running on port 3306
    echo    Solution: Start MySQL in XAMPP Control Panel
) else (
    echo    [OK] MySQL is running on port 3306
)

echo.

REM Test database connection
echo [7] Testing database connection...
php test_db.php 2>nul
if errorlevel 1 (
    echo    [WARN] Could not test database connection
) else (
    echo    [OK] Database connection test completed
)

echo.
echo ========================================
echo URL Configuration
echo ========================================
echo.
echo Your application should be accessible at:
echo.
echo   Homepage:     http://localhost/vbf/
echo   Admin Panel:  http://localhost/vbf/admin
echo   Test Page:    http://localhost/vbf/test.php
echo.
echo NOTE: Do NOT use /public/ in the URL
echo       The .htaccess handles this automatically
echo.

REM Ask if user wants to open browser
set /p OPEN_BROWSER="Do you want to open the application in browser? (Y/N): "
if /i "%OPEN_BROWSER%"=="Y" (
    echo.
    echo Opening browser...
    start http://localhost/vbf/
    timeout /t 2 >nul
    start http://localhost/vbf/test.php
)

echo.
echo ========================================
echo Next Steps
echo ========================================
echo.
echo 1. If you see any [FAIL] or [WARN] above, fix those issues
echo 2. Make sure Apache and MySQL are running in XAMPP
echo 3. Access: http://localhost/vbf/
echo 4. Login to admin: http://localhost/vbf/admin
echo    Email: admin@vbf.com
echo    Password: admin123
echo.
echo For detailed help, see: REMOVE_PUBLIC_URL_GUIDE.md
echo.
pause

