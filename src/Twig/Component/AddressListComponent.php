<?php

namespace App\Twig\Component;

use App\Repository\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(name: 'address-list', template: 'components/address-list.html.twig')]
class AddressListComponent extends AbstractController
{
    use DefaultActionTrait;

    public function __construct(private readonly AddressRepository $addressRepository)
    {
    }

    public function getAddresses(): array
    {
        return $this->addressRepository->findAll();
    }
}