<?php

namespace App\Elearning\Repository;

use Domain\Elearning\Entity\CourseEntity;
use Phalcon\Db\Column;
use Domain\Elearning\Repository\EnrollmentRepositoryInterface;
use Domain\Elearning\Entity\EnrollmentEntity;
use Domain\Elearning\Entity\UserEntity;

class EnrollmentRepository extends Repository implements EnrollmentRepositoryInterface {
    
    public function getById(int $id): ?EnrollmentEntity
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM enrollments WHERE id = :id LIMIT 1");
        $result = $conn->executePrepared($stmt,[
            'id' => $id,
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $rawCourses = $result->fetchAll();
        $rawCourse = (isset($rawCourses[0])) ? $rawCourses[0] : null;
        if ($rawCourse != null){
            return $this->makeCourse($rawCourse);
        } 
        return null;
    }

    public function getAll() : array
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM enrollments");
        $results = $conn->executePrepared($stmt, [], []);
        $results = $results->fetchAll();
        $enrollments = [];
        foreach($results as $result) {
            $enrollments[] = $this->makeEnrollment($result);
        }
        return $enrollments;
    }

    private function makeEnrollment($raw) : EnrollmentEntity {
        $enrollment = new EnrollmentEntity();
        $this->populateAbstract($enrollment, $raw);
        $enrollment->setCourse(new CourseEntity($raw["course_id"]));
        $enrollment->setUser(new UserEntity($raw["user_id"]));
        return $enrollment;
    }

    public function insert(EnrollmentEntity $data): EnrollmentEntity
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT IGNORE INTO enrollments(`course_id`,`user_id`) VALUES (:courseId,:userId)");
        $conn->executePrepared($stmt, [
            'courseId' => $data->getCourse()->getId(),
            'userId' => $data->getUser()->getId()
        ],[
            'courseId' => Column::BIND_PARAM_INT,
            'userId' => Column::BIND_PARAM_INT
        ]);
        $data->setId($conn->lastInsertId());
        return $data;
    }

    public function delete(int $id) : void
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = :id AND deleted_at IS NULL");
        $result = $conn->executePrepared($stmt,[
            'id' => $id
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
    }

    public function getEnrollmentsByUserId(int $userId): array
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM enrollments WHERE user_id = :id");
        $results = $conn->executePrepared($stmt, [
            'id' => $userId
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $results = $results->fetchAll();
        $enrollments = [];
        foreach($results as $result){
            $enrollments[] = $this->makeEnrollment($result);
        }
        return $enrollments;
    }

    public function getEnrollmentsByCourseId(int $courseId): array
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM enrollments WHERE course_id = :id");
        $results = $conn->executePrepared($stmt, [
            'id' => $courseId
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $results = $results->fetchAll();
        $enrollments = [];
        foreach($results as $result){
            $enrollments[] = $this->makeEnrollment($result);
        }
        return $enrollments;   
    }
}