<?php

namespace Bdx\TutoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bdx\TutoratBundle\Entity\Tutor
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tutor
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true, nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\MaxLength(100)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="The name cannot contain a number."
     * )
     * @Assert\Regex(
     *     pattern="/^[[:alpha:]\-\séèêç]+$/",
     *     message="Le nom ne peut contenir que des lettres minuscules, majuscules, des tirets et des espaces."
     * )
     */
    private $name;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\MaxLength(255)
     * @Assert\Email(checkMX = true)
     */
    private $email;

    /**
     * @var text $information
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;

    /**
     * @ORM\ManyToMany(targetEntity="Lesson", inversedBy="tutors")
     */
    private $lessons;
			   
    /**
     * @ORM\OneToMany(targetEntity="RDV", mappedBy="tutor")
     */
    private $rdvs;
			   
    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
        $this->rdvs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }


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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
     * Get lessons
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * Add rdvs
     *
     * @param Bdx\TutoratBundle\Entity\RDV $rdvs
     */
    public function addRDV(\Bdx\TutoratBundle\Entity\RDV $rdvs)
    {
        $this->rdvs[] = $rdvs;
    }

    /**
     * Get rdvs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }

    /**
     * Set user
     *
     * @param Bdx\TutoratBundle\Entity\User $user
     */
    public function setUser(\Bdx\TutoratBundle\Entity\User $user = null)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Bdx\TutoratBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add lessons
     *
     * @param Bdx\TutoratBundle\Entity\Lesson $lessons
     */
    public function addLesson(\Bdx\TutoratBundle\Entity\Lesson $lessons)
    {
        $this->lessons[] = $lessons;
    }
}
