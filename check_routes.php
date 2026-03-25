<?php
// Check current route configuration

echo "Checking Laravel routes...\n\n";

// Check if we can access artisan
if (file_exists('artisan')) {
    echo "Running: php artisan route:list\n";
    echo str_repeat("=", 60) . "\n";
    
    // Execute artisan route:list
    $output = shell_exec('php artisan route:list --columns=method,uri,name,action 2>&1');
    echo $output;
    
} else {
    echo "❌ artisan file not found. Make sure you're in the Laravel root directory.\n";
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "Looking for homepage route...\n";

// Check routes file directly
if (file_exists('routes/web.php')) {
    $routes = file_get_contents('routes/web.php');
    
    if (strpos($routes, "Route::get('/', ") !== false) {
        echo "✓ Found GET route for homepage\n";
    } elseif (strpos($routes, "Route::any('/', ") !== false) {
        echo "✓ Found ANY route for homepage\n";
    } else {
        echo "❌ No homepage route found!\n";
        echo "Need to add: Route::get('/', 'App\\Http\\Controllers\\Home@index')->name('dashboard');\n";
    }
} else {
    echo "❌ routes/web.php not found\n";
}
?>