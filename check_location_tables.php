<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=mlaravi', 'root', '');
    
    echo "Checking location tables...\n\n";
    
    $tables = [
        'jm_blr_rs_vibhag' => 'Cities/Divisions',
        'jm_blr_rs_bhag' => 'Districts', 
        'jm_blr_rs_nagar' => 'Taluks',
        'jm_blr_rs_vasathi' => 'Areas'
    ];
    
    foreach ($tables as $table => $description) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            $count = $pdo->query("SELECT COUNT(*) FROM $table")->fetchColumn();
            echo "✓ $table ($description): $count records\n";
        } else {
            echo "❌ $table ($description): Missing!\n";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
}
?>