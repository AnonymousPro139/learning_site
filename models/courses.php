<?php

class Courses extends Model
{
    public function getList()
    {
        // if (Session::get('login') == null || Session::get('role') == null || Session::get('user_id') == null) {
        //     return false;
        // }

        // $id = Session::get('user_id');

        // if (Session::get('role') == 'admin') {
        //     $sql = "SELECT * FROM information order by id DESC";
        // } else {
        //     $sql = "SELECT * FROM information where user_id='$id' order by id DESC";
        // }

        $sql = "SELECT * FROM courses where category='it' order by id DESC";


        return $this->db->query($sql);
    }

    public function getCourse($id)
    {
        $id = (int)$id;

        $sql = "SELECT * FROM courses where id='$id'";

        return $this->db->query($sql);
    }

    public function getCourseLessons($id)
    {
        $id = (int)$id;

        $sql = "SELECT * FROM lessons where course_id='$id'";

        return $this->db->query($sql);
    }
}
