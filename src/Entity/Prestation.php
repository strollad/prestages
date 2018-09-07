<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Prestation
 *
 * @ORM\Table(name="prestation")
 * @ORM\Entity(repositoryClass="App\Repository\PrestationRepository")
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
     * @ORM\Column(name="datePrestation", type="date", nullable=false)
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
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="prestations")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     **/
    private $client;

    /**
     * @ORM\Column(name="workflowState", type="json_array", nullable=true)
     */
    protected $workflowState;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDatePrestation(): ?\DateTimeInterface
    {
        return $this->datePrestation;
    }

    public function setDatePrestation(\DateTimeInterface $datePrestation): self
    {
        $this->datePrestation = $datePrestation;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getPriceKendalch(): ?float
    {
        return $this->priceKendalch;
    }

    public function setPriceKendalch(float $priceKendalch): self
    {
        $this->priceKendalch = $priceKendalch;

        return $this;
    }

    public function getPriceTransport(): ?float
    {
        return $this->priceTransport;
    }

    public function setPriceTransport(float $priceTransport): self
    {
        $this->priceTransport = $priceTransport;

        return $this;
    }

    public function getPriceAnimation(): ?float
    {
        return $this->priceAnimation;
    }

    public function setPriceAnimation(float $priceAnimation): self
    {
        $this->priceAnimation = $priceAnimation;

        return $this;
    }

    public function getPriceDivers(): ?float
    {
        return $this->priceDivers;
    }

    public function setPriceDivers(float $priceDivers): self
    {
        $this->priceDivers = $priceDivers;

        return $this;
    }

    public function getWorkflowState()
    {
        return $this->workflowState;
    }

    public function setWorkflowState($workflowState): self
    {
        $this->workflowState = $workflowState;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
