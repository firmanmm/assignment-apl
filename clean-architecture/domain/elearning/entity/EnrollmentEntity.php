<?php

namespace Domain\Elearning\Entity;

class EnrollmentEntity extends AbstractEntity {
    /**
     * Stores user Entity
     *
     * @var UserEntity
     */
    private $user;
    /**
     * Stores course
     *
     * @var CourseEntity
     */
    private $course;

	/**
	 * Get stores course
	 *
	 * @return  CourseEntity
	 */
	public function getCourse() : CourseEntity
	{
		return $this->course;
	}

	/**
	 * Set stores course
	 *
	 * @param   CourseEntity  $course  Stores course
	 *
	 * @return  void
	 */
	public function setCourse(CourseEntity $course) : void
	{
		$this->course = $course;
	}

	/**
	 * Get stores user Entity
	 *
	 * @return  UserEntity
	 */
	public function getUser() : UserEntity
	{
		return $this->user;
	}

	/**
	 * Set stores user Entity
	 *
	 * @param   UserEntity  $user  Stores user Entity
	 *
	 * @return  void
	 */
	public function setUser(UserEntity $user) : void
	{
		$this->user = $user;
	}
}