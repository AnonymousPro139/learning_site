<?php
class Db
{
    protected $connection; // charset
    protected $error;

    public function __construct($host, $db, $user, $password)
    {
        $this->connection = new mysqli($host, $user, $password, $db);

        if (mysqli_connect_error()) {
            $this->error = mysqli_connect_error();
            die("Mysql сэрвэртэй холбогдох үед алдаа гарлаа: " . $this->error . " ( Алдааны дугаар: #" . mysqli_connect_errno() . " )");
        }

        // sql to create users table
        $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(25) DEFAULT 'noname',
        email VARCHAR(45) DEFAULT 'noemail',
        phone VARCHAR(16) NOT NULL,
        password VARCHAR(32),
        created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        role VARCHAR(5) DEFAULT 'user'
        )";

        if ($this->connection->query($sql) !== TRUE) {
            echo "Error creating user table: " . $this->connection->error;
            exit;
        }

        // sql to create courses table
        $sql = "CREATE TABLE IF NOT EXISTS courses (
        id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(40) NOT NULL,
        teacher_id INT(8),
        name TINYTEXT NOT NULL,
        note TEXT,
        count_buy int(8),
        count_view int(8),
        img VARCHAR(120),
        price VARCHAR(8),
        last_lesson INT(8) DEFAULT 1,
        created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

        if ($this->connection->query($sql) !== TRUE) {
            echo "Error creating courses table: " . $this->connection->error;
            exit;
        }

        // sql to create lessons table
        $sql = "CREATE TABLE IF NOT EXISTS lessons (
        id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        course_id INT(8),
        lesson_id INT(8),
        name TINYTEXT NOT NULL,
        path_lesson VARCHAR(120),
        note TEXT,
        is_free BOOLEAN DEFAULT FALSE,
        count_view int(8),
        seconds int(8),
        created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

        if ($this->connection->query($sql) !== TRUE) {
            echo "Error creating lessons table: " . $this->connection->error;
            exit;
        }

        // sql to create comments table
        $sql = "CREATE TABLE IF NOT EXISTS comments (
            id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            lesson_id INT(8),
            user_id INT(8),
            comment TEXT,
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        if ($this->connection->query($sql) !== TRUE) {
            echo "Error creating comments table: " . $this->connection->error;
            exit;
        }

         // sql to create purchase table Худалдаж авсан хичээлүүдийн бүртгэл
         $sql = "CREATE TABLE IF NOT EXISTS purchase (
            id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            course_id INT(8),
            user_id INT(8),
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        if ($this->connection->query($sql) !== TRUE) {
            echo "Error creating purchase table: " . $this->connection->error;
            exit;
        }
    }

    public function query($sql)
    {
        // Холбогдсон эсэхийг шалгах
        if (!$this->connection) {
            return false;
        }

        // SQL Командыг ажиллуулах
        $result = $this->connection->query($sql);

        if (mysqli_error($this->connection)) {
            $this->error = mysqli_error($this->connection);
            die("SQL командыг ажиллуулж чадсангүй: " . mysqli_error($this->connection));
        }

        if (is_bool($result)) {
            return $result;
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function escape($value)
    {
        $value = trim($value);
        $value = addslashes($value);

        return mysqli_real_escape_string($this->connection, $value);
    }
}