@echo off
:: Start Apache and MySQL hidden/minimized
start /b "" "C:\xampp\apache_start.bat"
start /b "" "C:\xampp\mysql_start.bat"

:: Wait 3 seconds to give MySQL time to wake up
timeout /t 3 /nobreak > NUL

:: Open your specific project in the default browser
start "" "http://localhost/DostScholar/scholar"

exit