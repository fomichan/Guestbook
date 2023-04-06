<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use function Symfony\Component\DependencyInjection\Loader\Configurator\iterator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

}



