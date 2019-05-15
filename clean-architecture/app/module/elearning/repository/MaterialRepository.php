<?php
namespace App\Elearning\Repository;

use Domain\Elearning\Repository\MaterialRepositoryInterface;
use Domain\Elearning\Entity\MaterialEntity;
use Phalcon\Db\Column;

class MaterialRepository extends Repository implements MaterialRepositoryInterface {

    public function getAll(){
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
    
    private function makeMaterial($rawData) {
        $material = new MaterialEntity($rawData['id']);
        $material->setTitle($rawData['title']);
        $material->setCourseId($rawData['course_id']);
        $material->setDescription($rawData['description']);
        $material->setCreatedAt($rawData['created_at']);
        $material->setDeletedAt($rawData['deleted_at']);
        return $material;
    }
    
    public function getById(int $id) {
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

    /**
     * Save current data, may update or insert based on id
     *
     * @param MaterialEntity $data
     * @return MaterialEntity
     */
    public function save($data){
        $conn = $this->getConnection();
        $stmt = $conn->prepare("INSERT INTO materials(`title`,`course_id`,`description`) VALUES(:title, :courseId, :description)");
        $result = $conn->executePrepared($stmt, [
            'title' => $data->getTitle(),
            'courseId' => $data->getCourseId(),
            'description' => $data->getDescription()
        ], [
            'title' => Column::BIND_PARAM_STR,
            'courseId' => Column::BIND_PARAM_INT,
            'description' => Column::BIND_PARAM_STR
        ]);
        $data->setId($conn->lastInsertId());
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

    public function getByCourseId($id)
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