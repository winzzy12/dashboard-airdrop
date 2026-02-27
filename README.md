# dashboard-airdrop
web dashboard for airdrop crypto


1. Install PHP
   ```bash
   sudo apt update
   sudo apt install php -y
   ```
   ```bash
   php -v
   ```
   ```bash
   cd /var/www/html
   ```
   
   ```bash
   git clone https://github.com/winzzy12/dashboard-airdrop.git
   ```


2. Install MySQL
   ```bash
   sudo apt update && sudo apt upgrade -y
   sudo apt install mysql-server -y
   ```
   ```
   sudo systemctl start mysql
   sudo systemctl enable mysql
   ```
   ```
   sudo mysql_secure_installation
   ```

   
4. Config Database
   ```
   sudo mysql -u root -p
   ```
   ```
   CREATE DATABASE database_db;
   ```
   ```
   CREATE USER 'database_db'@'localhost' IDENTIFIED BY 'Password123';
   ```
   ```
   GRANT ALL PRIVILEGES ON database_db.* TO 'database_db'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```
   ```
   mysql -u database_db -p
   ```
   ```
   Password123
   ```
   ```
   SHOW DATABASES;
   ```
   ```
   USE database_db;
   ```
   ```
   SHOW TABLES;
   ```

   
   
