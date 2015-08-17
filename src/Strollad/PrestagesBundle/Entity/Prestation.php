<?php

namespace Strollad\PrestagesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Prestation
 *
 * @ORM\Table(name="prestation")
 * @ORM\Entity(repositoryClass="Strollad\PrestagesBundle\Entity\PrestationRepository")
 */
class Prestation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\Date()
     *
     * @ORM\Column(name="date_prestation", type="date", nullable=false)
     */
    private $datePrestation;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="place", type="string")
     */
    private $place;

    private $nameContact;
    private $telContact;
    private $emailContact;

    /**
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     * @ORM\Column(name="priceKendalch", type="float", nullable=false)
     */
    private $priceKendalch = 0.0;

    /**
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     * @ORM\Column(name="priceTransport", type="float", nullable=false)
     */
    private $priceTransport = 0.0;

    /**
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     * @ORM\Column(name="priceAnimation", type="float", nullable=false)
     */
    private $priceAnimation = 0.0;

    /**
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     * @ORM\Column(name="priceDivers", type="float", nullable=false)
     */
    private $priceDivers = 0.0;

    /**
     * @ORM\OneToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     **/
    private $client;

    //private $repas; // Aucun, Midi, Soir, Midi + Soir
    // on efface autreformation et on étend Nb musiciens

    //private $archive;
    //private

    /**
     * Construct
     */
    public function __construct()
    {
        $this->datePrestation  = new \DateTime();
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
     * @return Prestation
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

    /**
     * Set price
     *
     * @param float $price
     * @return Prestation
     */
    public function setPriceKendalch($price)
    {
        $this->priceKendalch = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPriceKendalch()
    {
        return $this->priceKendalch;
    }

    /**
     * Set priceTransport
     *
     * @param float $priceTransport
     * @return Prestation
     */
    public function setPriceTransport($priceTransport)
    {
        $this->priceTransport = $priceTransport;

        return $this;
    }

    /**
     * Get priceTransport
     *
     * @return float 
     */
    public function getPriceTransport()
    {
        return $this->priceTransport;
    }

    /**
     * Set priceAnimation
     *
     * @param float $priceAnimation
     * @return Prestation
     */
    public function setPriceAnimation($priceAnimation)
    {
        $this->priceAnimation = $priceAnimation;

        return $this;
    }

    /**
     * Get priceAnimation
     *
     * @return float 
     */
    public function getPriceAnimation()
    {
        return $this->priceAnimation;
    }

    /**
     * Set priceDivers
     *
     * @param float $priceDivers
     * @return Prestation
     */
    public function setPriceDivers($priceDivers)
    {
        $this->priceDivers = $priceDivers;

        return $this;
    }

    /**
     * Get priceDivers
     *
     * @return float 
     */
    public function getPriceDivers()
    {
        return $this->priceDivers;
    }

    /**
     * Set datePrestation
     *
     * @param \DateTime $datePrestation
     * @return Prestation
     */
    public function setDatePrestation($datePrestation)
    {
        $this->datePrestation = $datePrestation;

        return $this;
    }

    /**
     * Get datePrestation
     *
     * @return \DateTime 
     */
    public function getDatePrestation()
    {
        return $this->datePrestation;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Prestation
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set client
     *
     * @param \Strollad\PrestagesBundle\Entity\Client $client
     * @return Prestation
     */
    public function setClient(\Strollad\PrestagesBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Strollad\PrestagesBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }
}
