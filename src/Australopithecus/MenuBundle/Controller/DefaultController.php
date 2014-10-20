<?php

namespace Australopithecus\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $menuEntities = $em->getRepository('AustralopithecusMenuBundle:Menu')->findAll();
        $productEntities = $em->getRepository('AustralopithecusMenuBundle:Product')->findAll(); 
        return array(
            'menuEntities' => $menuEntities,
            'productEntities' => $productEntities
        ); 
    }
}
