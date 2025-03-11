<?php
echo "<h1>PHP Server Test</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Current Directory: " . getcwd() . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";

// Check if Symfony is properly installed
$vendorAutoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($vendorAutoloadPath)) {
    echo "<p style='color:green'>Vendor autoload file exists ✓</p>";
} else {
    echo "<p style='color:red'>Vendor autoload file does not exist ✗</p>";
    echo "<p>Expected path: " . $vendorAutoloadPath . "</p>";
}

// Check if .env file exists
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    echo "<p style='color:green'>.env file exists ✓</p>";
} else {
    echo "<p style='color:red'>.env file does not exist ✗</p>";
}

// Check if .env.local file exists
$envLocalPath = __DIR__ . '/../.env.local';
if (file_exists($envLocalPath)) {
    echo "<p style='color:green'>.env.local file exists ✓</p>";
    echo "<p>Content (first 100 chars): " . htmlspecialchars(substr(file_get_contents($envLocalPath), 0, 100)) . "</p>";
} else {
    echo "<p style='color:orange'>.env.local file does not exist (this is optional)</p>";
}

// Full phpinfo for detailed diagnostics
phpinfo();