<?php

namespace AppBundle\Entity;

use AppBundle\Utils\Jobeet;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Job
 *
 * @ORM\Table(name="jobs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JobRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Job
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
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Choice(callback="getTypeValues")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="how_to_apply", type="text")
     * @Assert\NotBlank()
     */
    private $howToApply;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, unique=true)
     */
    private $token;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=true)
     */
    private $isPublic;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_activated", type="boolean", nullable=true)
     */
    private $isActivated;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires_at", type="datetime")
     */
    private $expiresAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="jobs")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @Assert\Image()
     */
    public $file;


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
     * Set type
     *
     * @param string $type
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Job
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Job
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Job
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set howToApply
     *
     * @param string $howToApply
     * @return Job
     */
    public function setHowToApply($howToApply)
    {
        $this->howToApply = $howToApply;

        return $this;
    }

    /**
     * Get howToApply
     *
     * @return string 
     */
    public function getHowToApply()
    {
        return $this->howToApply;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Job
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     * @return Job
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set isActivated
     *
     * @param boolean $isActivated
     * @return Job
     */
    public function setIsActivated($isActivated)
    {
        $this->isActivated = $isActivated;

        return $this;
    }

    /**
     * Get isActivated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->isActivated;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Job
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     * @return Job
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Job
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Job
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt()) {
            $this->createdAt = new \DateTime();
        }
    }

    /**
     * @ORM\PrePersist()
     */
    public function setExpiresAtValue()
    {
        if(!$this->getExpiresAt()) {
            $now = $this->getCreatedAt() ? $this->getCreatedAt()->format('U') : time();
            $this->expiresAt = new \DateTime(date('Y-m-d H:i:s', $now + 86400 * 30));
        }
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getCompanySlug()
    {
        return Jobeet::slugify($this->getCompany());
    }

    public function getPositionSlug()
    {
        return Jobeet::slugify($this->getPosition());
    }

    public function getLocationSlug()
    {
        return Jobeet::slugify($this->getLocation());
    }

    public static function getTypes()
    {
        return array('Full time' => 'full-time', 'Part time' => 'part-time', 'Freelance' => 'freelance');
    }

    public static function getTypeValues()
    {
        return self::getTypes();
    }

    protected function getUploadDir()
    {
        return 'uploads/images/jobs';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->logo ? null : $this->getUploadDir().'/'.$this->logo;
    }

    public function getAbsolutePath()
    {
        return null === $this->logo ? null : $this->getUploadRootDir().'/'.$this->logo;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->logo = uniqid().'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // If there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->logo);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if(file_exists($this->file)) {
            if ($file = $this->getAbsolutePath()) {
                unlink($file);
            }
        }
    }

    /**
     * @ORM\PrePersist()
     */
    public function setTokenValue()
    {
        if(!$this->getToken()) {
            $this->token = sha1($this->getEmail().rand(11111, 99999));
        }
    }

    public function isExpired()
    {
        return $this->getDaysBeforeExpires() < 0;
    }

    public function expiresSoon()
    {
        return $this->getDaysBeforeExpires() < 5;
    }

    public function getDaysBeforeExpires()
    {
        return ceil(($this->getExpiresAt()->format('U') - time()) / 86400);
    }

    public function publish()
    {
        $this->setIsActivated(true);
    }

    public function extend()
    {
        if (!$this->expiresSoon())
        {
            return false;
        }

        $this->expiresAt = new \DateTime(date('Y-m-d H:i:s', time() + 86400 * 30));

        return true;
    }

    public function asArray($host)
    {
        return array(
            'category'     => $this->getCategory()->getName(),
            'type'         => $this->getType(),
            'company'      => $this->getCompany(),
            'logo'         => $this->getLogo() ? 'http://' . $host . '/uploads/images/jobs/' . $this->getLogo() : null,
            'url'          => $this->getUrl(),
            'position'     => $this->getPosition(),
            'location'     => $this->getLocation(),
            'description'  => $this->getDescription(),
            'how_to_apply' => $this->getHowToApply(),
            'expires_at'   => $this->getCreatedAt()->format('Y-m-d H:i:s'),
        );
    }

}
