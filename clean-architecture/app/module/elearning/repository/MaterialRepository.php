<?php
namespace App\Elearning\Repository;

use Domain\Elearning\Repository\MaterialRepositoryInterface;
use Domain\Elearning\Entity\MaterialEntity;
use Phalcon\Db\Column;
use Domain\Elearning\Entity\CourseEntity;

class MaterialRepository extends Repository implements MaterialRepositoryInterface {

    public function getAll(): array{
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM materials");
        $result = $conn->executePrepared($stmt,[],[]);
        $rawDatas = $result->fetchAll();
        $datas = [];
        foreach($rawDatas as $rawData) {
            $datas[] = $this->makeMaterial($rawData);
        } 
        return $datas;
    }
    
    private function makeMaterial($rawData): MaterialEntity {
        $material = new MaterialEntity();
        $this->populateAbstract($material, $rawData);
        $material->setTitle($rawData['title']);
        $material->setCourse(new CourseEntity($rawData['course_id']));
        $material->setDescription($rawData['description']);
        return $material;
    }
    
    public function getById(int $id): ?MaterialEntity {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM materials WHERE id = :id");
        $result = $conn->executePrepared($stmt,[
            'id' => $id
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $rawDatas = $result->fetchAll();
        return (isset($rawDatas[0])) ? $this->makeMaterial($rawDatas[0]) : null;
    }

    public function insert(MaterialEntity $data): MaterialEntity
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT INTO materials(`title`,`course_id`,`description`) VALUES(:title, :courseId, :description)");
        $result = $conn->executePrepared($stmt, [
            'title' => $data->getTitle(),
            'courseId' => $data->getCourse()->getId(),
            'description' => $data->getDescription()
        ], [
            'title' => Column::BIND_PARAM_STR,
            'courseId' => Column::BIND_PARAM_INT,
            'description' => Column::BIND_PARAM_STR
        ]);
        $data->setId($conn->lastInsertId());
        return $data;
    }

    public function update(MaterialEntity $data): MaterialEntity
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE materials SET materials `title`=:title, `course_id`=:courseId, `description`=:description) WHERE id=:id LIMIT 1");
        $result = $conn->executePrepared($stmt, [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'courseId' => $data->getCourseId(),
            'description' => $data->getDescription()
        ], [
            'id' => Column::BIND_PARAM_INT,
            'title' => Column::BIND_PARAM_STR,
            'courseId' => Column::BIND_PARAM_INT,
            'description' => Column::BIND_PARAM_STR
        ]);
        return $data;
    }

    public function delete(int $id){
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE `materials` SET deleted_at = NOW() WHERE id = :id AND deleted_at IS NULL");
        $result = $conn->executePrepared($stmt,[
            'id' => $id
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        return $result;
    }

    public function getByCourseId($id) : array
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM materials WHERE course_id = :id");
        $result = $conn->executePrepared($stmt,[
            'id' => $id
        ],[
            'id' => Column::BIND_PARAM_INT
        ]);
        $rawDatas = $result->fetchAll();
        $datas = [];
        foreach($rawDatas as $rawData) {
            $datas[] = $this->makeMaterial($rawData);
        } 
        return $datas;
    }
}