<?php

namespace App\Elearning\Repository;

use Domain\Elearning\Repository\CourseRepositoryInterface;
use Domain\Elearning\Entity\CourseEntity;
use Phalcon\Db\Column;

class CourseRepository extends Repository implements CourseRepositoryInterface {

    public function getAll() : array {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses");
        $result = $conn->executePrepared($stmt,[],[]);
        $rawCourses = $result->fetchAll();
        $courses = [];
        foreach($rawCourses as $rawCourse) {
            $courses[] = $this->makeCourse($rawCourse);
        } 
        return $courses;
    }

    private function makeCourse($raw) : CourseEntity {
        $tempCourse = new CourseEntity();
        $this->populateAbstract($tempCourse, $raw);
        $tempCourse->setCapacity(($raw['capacity']));        
        $tempCourse->setCourseId($raw['course_id']);
        $tempCourse->setName($raw['name']);
        $tempCourse->setDescription($raw['description']);
        return $tempCourse;
    }

    public function getById(int $id) : ?CourseEntity {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses WHERE id = :id LIMIT 1");
        $result = $conn->executePrepared($stmt,[
            'id' => $id,
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $rawCourses = $result->fetchAll();
        return (isset($rawCourses[0])) ? $this->makeCourse($rawCourses[0]) : null;
    }

    public function update(CourseEntity $data) : CourseEntity {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE courses SET name=:name, description=:description, course_id=:courseId, capacity=:capacity WHERE id=:id LIMIT 1");
        $result = $conn->executePrepared($stmt,[
            'name' => $data->getName(),
            'description' => $data->getDescription(),
            'courseId' => $data->getCourseId(),
            'capacity' => $data->getCapacity(),
            'id' => $data->getId(),
        ],[
            'name' => Column::BIND_PARAM_STR,
            'description' => Column::BIND_PARAM_STR,
            'courseId' => Column::BIND_PARAM_STR,
            'capacity' => Column::BIND_PARAM_INT,
            'id' => Column::BIND_PARAM_INT
        ]);
        return $data;
    }

    public function insert(CourseEntity $data) : CourseEntity {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT INTO courses(`name`, `description`, `course_id`, `capacity`) VALUES (:name, :description, :courseId, :capacity)");
        $result = $conn->executePrepared($stmt,[
            'name' => $data->getName(),
            'description' => $data->getDescription(),
            'courseId' => $data->getCourseId(),
            'capacity' => $data->getCapacity(),
        ],[
            'name' => Column::BIND_PARAM_STR,
            'description' => Column::BIND_PARAM_STR,
            'courseId' => Column::BIND_PARAM_STR,
            'capacity' => Column::BIND_PARAM_INT
        ]);
        $id = $conn->lastInsertId();
        $data->setId($id);
        return $data;
    }

    public function delete(int $id) : void {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE `courses` SET deleted_at = NOW() WHERE id = :id AND deleted_at IS NULL");
        $result = $conn->executePrepared($stmt,[
            'id' => $id
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
    }

    public function getByCourseId(String $courseId) : ?CourseEntity {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses WHERE course_id = :courseId ");
        $result = $conn->executePrepared($stmt,[
            'courseId' => $courseId,
        ],[
            'courseId' => Column::BIND_PARAM_STR
        ]);
        $rawCourses = $result->fetchAll();
        $rawCourse = (isset($rawCourses[0])) ? $rawCourses[0] : null;
        if ($rawCourse != null){
            return $this->makeUser($rawCourse);
        } 
        return null;
    }

}