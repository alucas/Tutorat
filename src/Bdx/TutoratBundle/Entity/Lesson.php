<?php

namespace Bdx\TutoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     */
    private $name;

    /**
     * @var text $information
     *
     * @ORM\Column(name="information", type="text")
     */
    private $information;

    /**
     * @ORM\OneToMany(targetEntity="TutorLesson", mappedBy="lesson")
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
}