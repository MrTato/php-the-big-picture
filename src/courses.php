<?php

class Courses
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_course($name, $author, $create_date)
    {
        $this->db->write_query("insert into courses (name, author, create_date)
                                SELECT '$name', '$author', '$create_date'
                                WHERE NOT EXISTS
                                (SELECT 1 FROM courses WHERE name = '$name')");
    }

    public function show_courses()
    {
        $courses = $this->db->read_query("select * from courses");

        foreach ($courses as $course) {
            print($course['name'] . '<br>');
        }
    }
}
