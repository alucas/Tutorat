<?php

namespace Bdx\TutoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bdx\TutoratBundle\Entity\RDV
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RDV
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
     * @var datetime $start
     *
     * @ORM\Column(name="start", type="datetime", nullable=false)
     */
    private $start;

    /**
     * @var integer $duration
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var integer $state
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @var text $information
     *
     * @ORM\Column(name="information", type="text", nullable=false)
     */
    private $information;

    /**
     * @var integer $tutor
     *
	 * @ORM\ManyToOne(targetEntity="Tutor", inversedBy="rdvs")
     */
	private $tutor;

    /**
     * @var integer $student
     *
	 * @ORM\ManyToOne(targetEntity="Student", inversedBy="rdvs")
     */
	private $student;

    /**
     * @var integer $lesson
     *
	 * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="rdvs")
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
     * Set start
     *
     * @param datetime $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * Get start
     *
     * @return datetime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set state
     *
     * @param integer $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set information
     *
     * @param text $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * Get information
     *
     * @return text 
     */
    public function getInformation()
    {
        return $this->information;
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
     * Set student
     *
     * @param Bdx\TutoratBundle\Entity\Student $student
     */
    public function setStudent(\Bdx\TutoratBundle\Entity\Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get student
     *
     * @return Bdx\TutoratBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
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