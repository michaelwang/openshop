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

        $url = "http://127.0.0.1:8002/api/post";
        $user = $this->container->get('security.context')->getToken()->getUser();
        $access_token = $user->getCustomAccessToken();
        $browser = $this->get('gremo_buzz');        
        $response = $browser->get($url, array(
            "Authorization: Bearer $access_token",
            "Accept: application/json",            
        ));
        $content = $response->getContent();
        $data = json_decode($content);
        var_dump($data);exit;
        return array(
            'menuEntities' => $menuEntities,
            'productEntities' => $productEntities
        ); 
    }
}
