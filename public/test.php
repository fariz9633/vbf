<!DOCTYPE html>
<html>
<head>
    <title>VBF Test Page</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        .info { color: #17a2b8; }
        h1 { color: #333; }
        .test-item { padding: 10px; margin: 10px 0; border-left: 4px solid #ddd; background: #f9f9f9; }
        .test-item.pass { border-left-color: #28a745; }
        .test-item.fail { border-left-color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 VBF System Test</h1>
        <p>Testing your VBF installation...</p>
        <hr>
        
        <?php
        $allPassed = true;
        
        // Test 1: PHP Version
        echo '<div class="test-item pass">';
        echo '<strong>✓ PHP Version:</strong> ' . phpversion();
        echo '</div>';
        
        // Test 2: Required Extensions
        $extensions = ['pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json'];
        foreach ($extensions as $ext) {
            if (extension_loaded($ext)) {
                echo '<div class="test-item pass">';
                echo "<strong>✓ Extension $ext:</strong> Loaded";
                echo '</div>';
            } else {
                echo '<div class="test-item fail">';
                echo "<strong>✗ Extension $ext:</strong> NOT loaded";
                echo '</div>';
                $allPassed = false;
            }
        }
        
        // Test 3: Database Connection
        try {
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=mlaravi', 'root', '');
            echo '<div class="test-item pass">';
            echo '<strong>✓ Database Connection:</strong> SUCCESS';
            echo '</div>';
            
            // Count tables
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            echo '<div class="test-item pass">';
            echo '<strong>✓ Database Tables:</strong> ' . count($tables) . ' tables found';
            echo '</div>';
            
            // Check admin user
            $stmt = $pdo->query("SELECT COUNT(*) FROM pwa_admin");
            $adminCount = $stmt->fetchColumn();
            echo '<div class="test-item pass">';
            echo '<strong>✓ Admin Users:</strong> ' . $adminCount . ' admin(s) found';
            echo '</div>';
            
        } catch (PDOException $e) {
            echo '<div class="test-item fail">';
            echo '<strong>✗ Database Connection:</strong> FAILED<br>';
            echo 'Error: ' . $e->getMessage();
            echo '</div>';
            $allPassed = false;
        }
        
        // Test 4: Laravel Files
        $laravelFiles = [
            '../vendor/autoload.php' => 'Composer Autoloader',
            '../bootstrap/app.php' => 'Laravel Bootstrap',
            '../.env' => 'Environment Config',
            'index.php' => 'Public Index'
        ];
        
        foreach ($laravelFiles as $file => $name) {
            if (file_exists($file)) {
                echo '<div class="test-item pass">';
                echo "<strong>✓ $name:</strong> Found";
                echo '</div>';
            } else {
                echo '<div class="test-item fail">';
                echo "<strong>✗ $name:</strong> NOT found";
                echo '</div>';
                $allPassed = false;
            }
        }
        
        // Test 5: Writable Directories
        $writableDirs = [
            '../storage/logs' => 'Storage Logs',
            '../storage/framework/sessions' => 'Sessions',
            '../storage/framework/cache' => 'Cache',
            '../bootstrap/cache' => 'Bootstrap Cache'
        ];
        
        foreach ($writableDirs as $dir => $name) {
            if (is_dir($dir) && is_writable($dir)) {
                echo '<div class="test-item pass">';
                echo "<strong>✓ $name:</strong> Writable";
                echo '</div>';
            } else {
                echo '<div class="test-item fail">';
                echo "<strong>✗ $name:</strong> NOT writable or missing";
                echo '</div>';
                $allPassed = false;
            }
        }
        
        // Final Result
        echo '<hr>';
        if ($allPassed) {
            echo '<h2 class="success">✓ All Tests Passed!</h2>';
            echo '<p>Your VBF installation is working correctly.</p>';
            echo '<p><strong>Next steps:</strong></p>';
            echo '<ul>';
            echo '<li><a href="' . dirname($_SERVER['PHP_SELF']) . '/">Go to Homepage</a></li>';
            echo '<li><a href="' . dirname($_SERVER['PHP_SELF']) . '/admin">Go to Admin Panel</a></li>';
            echo '</ul>';
        } else {
            echo '<h2 class="error">✗ Some Tests Failed</h2>';
            echo '<p>Please fix the issues above before proceeding.</p>';
        }
        
        echo '<hr>';
        echo '<p class="info"><strong>Server Info:</strong></p>';
        echo '<ul>';
        echo '<li>Server Software: ' . $_SERVER['SERVER_SOFTWARE'] . '</li>';
        echo '<li>Document Root: ' . $_SERVER['DOCUMENT_ROOT'] . '</li>';
        echo '<li>Script Path: ' . __FILE__ . '</li>';
        echo '<li>Current URL: ' . $_SERVER['REQUEST_URI'] . '</li>';
        echo '</ul>';
        ?>
    </div>
</body>
</html>

