<?php
// Check admin credentials in database

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=mlaravi', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "===========================================\n";
    echo "VBF Admin Credentials Check\n";
    echo "===========================================\n\n";
    
    // Check if pwa_admin table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'pwa_admin'");
    if ($stmt->rowCount() == 0) {
        echo "ERROR: pwa_admin table does not exist!\n";
        echo "Solution: Import database using database\\import_database.bat\n";
        exit(1);
    }
    
    echo "✓ pwa_admin table exists\n\n";
    
    // Get all admin users
    $stmt = $pdo->query("SELECT admin_id, name, email, phone, status FROM pwa_admin");
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($admins) == 0) {
        echo "WARNING: No admin users found in database!\n\n";
        echo "Creating default admin user...\n";
        
        // Create default admin
        $password = password_hash('admin123', PASSWORD_BCRYPT);
        $sql = "INSERT INTO pwa_admin (name, email, password, phone, status, created_at, updated_at) 
                VALUES ('Admin', 'admin@vbf.com', :password, '9876543210', '1', NOW(), NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['password' => $password]);
        
        echo "✓ Default admin created successfully!\n\n";
        echo "Credentials:\n";
        echo "  Email: admin@vbf.com\n";
        echo "  Password: admin123\n\n";
        
    } else {
        echo "Found " . count($admins) . " admin user(s):\n\n";
        
        foreach ($admins as $admin) {
            echo "Admin ID: " . $admin['admin_id'] . "\n";
            echo "  Name: " . $admin['name'] . "\n";
            echo "  Email: " . $admin['email'] . "\n";
            echo "  Phone: " . $admin['phone'] . "\n";
            echo "  Status: " . ($admin['status'] == '1' ? 'Active' : 'Inactive') . "\n";
            echo "\n";
        }
        
        // Check if admin@vbf.com exists
        $stmt = $pdo->prepare("SELECT admin_id, email FROM pwa_admin WHERE email = 'admin@vbf.com'");
        $stmt->execute();
        $defaultAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$defaultAdmin) {
            echo "WARNING: admin@vbf.com does not exist!\n";
            echo "Creating it now...\n\n";
            
            $password = password_hash('admin123', PASSWORD_BCRYPT);
            $sql = "INSERT INTO pwa_admin (name, email, password, phone, status, created_at, updated_at) 
                    VALUES ('Admin', 'admin@vbf.com', :password, '9876543210', '1', NOW(), NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['password' => $password]);
            
            echo "✓ admin@vbf.com created!\n\n";
        }
    }
    
    // Reset password for admin@vbf.com
    echo "===========================================\n";
    echo "Resetting password for admin@vbf.com...\n";
    echo "===========================================\n\n";
    
    $password = password_hash('admin123', PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE pwa_admin SET password = :password, status = '1' WHERE email = 'admin@vbf.com'");
    $stmt->execute(['password' => $password]);
    
    echo "✓ Password reset successfully!\n\n";
    
    // Verify the update
    $stmt = $pdo->prepare("SELECT admin_id, name, email, phone, status FROM pwa_admin WHERE email = 'admin@vbf.com'");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "Current admin@vbf.com details:\n";
        echo "  Admin ID: " . $admin['admin_id'] . "\n";
        echo "  Name: " . $admin['name'] . "\n";
        echo "  Email: " . $admin['email'] . "\n";
        echo "  Phone: " . $admin['phone'] . "\n";
        echo "  Status: " . ($admin['status'] == '1' ? 'Active ✓' : 'Inactive ✗') . "\n";
        echo "\n";
    }
    
    echo "===========================================\n";
    echo "CREDENTIALS TO USE:\n";
    echo "===========================================\n";
    echo "Email:    admin@vbf.com\n";
    echo "Password: admin123\n";
    echo "\n";
    echo "Login URL: http://localhost/vbf/admin\n";
    echo "===========================================\n";
    
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
    exit(1);
}

