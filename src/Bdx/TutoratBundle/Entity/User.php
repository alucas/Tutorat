<?php

namespace Bdx\TutoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Bdx\TutoratBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $state
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var text $information
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;

    /**
	 * @ORM\OneToOne(targetEntity="Tutor")
     */
	private $tutor;

    /**
	 * @ORM\OneToOne(targetEntity="Student")
     */
	private $student;


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
}
