<?php

namespace App\Twig\Component;

use App\Entity\Address;
use App\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

class AddressListForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;


    public ?Address $address;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            AddressType::class,
            $this->address
        );
    }
}