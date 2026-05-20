<?php
chdir('..');
shell_exec('git config user.email "antigravity@gemini.com"');
shell_exec('git config user.name "Antigravity"');
echo "Git Add files:\n";
echo shell_exec('git add database/seeders/DatabaseSeeder.php 2>&1');
echo shell_exec('git add routes/web.php 2>&1');
echo shell_exec('git add public/js/cart-manager.js 2>&1');
echo shell_exec('git add . 2>&1');
echo "\nGit Status:\n";
echo shell_exec('git status 2>&1');
echo "\nGit Commit:\n";
echo shell_exec('git commit -m "Resolve merge conflicts and integrate profile" 2>&1');
echo "\nGit Pull:\n";
echo shell_exec('git pull origin main 2>&1');
?>
