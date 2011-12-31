<?php

namespace Bdx\TutoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\NotNull(groups={"Default", "step2"})
     * @Assert\Type(type="DateTime", groups={"Default", "step2"})
     */
    private $start;

    /**
     * @var integer $duration
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     *
     * @Assert\NotNull(groups={"Default", "step2"})
     * @Assert\Type(type="integer", groups={"Default", "step2"})
     */
    private $duration;

    /**
     * @var string $state
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\MaxLength(255)
     * @Assert\Choice(choices = {
     *         "Nouveau",
     *         "Confirmé",
     *         "Annulé",
     *         "Tuteur absent",
     *         "Etudiant absent"
     *         }, message = "Wrong state")
     */
    private $state;

    /**
     * @var text $information
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     *
     * @Assert\Type(type="string", groups={"Default", "step4"})
     */
    private $information;

    /**
     * @var integer $tutor
     *
	 * @ORM\ManyToOne(targetEntity="Tutor", inversedBy="rdvs")
     *
     * @Assert\NotNull()
     */
	private $tutor;

    /**
     * @var integer $student
     *
	 * @ORM\ManyToOne(targetEntity="Student", inversedBy="rdvs")
     *
     * @Assert\NotNull()
     */
	private $student;

    /**
     * @var integer $lesson
     *
	 * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="rdvs")
     *
     * @Assert\NotNull()
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

	public function getDescription()
	{
		return 'Tuteur: '.$this->getTutor()->getName()."\n"
			.'Matière: '.$this->getLesson()->getName()."\n"
			.'Etudiant: '.$this->getStudent()->getName()."\n"
			.'Email: '.$this->getStudent()->getEmail()."\n"
			.'Tel: '.$this->getStudent()->getTel()."\n"
			."\n"
			.$this->getInformation()."\n"
			."\n"
			.$this->getStudent()->getInformation();
	}
}
