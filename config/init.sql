-- =============================================
-- SecureCorp Intranet — Database Initialization
-- =============================================

USE sqli_lab;

-- -----------------------------------------
-- Table: users
-- VARCHAR(20) is critical for Lab 1 (Truncation Attack)
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255),
    role VARCHAR(50) DEFAULT 'employee'
);

INSERT INTO users (username, password, role) VALUES
('admin', 'Sup3rS3cretP@ss', 'administrator'),
('jsmith', 'Spring2024!', 'employee'),
('klee', 'Welcome1', 'hr_manager');

-- -----------------------------------------
-- Table: products
-- Used by Lab 2 (Error-Based) and Lab 4 (RCE)
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    price DECIMAL(10,2)
);

INSERT INTO products (name, description, price) VALUES
('ThinkPad X1 Carbon',       'Executive ultrabook, 14-inch display, 16GB RAM',         1849.99),
('Ergonomic Office Chair',    'Mesh back, adjustable lumbar, 5-year warranty',           549.00),
('Cisco Catalyst 9200 Switch','48-port managed network switch for floor deployment',    3200.00),
('HP ProLiant DL380 Gen9',   'Dual Xeon rack server, 64GB ECC, redundant PSU',         5499.00),
('Dell UltraSharp U2723QE',  '27-inch 4K IPS monitor, USB-C hub, factory calibrated',   619.99),
('Logitech MX Keys',         'Wireless illuminated keyboard, multi-device support',      99.99),
('APC Smart-UPS 1500VA',     'Rack-mount UPS, LCD display, network management card',    689.00),
('Polycom VVX 450',          '12-line IP desk phone, color display, Bluetooth',          249.00),
('Samsung 870 EVO 1TB',      'SATA III SSD, 560MB/s read, 5-year warranty',             109.99),
('Ubiquiti UniFi AP AC Pro', 'Dual-band enterprise access point, PoE powered',          149.00);

-- -----------------------------------------
-- Table: invite_codes
-- Used by Lab 3 (Blind Boolean-Based)
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS invite_codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100) NOT NULL,
    is_active TINYINT(1) DEFAULT 1
);

INSERT INTO invite_codes (code, is_active) VALUES
('LEGIT-CODE-2024', 1);

-- -----------------------------------------
-- Table: secret_vault
-- Hidden table — must be discovered via information_schema enumeration
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS secret_vault (
    id INT AUTO_INCREMENT PRIMARY KEY,
    secret_name VARCHAR(100) NOT NULL,
    pin_code VARCHAR(10) NOT NULL
);

INSERT INTO secret_vault (secret_name, pin_code) VALUES
('GrandPrize', '7492');

-- -----------------------------------------
-- Table: library_books
-- Used by SQLMap Training Labs (GET & POST)
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS library_books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(100) NOT NULL,
    published_year INT
);

INSERT INTO library_books (title, author, published_year) VALUES
('Hacking 101', 'Jon Erickson', 2008),
('SQL for Dummies', 'Allen G. Taylor', 2019),
('The Art of Deception', 'Kevin Mitnick', 2002);

-- -----------------------------------------
-- Table: ctf_flags
-- Hidden flag table — discover via SQLMap enumeration
-- -----------------------------------------
CREATE TABLE IF NOT EXISTS ctf_flags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flag_name VARCHAR(100) NOT NULL,
    flag_value VARCHAR(255) NOT NULL
);

INSERT INTO ctf_flags (flag_name, flag_value) VALUES
('FinalFlag', 'FLAG{SQLMAP_MASTER_2026}');

-- -----------------------------------------
-- Application user with FILE privilege for Lab 4 (RCE via INTO OUTFILE)
-- -----------------------------------------
CREATE USER IF NOT EXISTS 'app_user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON sqli_lab.* TO 'app_user'@'%';
GRANT FILE ON *.* TO 'app_user'@'%';
FLUSH PRIVILEGES;
