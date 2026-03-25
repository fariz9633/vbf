#!/bin/bash
# ============================================
# VBF Database Import Script for Linux/Mac
# ============================================

echo ""
echo "========================================"
echo "VBF Database Import Script"
echo "========================================"
echo ""

# Database configuration
DB_NAME="mlaravi"
DB_USER="root"
SQL_FILE="vbf_database.sql"

# Check if MySQL is installed
if ! command -v mysql &> /dev/null; then
    echo "ERROR: MySQL is not installed or not in PATH"
    exit 1
fi

echo "MySQL found: $(mysql --version)"
echo ""

echo "This script will:"
echo "1. Create database '$DB_NAME' (if not exists)"
echo "2. Import all tables and sample data"
echo ""
echo "WARNING: This will overwrite existing data!"
echo ""

read -p "Do you want to continue? (Y/N): " CONFIRM
if [[ ! $CONFIRM =~ ^[Yy]$ ]]; then
    echo "Import cancelled."
    exit 0
fi

echo ""
read -sp "Enter MySQL root password (press Enter if no password): " DB_PASS
echo ""

# Create database
echo ""
echo "Creating database..."
if [ -z "$DB_PASS" ]; then
    mysql -u $DB_USER -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
else
    mysql -u $DB_USER -p$DB_PASS -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
fi

if [ $? -ne 0 ]; then
    echo "ERROR: Failed to create database"
    exit 1
fi

echo "Database created successfully!"
echo ""
echo "Importing SQL file..."

# Import SQL file
if [ -z "$DB_PASS" ]; then
    mysql -u $DB_USER $DB_NAME < $SQL_FILE
else
    mysql -u $DB_USER -p$DB_PASS $DB_NAME < $SQL_FILE
fi

if [ $? -ne 0 ]; then
    echo "ERROR: Failed to import SQL file"
    exit 1
fi

echo ""
echo "========================================"
echo "Database imported successfully!"
echo "========================================"
echo ""
echo "Database Name: $DB_NAME"
echo "Default Admin: admin@vbf.com"
echo "Default Password: admin123"
echo ""
echo "IMPORTANT: Change the admin password after first login!"
echo ""
echo "Next steps:"
echo "1. Update your .env file with database credentials"
echo "2. Run: php artisan key:generate"
echo "3. Run: php artisan config:clear"
echo "4. Access your application"
echo ""

