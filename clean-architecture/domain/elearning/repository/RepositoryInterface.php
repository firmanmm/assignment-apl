<?php
namespace Domain\Elearning\Repository;

interface RepositoryInterface {
    function getAll();
    function getById(int $id);
    function save($data);
    function delete(int $id);
}