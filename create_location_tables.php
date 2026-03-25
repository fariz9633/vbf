<?php
// Create missing location tables for VBF

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=mlaravi', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Creating missing location tables...\n\n";
    
    // 1. Create jm_blr_rs_vibhag (City/Division)
    $sql1 = "CREATE TABLE IF NOT EXISTS `jm_blr_rs_vibhag` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `name_kn` varchar(255) DEFAULT NULL,
        `status` enum('0','1') DEFAULT '1',
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql1);
    echo "✓ Created table: jm_blr_rs_vibhag\n";
    
    // 2. Create jm_blr_rs_bhag (District)
    $sql2 = "CREATE TABLE IF NOT EXISTS `jm_blr_rs_bhag` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `vibhag_id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `name_kn` varchar(255) DEFAULT NULL,
        `status` enum('0','1') DEFAULT '1',
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `vibhag_id` (`vibhag_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql2);
    echo "✓ Created table: jm_blr_rs_bhag\n";
    
    // 3. Create jm_blr_rs_nagar (Taluk)
    $sql3 = "CREATE TABLE IF NOT EXISTS `jm_blr_rs_nagar` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `bhag_id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `name_kn` varchar(255) DEFAULT NULL,
        `status` enum('0','1') DEFAULT '1',
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `bhag_id` (`bhag_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql3);
    echo "✓ Created table: jm_blr_rs_nagar\n";
    
    // 4. Create jm_blr_rs_vasathi (Area)
    $sql4 = "CREATE TABLE IF NOT EXISTS `jm_blr_rs_vasathi` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `nagar_id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `name_kn` varchar(255) DEFAULT NULL,
        `status` enum('0','1') DEFAULT '1',
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `nagar_id` (`nagar_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql4);
    echo "✓ Created table: jm_blr_rs_vasathi\n";
    
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "INSERTING SAMPLE DATA...\n";
    echo str_repeat("=", 50) . "\n\n";
    
    // Insert sample data
    // Cities (Vibhag)
    $pdo->exec("INSERT IGNORE INTO jm_blr_rs_vibhag (id, name, name_kn) VALUES 
        (1, 'Bangalore', 'ಬೆಂಗಳೂರು'),
        (2, 'Mysore', 'ಮೈಸೂರು'),
        (3, 'Hubli', 'ಹುಬ್ಳಿ'),
        (4, 'Mangalore', 'ಮಂಗಳೂರು')");
    echo "✓ Inserted sample cities\n";
    
    // Districts (Bhag)
    $pdo->exec("INSERT IGNORE INTO jm_blr_rs_bhag (id, vibhag_id, name, name_kn) VALUES 
        (1, 1, 'Bangalore Urban', 'ಬೆಂಗಳೂರು ನಗರ'),
        (2, 1, 'Bangalore Rural', 'ಬೆಂಗಳೂರು ಗ್ರಾಮೀಣ'),
        (3, 2, 'Mysore District', 'ಮೈಸೂರು ಜಿಲ್ಲೆ'),
        (4, 3, 'Dharwad', 'ಧಾರವಾಡ'),
        (5, 4, 'Dakshina Kannada', 'ದಕ್ಷಿಣ ಕನ್ನಡ')");
    echo "✓ Inserted sample districts\n";
    
    // Taluks (Nagar)
    $pdo->exec("INSERT IGNORE INTO jm_blr_rs_nagar (id, bhag_id, name, name_kn) VALUES 
        (1, 1, 'Bangalore North', 'ಬೆಂಗಳೂರು ಉತ್ತರ'),
        (2, 1, 'Bangalore South', 'ಬೆಂಗಳೂರು ದಕ್ಷಿಣ'),
        (3, 1, 'Bangalore East', 'ಬೆಂಗಳೂರು ಪೂರ್ವ'),
        (4, 1, 'Bangalore West', 'ಬೆಂಗಳೂರು ಪಶ್ಚಿಮ'),
        (5, 2, 'Devanahalli', 'ದೇವನಹಳ್ಳಿ'),
        (6, 3, 'Mysore Taluk', 'ಮೈಸೂರು ತಾಲೂಕು')");
    echo "✓ Inserted sample taluks\n";
    
    // Areas (Vasathi)
    $pdo->exec("INSERT IGNORE INTO jm_blr_rs_vasathi (id, nagar_id, name, name_kn) VALUES 
        (1, 1, 'Hebbal', 'ಹೆಬ್ಬಾಳ್'),
        (2, 1, 'Yelahanka', 'ಯಲಹಂಕ'),
        (3, 1, 'RT Nagar', 'ಆರ್ ಟಿ ನಗರ'),
        (4, 2, 'Jayanagar', 'ಜಯನಗರ'),
        (5, 2, 'BTM Layout', 'ಬಿಟಿಎಂ ಲೇಔಟ್'),
        (6, 2, 'Koramangala', 'ಕೊರಮಂಗಲ'),
        (7, 3, 'Whitefield', 'ವೈಟ್‌ಫೀಲ್ಡ್'),
        (8, 3, 'Marathahalli', 'ಮಾರಾಠಹಳ್ಳಿ'),
        (9, 4, 'Rajajinagar', 'ರಾಜಾಜಿನಗರ'),
        (10, 4, 'Malleshwaram', 'ಮಲ್ಲೇಶ್ವರಂ')");
    echo "✓ Inserted sample areas\n";
    
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "SUCCESS! All location tables created with sample data.\n";
    echo str_repeat("=", 50) . "\n\n";
    
    // Verify tables
    $tables = ['jm_blr_rs_vibhag', 'jm_blr_rs_bhag', 'jm_blr_rs_nagar', 'jm_blr_rs_vasathi'];
    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
        $count = $stmt->fetchColumn();
        echo "✓ $table: $count records\n";
    }
    
    echo "\nYour application should now work without the table error!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\nMake sure:\n";
    echo "1. MySQL is running in XAMPP\n";
    echo "2. Database 'mlaravi' exists\n";
    echo "3. Run: database\\import_database.bat\n";
}
?>