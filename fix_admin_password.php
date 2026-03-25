<?php
// Fix admin password - store as plain text (as the system expects)

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=mlaravi', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "===========================================\n";
    echo "Fixing Admin Password\n";
    echo "===========================================\n\n";
    
    // The system checks: where('password', $request->password)
    // This means it's storing plain text password, not hashed!
    
    $plainPassword = 'admin123';
    
    // Update password to plain text
    $stmt = $pdo->prepare("UPDATE pwa_admin SET password = :password, status = '1' WHERE email = 'admin@vbf.com'");
    $stmt->execute(['password' => $plainPassword]);
    
    echo "✓ Password updated to plain text (as system expects)\n\n";
    
    // Verify
    $stmt = $pdo->prepare("SELECT admin_id, name, email, password, status FROM pwa_admin WHERE email = 'admin@vbf.com'");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "Admin Details:\n";
        echo "  ID: " . $admin['admin_id'] . "\n";
        echo "  Name: " . $admin['name'] . "\n";
        echo "  Email: " . $admin['email'] . "\n";
        echo "  Password: " . $admin['password'] . "\n";
        echo "  Status: " . ($admin['status'] == '1' ? 'Active ✓' : 'Inactive') . "\n";
        echo "\n";
    }
    
    echo "===========================================\n";
    echo "LOGIN CREDENTIALS:\n";
    echo "===========================================\n";
    echo "URL:      http://localhost/vbf/admin/login\n";
    echo "Email:    admin@vbf.com\n";
    echo "Password: admin123\n";
    echo "===========================================\n\n";
    
    echo "✓ You can now login with these credentials!\n\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

