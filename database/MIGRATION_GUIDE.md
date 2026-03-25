# Database Migration & Update Guide

## Overview
This guide helps you manage database changes and updates for the VBF application.

## Initial Setup vs Updates

### For New Installation
Use the complete SQL file:
```bash
mysql -u root -p mlaravi < database/vbf_database.sql
```

### For Existing Database Updates
Follow the migration procedures below.

## Creating Database Backups

### Before Any Changes - ALWAYS BACKUP!

**Method 1: Using mysqldump (Recommended)**
```bash
# Full backup
mysqldump -u root -p mlaravi > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup specific tables
mysqldump -u root -p mlaravi customers opportunity pwa_meetings > backup_critical_$(date +%Y%m%d).sql

# Backup structure only (no data)
mysqldump -u root -p --no-data mlaravi > backup_structure_only.sql
```

**Method 2: Using phpMyAdmin**
1. Select database `mlaravi`
2. Click "Export" tab
3. Choose "Quick" or "Custom" method
4. Click "Go" to download

**Method 3: Using Laravel**
```bash
# Install backup package (if not already)
composer require spatie/laravel-backup

# Run backup
php artisan backup:run
```

## Restoring from Backup

```bash
# Restore full database
mysql -u root -p mlaravi < backup_20231204_153000.sql

# Restore specific tables
mysql -u root -p mlaravi < backup_critical_20231204.sql
```

## Adding New Tables

### Example: Adding a new "pwa_testimonials" table

**Step 1: Create migration file**
```bash
php artisan make:migration create_pwa_testimonials_table
```

**Step 2: Edit migration file** (`database/migrations/YYYY_MM_DD_HHMMSS_create_pwa_testimonials_table.php`)
```php
public function up()
{
    Schema::create('pwa_testimonials', function (Blueprint $table) {
        $table->id();
        $table->integer('cust_id')->nullable();
        $table->string('title')->nullable();
        $table->text('message')->nullable();
        $table->string('image')->nullable();
        $table->enum('status', ['0', '1'])->default('1');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('pwa_testimonials');
}
```

**Step 3: Run migration**
```bash
php artisan migrate
```

**Step 4: Update SQL file for future installations**
Add to `database/vbf_database.sql`:
```sql
-- Testimonials Table
CREATE TABLE `pwa_testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Modifying Existing Tables

### Example: Adding a column to customers table

**Step 1: Create migration**
```bash
php artisan make:migration add_company_name_to_customers_table
```

**Step 2: Edit migration**
```php
public function up()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->string('company_name')->nullable()->after('username');
    });
}

public function down()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->dropColumn('company_name');
    });
}
```

**Step 3: Run migration**
```bash
php artisan migrate
```

**Step 4: Update main SQL file**
Update the customers table definition in `vbf_database.sql`

## Common Migration Scenarios

### 1. Adding a Foreign Key
```php
Schema::table('opportunity', function (Blueprint $table) {
    $table->foreign('cust_id')
          ->references('id')
          ->on('customers')
          ->onDelete('cascade');
});
```

### 2. Changing Column Type
```php
Schema::table('customers', function (Blueprint $table) {
    $table->text('address')->change();
});
```

### 3. Renaming a Column
```php
Schema::table('customers', function (Blueprint $table) {
    $table->renameColumn('username', 'full_name');
});
```

### 4. Adding an Index
```php
Schema::table('customers', function (Blueprint $table) {
    $table->index('phone');
    $table->index(['chapter', 'category']);
});
```

### 5. Dropping a Column
```php
Schema::table('customers', function (Blueprint $table) {
    $table->dropColumn('old_field');
});
```

## Version Control for Database Changes

### Keep Track of Changes
Create a changelog file: `database/CHANGELOG.md`

```markdown
# Database Changelog

## Version 1.1.0 - 2024-01-15
- Added `company_name` to customers table
- Created `pwa_testimonials` table
- Added index on customers.phone

## Version 1.0.0 - 2023-12-04
- Initial database schema
- 42 tables created
```

## Rolling Back Migrations

### Rollback last migration
```bash
php artisan migrate:rollback
```

### Rollback last 3 migrations
```bash
php artisan migrate:rollback --step=3
```

### Rollback all migrations
```bash
php artisan migrate:reset
```

### Rollback and re-run all migrations
```bash
php artisan migrate:refresh
```

### Rollback, re-run, and seed
```bash
php artisan migrate:refresh --seed
```

## Data Seeding

### Creating Seeders
```bash
php artisan make:seeder CategorySeeder
```

### Example Seeder
```php
public function run()
{
    DB::table('pwa_category')->insert([
        ['name' => 'Technology', 'status' => '1', 'created_at' => now()],
        ['name' => 'Healthcare', 'status' => '1', 'created_at' => now()],
        ['name' => 'Education', 'status' => '1', 'created_at' => now()],
    ]);
}
```

### Running Seeders
```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=CategorySeeder
```

## Production Deployment Checklist

- [ ] Backup production database
- [ ] Test migrations on staging/local first
- [ ] Review all migration files
- [ ] Check for data loss scenarios
- [ ] Plan rollback strategy
- [ ] Schedule maintenance window
- [ ] Notify users of downtime
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Verify data integrity
- [ ] Test critical functionality
- [ ] Monitor for errors

## Emergency Procedures

### If Migration Fails

1. **Don't Panic!**
2. Check error message
3. Restore from backup if needed:
   ```bash
   mysql -u root -p mlaravi < backup_before_migration.sql
   ```
4. Fix the migration file
5. Try again

### If Data is Lost

1. Stop the application immediately
2. Restore from most recent backup
3. Investigate what went wrong
4. Document the incident
5. Improve backup procedures

## Best Practices

1. **Always backup before changes**
2. **Test on local/staging first**
3. **Use migrations for all schema changes**
4. **Keep SQL file updated**
5. **Document all changes**
6. **Use version control (Git)**
7. **Never edit production DB directly**
8. **Use transactions for data changes**
9. **Test rollback procedures**
10. **Keep backups for 30+ days**

## Useful Commands

```bash
# Check migration status
php artisan migrate:status

# Create migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback
php artisan migrate:rollback

# Fresh install (WARNING: Deletes all data!)
php artisan migrate:fresh

# Fresh install with seeders
php artisan migrate:fresh --seed

# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();
```

## Support

For complex migrations or issues:
1. Check Laravel documentation: https://laravel.com/docs/8.x/migrations
2. Review error logs: `storage/logs/laravel.log`
3. Contact development team

