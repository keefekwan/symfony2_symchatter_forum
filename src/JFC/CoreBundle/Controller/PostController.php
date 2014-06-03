<?php
// src/JFC/CoreBundle/Controller/PostController.php

namespace JFC\CoreBundle\Controller;

use JFC\ModelBundle\Entity\Reply;
use JFC\ModelBundle\Form\ReplyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JFC\ModelBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * Show the posts index
     *
     * @return array
     *
     * @Route("/", name="jfc_core_index")
     * @Template("JFCCoreBundle:Post:index.html.twig")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
            ->findPosts(); // Using custom DESC query in PostRepository

        return array(
            'posts' => $posts,
        );
    }

    /**
     * Show a post
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/{slug}", name="jfc_core_post_show")
     * @Template("JFCCoreBundle:Post:show.html.twig")
     */
    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
            ->findOneBy(array(
               'slug' => $slug
            ));

        // Custom query to sort by DESC
//        $post = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
//            ->findPostsBySlug($slug);

        // Form for replies
        $form = $this->createForm(new ReplyType());

        return array(
          'post' => $post,
          'form' => $form->createView()
        );
    }

    /**
     * Create reply
     *
     * @param Request $request
     * @param string $slug
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return array
     *
     * @Route("/{slug}/create-reply", name="jfc_core_post_createreply")
     * @Method("POST")
     * @Template("JFCCoreBundle:Post:show.html.twig")
     */
    public function createReplyAction(Request $request, $slug)
    {
        $post = $this->getDoctrine()->getRepository('JFCModelBundle:Post')
            ->findOneBy(array(
               'slug' => $slug
            ));

        if (null == $post) {
            throw $this->createNotFoundException('Post was not found');
        }

        $reply = new Reply();
        $reply->addPost($post);

        $form = $this->createForm(new ReplyType(), $reply);
        $form->handleRequest($request);

        // Form validation
        if ($form->isValid()) {
            $reply->setAuthor($this->getUser());

            $this->getDoctrine()->getManager()->persist($reply);
            $this->getDoctrine()->getManager()->flush();

            // Flash message for successful post reply
            $this->get('session')->getFlashBag()->add('success', 'Your post reply was submitted');

            return $this->redirect($this->generateUrl('jfc_core_post_show', array(
                'slug' => $slug
            )));
        }

        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }
}