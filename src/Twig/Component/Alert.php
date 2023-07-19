<?php

namespace App\Twig\Component;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'alert-flash', template: 'components/Alert.html.twig')]
class Alert
{
    public string $type = 'success';
    public string $message = 'Success!';
}