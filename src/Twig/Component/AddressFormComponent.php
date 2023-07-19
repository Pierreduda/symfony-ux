<?php

namespace App\Twig\Component;

use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(name: 'address-form', template: 'components/address-form.html.twig')]
class AddressFormComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(fieldName: 'data')]
    public ?Address $address = null;

    #[LiveAction]
    public function save(EntityManagerInterface $entityManager):void
    {
        $this->submitForm();

        if ($this->form->isValid())
        {
            $entityManager->persist($this->address);
            $entityManager->flush();

            $this->addFlash('success', 'Address saved!');
        }
        $this->resetForm();
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(AddressType::class, $this->address);
    }
}