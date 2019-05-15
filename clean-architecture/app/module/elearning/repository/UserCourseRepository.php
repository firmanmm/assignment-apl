<?php

namespace App\Elearning\Repository;

use Domain\Elearning\Repository\UserCourseRepositoryInterface;
use Domain\Elearning\Entity\CourseEntity;
use Phalcon\Db\Column;

class UserCourseRepository extends Repository implements UserCourseRepositoryInterface {

    public function saveByCourse(CourseEntity $course)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT IGNORE INTO user_course(`course_id`,`user_id`) VALUES (:courseId,:userId)");
        $userIds = $course->getAllUser();
        foreach($userIds as $id) {
            $conn->executePrepared($stmt, [
                'courseId' => $course->getId(),
                'userId' => $id
            ],[
                'courseId' => Column::BIND_PARAM_INT,
                'userId' => Column::BIND_PARAM_INT
            ]);
        }
    }

    public function getCoursesByUserId(int $userId)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM user_course WHERE user_id = :id");
        $result = $conn->executePrepared($stmt, [
            'id' => $userId
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $res = $result->fetchAll();
        $ids = [];
        foreach($res as $key => $val){
            $ids[] = $val['course_id'];
        }
        return $ids;
    }

    public function getUsersByCourseId(int $courseId)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM user_course WHERE course_id = :id");
        $result = $conn->executePrepared($stmt, [
            'id' => $courseId
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $ids = [];
        $res = $result->fetchAll();
        foreach($res as $key => $val){
            $ids[] = $val['user_id'];
        }
        return $ids;
    }
}