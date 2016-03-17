<?php

namespace AppBundle\Entity;

use AppBundle\Utils\Jobeet;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Affiliate", mappedBy="categories")
     */
    private $affiliates;

    private $activeJobs;

    private $more_jobs;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;


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
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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

    public function setJobs($jobs)
    {
        $this->jobs = $jobs;

        return $this;
    }

    public function getJobs()
    {
        return $this->jobs;
    }

    public function setAffiliates($affiliates)
    {
        $this->affiliates = $affiliates;

        return $this;
    }

    public function getAffiliates()
    {
        return $this->affiliates;
    }

    public function setActiveJobs($jobs)
    {
        $this->activeJobs = $jobs;
    }

    public function getActiveJobs()
    {
        return $this->activeJobs;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setSlugValue()
    {
        $this->slug = Jobeet::slugify($this->getName());
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function setMoreJobs($jobs)
    {
        $this->more_jobs = $jobs >= 0 ? $jobs : 0;
    }

    public function getMoreJobs()
    {
        return $this->more_jobs;
    }

    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }
}
