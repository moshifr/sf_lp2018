<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PostCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Postcategory controller.
 *
 * @Route("admin/postcategory")
 */
class PostCategoryController extends Controller
{
    /**
     * Lists all postCategory entities.
     *
     * @Route("/", name="admin_postcategory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $postCategories = $em->getRepository('AppBundle:PostCategory')->findAll();
        return $this->render('postcategory/index.html.twig', array(
            'postCategories' => $postCategories,
        ));
    }

    /**
     * Creates a new postCategory entity.
     *
     * @Route("/new", name="admin_postcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $postCategory = new Postcategory();
        $form = $this->createForm('AppBundle\Form\PostCategoryType', $postCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($postCategory);
            $em->flush();

            return $this->redirectToRoute('admin_postcategory_show', array('id' => $postCategory->getId()));
        }
        return $this->render('postcategory/new.html.twig', array(
            'postCategory' => $postCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a postCategory entity.
     *
     * @Route("/{id}", name="admin_postcategory_show")
     * @Method("GET")
     */
    public function showAction(PostCategory $postCategory)
    {
        $deleteForm = $this->createDeleteForm($postCategory);

        return $this->render('postcategory/show.html.twig', array(
            'postCategory' => $postCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing postCategory entity.
     *
     * @Route("/{id}/edit", name="admin_postcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PostCategory $postCategory)
    {
        $deleteForm = $this->createDeleteForm($postCategory);
        $editForm = $this->createForm('AppBundle\Form\PostCategoryType', $postCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_postcategory_edit', array('id' => $postCategory->getId()));
        }

        return $this->render('postcategory/edit.html.twig', array(
            'postCategory' => $postCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a postCategory entity.
     *
     * @Route("/{id}", name="admin_postcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PostCategory $postCategory)
    {
        $form = $this->createDeleteForm($postCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($postCategory);
            $em->flush();
        }

        return $this->redirectToRoute('admin_postcategory_index');
    }

    /**
     * Creates a form to delete a postCategory entity.
     *
     * @param PostCategory $postCategory The postCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PostCategory $postCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_postcategory_delete', array('id' => $postCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
