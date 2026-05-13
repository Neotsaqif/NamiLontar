@echo off
echo Initializing Laravel project...
echo Cleaning up corrupted vendor directory...
if exist vendor rd /s /q vendor
if exist composer.lock del /q composer.lock
echo Increasing Composer timeout...
composer config --global process-timeout 2000
echo Installing dependencies (this may take a few minutes)...
composer install
if %ERRORLEVEL% NEQ 0 (
    echo Composer install failed.
    pause
    exit /b %ERRORLEVEL%
)
echo Generating key...
php artisan key:generate
echo Running migrations...
php artisan migrate
echo Initialization complete!
pause
