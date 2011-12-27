<?php

namespace Bdx\TutoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bdx\TutoratBundle\Entity\Lesson
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Lesson
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
     *     pattern="/^[[:alnum:]\s]+$/",
     *     message="Le nom ne peut contenir que des lettres, chiffres et des espaces."
     * )
     */
    private $name;

    /**
     * @var text $information
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;

    /**
     * @ORM\ManyToMany(targetEntity="Tutor", mappedBy="lessons")
     */
    private $tutors;
			   
    /**
     * @ORM\OneToMany(targetEntity="RDV", mappedBy="lesson")
     */
    private $rdvs;

    public function __construct()
    {
        $this->tutors = new ArrayCollection();
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
     * Add tutors
     *
     * @param Bdx\TutoratBundle\Entity\TutorLesson $tutors
     */
    public function addTutorLesson(\Bdx\TutoratBundle\Entity\TutorLesson $tutors)
    {
        $this->tutors[] = $tutors;
    }

    /**
     * Get tutors
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTutors()
    {
        return $this->tutors;
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
     * Add tutors
     *
     * @param Bdx\TutoratBundle\Entity\Tutor $tutors
     */
    public function addTutor(\Bdx\TutoratBundle\Entity\Tutor $tutors)
    {
        $this->tutors[] = $tutors;
    }
}
