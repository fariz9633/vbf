@echo off
REM ============================================
REM VBF Database Import Script for Windows/XAMPP
REM ============================================

echo.
echo ========================================
echo VBF Database Import Script
echo ========================================
echo.

REM Set MySQL path (adjust if needed)
set MYSQL_PATH=C:\xampp\mysql\bin

REM Database configuration
set DB_NAME=mlaravi
set DB_USER=root
set SQL_FILE=vbf_database.sql

echo Checking if MySQL is accessible...
"%MYSQL_PATH%\mysql.exe" --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: MySQL not found at %MYSQL_PATH%
    echo Please update MYSQL_PATH in this script
    pause
    exit /b 1
)

echo.
echo This script will:
echo 1. Create database '%DB_NAME%' (if not exists)
echo 2. Import all tables and sample data
echo.
echo WARNING: This will overwrite existing data!
echo.

set /p CONFIRM="Do you want to continue? (Y/N): "
if /i not "%CONFIRM%"=="Y" (
    echo Import cancelled.
    pause
    exit /b 0
)

echo.
echo Enter MySQL root password (press Enter if no password):
set /p DB_PASS=

echo.
echo Creating database...
if "%DB_PASS%"=="" (
    "%MYSQL_PATH%\mysql.exe" -u %DB_USER% -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
) else (
    "%MYSQL_PATH%\mysql.exe" -u %DB_USER% -p%DB_PASS% -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
)

if errorlevel 1 (
    echo ERROR: Failed to create database
    pause
    exit /b 1
)

echo Database created successfully!
echo.
echo Importing SQL file...

if "%DB_PASS%"=="" (
    "%MYSQL_PATH%\mysql.exe" -u %DB_USER% %DB_NAME% < %SQL_FILE%
) else (
    "%MYSQL_PATH%\mysql.exe" -u %DB_USER% -p%DB_PASS% %DB_NAME% < %SQL_FILE%
)

if errorlevel 1 (
    echo ERROR: Failed to import SQL file
    pause
    exit /b 1
)

echo.
echo ========================================
echo Database imported successfully!
echo ========================================
echo.
echo Database Name: %DB_NAME%
echo Default Admin: admin@vbf.com
echo Default Password: admin123
echo.
echo IMPORTANT: Change the admin password after first login!
echo.
echo Next steps:
echo 1. Update your .env file with database credentials
echo 2. Run: php artisan key:generate
echo 3. Run: php artisan config:clear
echo 4. Access your application
echo.
pause

