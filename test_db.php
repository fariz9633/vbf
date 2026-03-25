<?php
// Test database connection
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=mlaravi', 'root', '');
    echo "✓ Database connection: SUCCESS\n";
    echo "✓ Database 'mlaravi' exists and is accessible\n";
    
    // Test if tables exist
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "✓ Found " . count($tables) . " tables in database\n";
        echo "\nSample tables:\n";
        foreach (array_slice($tables, 0, 5) as $table) {
            echo "  - $table\n";
        }
    } else {
        echo "✗ No tables found - database needs to be imported\n";
        echo "\nRun: database\\import_database.bat\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Database connection: FAILED\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'Unknown database') !== false) {
        echo "Solution: Database 'mlaravi' does not exist\n";
        echo "Run: database\\import_database.bat\n";
    } elseif (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "Solution: Check database credentials in .env file\n";
    } else {
        echo "Solution: Make sure MySQL is running in XAMPP\n";
    }
}

