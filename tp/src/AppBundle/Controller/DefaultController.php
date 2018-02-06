<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\PostCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/demo/category", name="demo_category")
     */
    public function demoCategoryAction(){
        // on instantie post catégorie
        $category = new PostCategory();
        // on lui modifie le titre
        $category->setTitle('Category 1');

            // récupération du manager entité
        $em = $this->getDoctrine()->getManager();
        // persist
        $em->persist($category);
        // sauvegarde
        $em->flush();
        return new Response("Sauvegarde OK sur : ".$category->getId() ) ;
    }
    /**
     * @Route("/demo/page1", name="demo_page1")
     */
    public function demoPage1Action(){
        $category = $this->getDoctrine()->getRepository('AppBundle:PostCategory')->find( 1 );
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->find( 1 );
        return new Response("Category : ".$category->getTitle() . ' <br />Post : '.$post->getTitle() ) ;
    }


    /**
     * @Route("/demo/page_listing", name="demo_page_listing")
     */
    public function demoPageListingAction(){

        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        return $this->render('default/post_listing.html.twig', ['posts' => $posts]);
    }
    /**
     * @Route("/demo/page/{post}", name="demo_post_show")
     */
    public function demoPostShowAction(Post $post){

        return $this->render('default/post_show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/demo/post", name="demo_post")
     */
    public function demoPostAction(){
        // on instantie post
        $post = new Post();
        $category = $this->getDoctrine()->getRepository('AppBundle:PostCategory')->find( 1 );
        // on lui modifie le titre
        $post->setTitle('Post 3');
        $post->setDateCreated( new \DateTime() );
        $post->setEnable(true);
        $post->setContent('Lorem ipsum...');
        $post->setCategory( $category );
        // récupération du manager entité
        $em = $this->getDoctrine()->getManager();
        // persist
        $em->persist($post);
        // sauvegarde
        $em->flush();
        return new Response("Sauvegarde OK sur : ".$post->getId() ) ;
    }

    /**
     * @Route("/demo/delete_category", name="demo_delete_category")
     */
    public function demoCategoryDeleteAction(){
        // on instantie post catégorie
        $category2 = $this->getDoctrine()->getRepository('AppBundle:PostCategory')->find(2);
        $category3 = $this->getDoctrine()->getRepository('AppBundle:PostCategory')->find(3);
        $category4 = $this->getDoctrine()->getRepository('AppBundle:PostCategory')->find(4);
        $category5 = $this->getDoctrine()->getRepository('AppBundle:PostCategory')->find(5);
        $category6 = $this->getDoctrine()->getRepository('AppBundle:PostCategory')->find(6);

        // récupération du manager entité
        $em = $this->getDoctrine()->getManager();
        // persist
        $em->remove($category2);
        $em->remove($category3);
        $em->remove($category4);
        $em->remove($category5);
        $em->remove($category6);
        // sauvegarde
        $em->flush();
        return new Response("Sauvegarde OK sur : ".$category->getId() ) ;
    }

    /**
     * @Route("/demo/delete/{post}", name="demo_post_delete")
     */
    public function deletePostAction(Post $post){
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Votre suppression a bien été effectuée.');

        return $this->redirectToRoute('demo_page_listing');
    }

}
