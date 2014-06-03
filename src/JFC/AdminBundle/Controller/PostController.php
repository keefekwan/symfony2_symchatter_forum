<?php
// src/JFC/AdminBundle/Controller/PostController.php

namespace JFC\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JFC\ModelBundle\Entity\Post;
use JFC\ModelBundle\Form\PostType;

/**
 * Post controller
 *
 * @Route("/post")
 */
class PostController extends Controller
{

    /**
     * Lists all Post entities.
     *
     * @return Array
     *
     * @Route("/", name="jfc_post")
     * @Method("GET")
     * @Template("JFCAdminBundle:Post:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('JFCModelBundle:Post')->findPosts();

        return array(
            'posts' => $posts,
        );
    }

    /**
     * Creates a new Post entity.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Array
     *
     * @Route("/", name="jfc_post_create")
     * @Method("POST")
     * @Template("JFCAdminBundle:Post:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createCreateForm($post);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $post->setAuthor($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl('jfc_post_show', array('id' => $post->getId())));
        }

        return array(
            'post' => $post,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Post entity.
    *
    * @param Post $post The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Post $post)
    {
        $form = $this->createForm(new PostType(), $post, array(
            'action' => $this->generateUrl('jfc_post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @Route("/new", name="jfc_post_new")
     * @Method("GET")
     * @Template("JFCAdminBundle:Post:new.html.twig")
     */
    public function newAction()
    {
        $post = new Post();
        $form   = $this->createCreateForm($post);

        return array(
            'post' => $post,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="jfc_post_show")
     * @Method("GET")
     * @Template("JFCAdminBundle:Post:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('JFCModelBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'post'      => $post,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", name="jfc_post_edit")
     * @Method("GET")
     * @Template("JFCAdminBundle:Post:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('JFCModelBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($post);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'post'      => $post,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Post entity.
    *
    * @param Post $post The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Post $post)
    {
        $form = $this->createForm(new PostType(), $post, array(
            'action' => $this->generateUrl('jfc_post_update', array(
                    'id' => $post->getId()
                )),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Post entity.
     *
     * @Route("/{id}", name="jfc_post_update")
     * @Method("PUT")
     * @Template("JFCAdminBundle:Post:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('JFCModelBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($post);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('jfc_post_edit', array('id' => $id)));
        }

        return array(
            'post'      => $post,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Post entity.
     *
     * @Route("/{id}", name="jfc_post_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $post = $em->getRepository('JFCModelBundle:Post')->find($id);

            if (!$post) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($post);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('jfc_post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jfc_post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
