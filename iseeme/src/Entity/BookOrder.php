<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookOrderRepository")
 */
class BookOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $order_status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $customer_service_note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderStatus(): ?string
    {
        return $this->order_status;
    }

    public function setOrderStatus(?string $order_status): self
    {
        $this->order_status = $order_status;

        return $this;
    }

    public function getCustomerServiceNote(): ?string
    {
        return $this->customer_service_note;
    }

    public function setCustomerServiceNote(?string $customer_service_note): self
    {
        $this->customer_service_note = $customer_service_note;

        return $this;
    }

    public function getOrderStatusOfFailureBoolean(): ?string
    {
        if ($this->order_status == 'error'){
            return 'true';
        } else {
            return 'false';
        }
    }

    public function getHasConnectionFailedInServiceNote(): ?string
    {
        if(strpos($this->customer_service_note, 'connection failed')){
            return 'true';
        } elseif($this->customer_service_note == 'connection failed'){
            return 'true';
        } else {
            return 'false';
        }
    }

    public function getMeetsOrderApproveCriteria(): ?string
    {
        if($this->getOrderStatusOfFailureBoolean() == 'true' & $this->getHasConnectionFailedInServiceNote()== 'true'){
            return 'true';
        } else {
            return 'false';
        }
    }

}
