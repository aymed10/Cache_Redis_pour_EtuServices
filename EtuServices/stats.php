<?php
$output = shell_exec("python3 ../redis_cli/get_stats.py");
$lines = explode("\n", trim($output));

echo "<h2>Top utilisateurs (connexions réussies)</h2>";
echo "<ul>";
foreach ($lines as $line) {
    if (!empty($line)) {
        list($email, $count) = explode(":", $line);
        echo "<li><strong>$email</strong> — $count connexions</li>";
    }
}
echo "</ul>";
?>
