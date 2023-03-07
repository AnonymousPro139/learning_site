<?php

class Courses extends Model
{
    public function getAllCourses()
    {
        $sql = "SELECT * FROM courses order by id DESC";

        return $this->db->query($sql);
    }

    public function getMyCourses($user_id)
    {
        $user_id =  (int)$user_id; // user_id-g holboh ???
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