<?php
// Create pwa_admin_logs table if it doesn't exist

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=mlaravi', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Checking for pwa_admin_logs table...\n";
    
    $stmt = $pdo->query("SHOW TABLES LIKE 'pwa_admin_logs'");
    
    if ($stmt->rowCount() == 0) {
        echo "Table doesn't exist. Creating...\n";
        
        $sql = "CREATE TABLE `pwa_admin_logs` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `adminid` int(11) DEFAULT NULL,
            `login` datetime DEFAULT NULL,
            `logout` datetime DEFAULT NULL,
            `ip` varchar(50) DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $pdo->exec($sql);
        echo "✓ pwa_admin_logs table created successfully!\n";
    } else {
        echo "✓ pwa_admin_logs table already exists\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

