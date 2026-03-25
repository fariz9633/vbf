@echo off
REM ============================================
REM VBF - Fix Permissions and Clear Cache
REM For Windows/XAMPP
REM ============================================

echo.
echo ========================================
echo VBF Permission Fix and Cache Clear
echo ========================================
echo.

cd /d "%~dp0"

echo Current directory: %CD%
echo.

REM Check if we're in the right directory
if not exist "artisan" (
    echo ERROR: artisan file not found!
    echo Please run this script from the VBF root directory.
    pause
    exit /b 1
)

echo Step 1: Clearing Laravel caches...
echo.

php artisan config:clear
if errorlevel 1 (
    echo WARNING: Failed to clear config cache
) else (
    echo - Config cache cleared
)

php artisan cache:clear
if errorlevel 1 (
    echo WARNING: Failed to clear application cache
) else (
    echo - Application cache cleared
)

php artisan route:clear
if errorlevel 1 (
    echo WARNING: Failed to clear route cache
) else (
    echo - Route cache cleared
)

php artisan view:clear
if errorlevel 1 (
    echo WARNING: Failed to clear view cache
) else (
    echo - View cache cleared
)

echo.
echo Step 2: Setting folder permissions...
echo.

REM Remove read-only attribute from storage and bootstrap/cache
attrib -r "storage\*" /s /d
attrib -r "bootstrap\cache\*" /s /d

echo - Read-only attributes removed
echo.

echo Step 3: Checking critical folders...
echo.

if not exist "storage\framework\sessions" (
    echo Creating storage\framework\sessions...
    mkdir "storage\framework\sessions"
)

if not exist "storage\framework\views" (
    echo Creating storage\framework\views...
    mkdir "storage\framework\views"
)

if not exist "storage\framework\cache" (
    echo Creating storage\framework\cache...
    mkdir "storage\framework\cache"
)

if not exist "storage\logs" (
    echo Creating storage\logs...
    mkdir "storage\logs"
)

if not exist "bootstrap\cache" (
    echo Creating bootstrap\cache...
    mkdir "bootstrap\cache"
)

echo - All critical folders verified
echo.

echo Step 4: Checking vendor folder...
echo.

if not exist "vendor" (
    echo WARNING: vendor folder not found!
    echo You need to run: composer install
    echo.
    set /p INSTALL_COMPOSER="Do you want to run composer install now? (Y/N): "
    if /i "%INSTALL_COMPOSER%"=="Y" (
        echo Running composer install...
        composer install
    )
) else (
    echo - Vendor folder exists
)

echo.
echo Step 5: Checking .env file...
echo.

if not exist ".env" (
    echo WARNING: .env file not found!
    if exist ".env.example" (
        echo Copying .env.example to .env...
        copy ".env.example" ".env"
        echo.
        echo IMPORTANT: You need to:
        echo 1. Update database credentials in .env
        echo 2. Run: php artisan key:generate
    ) else (
        echo ERROR: .env.example not found either!
    )
) else (
    echo - .env file exists
)

echo.
echo Step 6: Generating application key (if needed)...
echo.

findstr /C:"APP_KEY=base64:" .env >nul
if errorlevel 1 (
    echo Generating new application key...
    php artisan key:generate
) else (
    echo - Application key already set
)

echo.
echo Step 7: Creating storage link...
echo.

php artisan storage:link
if errorlevel 1 (
    echo - Storage link already exists or failed
) else (
    echo - Storage link created
)

echo.
echo ========================================
echo Fix Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Make sure XAMPP Apache and MySQL are running
echo 2. Import database using: database\import_database.bat
echo 3. Access your site: http://localhost/vbf/
echo.
echo If you still have issues:
echo - Check storage\logs\laravel.log for errors
echo - Verify .env database settings
echo - Make sure mod_rewrite is enabled in Apache
echo.
pause

