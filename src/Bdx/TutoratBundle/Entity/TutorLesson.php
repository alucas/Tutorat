<?php

namespace Bdx\TutoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bdx\TutoratBundle\Entity\TutorLesson
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TutorLesson
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $tutor
     *
	 * @ORM\ManyToOne(targetEntity="Tutor", inversedBy="tutors")
     */
	private $tutor;

    /**
     * @var integer $lesson
     *
	 * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="lessons")
     */
	private $lesson;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tutor
     *
     * @param Bdx\TutoratBundle\Entity\Tutor $tutor
     */
    public function setTutor(\Bdx\TutoratBundle\Entity\Tutor $tutor)
    {
        $this->tutor = $tutor;
    }

    /**
     * Get tutor
     *
     * @return Bdx\TutoratBundle\Entity\Tutor 
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * Set lesson
     *
     * @param Bdx\TutoratBundle\Entity\Lesson $lesson
     */
    public function setLesson(\Bdx\TutoratBundle\Entity\Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Get lesson
     *
     * @return Bdx\TutoratBundle\Entity\Lesson 
     */
    public function getLesson()
    {
        return $this->lesson;
    }
}