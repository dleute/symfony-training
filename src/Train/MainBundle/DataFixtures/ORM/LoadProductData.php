<?php
namespace Train\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Train\MainBundle\Entity\Product;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }    
    
    public function load($manager)
    {
        $product = new Product();
    
        $product->setName('Stupid Product');
        $product->setPrice('19.99');
        $product->setDescription($this->container->get('templating')->render("MainBundle:Default:product.html.twig", array('product' => $product)));

        $manager->persist($product);
        $manager->flush();
    }
}