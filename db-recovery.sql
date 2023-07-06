-- employeesテーブルの復旧
CREATE TABLE employees (
  employee_id VARCHAR(255) PRIMARY KEY,
  employee_name VARCHAR(255),
  phone_number VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255)
);


-- 初期ユーザーの追加
INSERT INTO employees (employee_id, employee_name, phone_number, email, password) 
VALUES ('root', 'root-user', '000-000-000', 'root@example.com', 'password');

-- 注文テーブルの復旧
CREATE TABLE orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(255) UNIQUE,
  create_date DATE,
  update_date DATE,
  remarks VARCHAR(255),
  table_data LONGTEXT,
  employee_id VARCHAR(255),
  total_amount DECIMAL(10, 2),
  FOREIGN KEY (employee_id) REFERENCES employees (employee_id)
);
