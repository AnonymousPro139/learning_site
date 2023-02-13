<?php

class Users extends Model
{
    // Шинэ user нэмэх
    public function add($data)
    {
        if ($data['phone'] == null) {
            return false;
        }

        $email = $this->db->escape(trim($data['email']));
        $phone = $this->db->escape(trim($data['phone']));
        $password = md5(Config::get("salt") . trim($data['password']));

        $created_date = date('Y-m-d H:i:s');

        $sql = "insert into users set
                    email='$email',
                    phone='$phone',
                    password='$password',
                    created_date='$created_date'";

        return $this->db->query($sql);
    }

    public function getList()
    {
        $sql = "SELECT * FROM users";

        return $this->db->query($sql);
    }

    public function delete($id)
    {
        $id = (int) $id;
        $sql = "delete from users where id=$id";
        return $this->db->query($sql);
    }

    public function getById($id)
    {
        $id = (int) $id;
        $sql = "select * from users where id=$id limit 1";
        return $this->db->query($sql) ?? null;
    }

    public function saveUser($data, $id)
    {
        $id = (int) $id;

        if (!isset($data['name']) || !isset($data['role'])) {
            return false;
        }

        $name = $this->db->escape(trim($data['name']));
        $phone = $this->db->escape(trim($data['phone']));
        $role = $data['role'];
        $password = md5(Config::get("salt") . trim($data['password']));

        $sql = "update users set
                    name='$name',
                    phone='$phone',
                    role='$role',
                    password='$password'
                    where id = $id";


        return $this->db->query($sql);
    }

    public function getByLogin($value)
    {
        $value = $this->db->escape($value);
        $sql = "select * from users where phone='$value' limit 1";
        return $this->db->query($sql);
    }
}