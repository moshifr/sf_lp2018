<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/time/now", name="time_index")
     */
    public function timeAction(){

        return $this->render('default/time.html.twig',
            ['time' => strftime('le %A %d/%m/%Y %H:%M:%S') ]
        );
    }

    /**
     * @Route("/color/{color}", name="color_index", requirements={"color": "[a-zA-Z]+"})
     */
    public function colorAction( $color ){

        return $this->render('default/color.html.twig',
            ['color' => $color ]
        );
    }

}
