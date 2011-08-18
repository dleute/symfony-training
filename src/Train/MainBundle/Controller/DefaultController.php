<?php

namespace Train\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Train\MainBundle\Entity\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/{name}", name = "hamepage", defaults = { "name" = "sniff" })
     */
    public function indexAction($name = "snarf",$page = "myPage")
    {
      
      $repository = $this->getDoctrine()->getRepository('MainBundle:Product');
      
      $products = $repository->findAll();
      
      if (!count($products)) {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush();      
      }

      
      $response = $this->render("MainBundle:Default:index.html.twig", array('name' => $name, 'products' => $products));
      return $response;
      // return array('name' => $name);
    }
}
