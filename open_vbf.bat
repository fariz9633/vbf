@echo off
REM ============================================
REM VBF - Quick Launch Script
REM Opens VBF application in browser
REM ============================================

echo.
echo ========================================
echo VBF Quick Launch
echo ========================================
echo.

REM Check if Apache is running
netstat -ano | findstr ":80 " | findstr "LISTENING" >nul
if errorlevel 1 (
    echo [ERROR] Apache is NOT running!
    echo.
    echo Please start Apache in XAMPP Control Panel first.
    echo.
    pause
    exit /b 1
)

echo Apache is running...
echo.
echo Opening VBF application in your browser...
echo.

REM Open main URLs
echo Opening Homepage...
start http://localhost/vbf/

timeout /t 2 >nul

echo Opening Admin Panel...
start http://localhost/vbf/admin

echo.
echo ========================================
echo URLs Opened
echo ========================================
echo.
echo Homepage:     http://localhost/vbf/
echo Admin Panel:  http://localhost/vbf/admin
echo.
echo Admin Login:
echo   Email:    admin@vbf.com
echo   Password: admin123
echo.
echo IMPORTANT: Change admin password after first login!
echo.
echo ========================================
echo.

REM Ask if user wants to open test page
set /p OPEN_TEST="Do you want to open the test page? (Y/N): "
if /i "%OPEN_TEST%"=="Y" (
    echo Opening test page...
    start http://localhost/vbf/test.php
)

echo.
echo Done!
echo.
pause

