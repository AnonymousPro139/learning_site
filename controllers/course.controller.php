<?php
class CourseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Courses();
    }

    // нэвтэрсэн хэрэглэгчийн худалдаж авсан хичээлүүдийг буцаана
    public function index()
    {
        if(!isSuccessLogin()){
            Router::redirect("/course/all");
            return;
        }

        $courses = $this->model->getList(); // ??????

        return (new View([
            'site_title' => Config::get('site'),
            'course' => $courses
        ], 'course' . DS . 'index.html'))->render();
    }

    public function all(){
        $courses = $this->model->getAllCourses();

        return (new View([
            'site_title' => Config::get('site'),
            'course' => $courses
        ], 'course' . DS . 'all.html'))->render();
    }

    public function course_view()
    {
        // dd($_GET);
        $course = $this->model->getCourse($_GET['course_id']);
        $lessons = $this->model->getCourseLessons($_GET['course_id']);

        // $array = $course;
        $course[] = $lessons;

        return (new View([
            'site_title' => Config::get('site'),
            'course' => $course,
        ], 'course' . DS . 'course.html'))->render();
    }
}