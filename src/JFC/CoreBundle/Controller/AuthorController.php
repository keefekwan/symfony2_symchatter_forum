<?php
// src/JFC/CoreBundle/Controller/AuthorController.php

namespace JFC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorController extends Controller
{
    /**
     * Show posts by Author
     *
     * @param $author
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @internal param string $slug
     *
     * @return array
     *
     * @Route("author/{author}", name="jfc_core_author_show")
     * @Template("JFCCoreBundle:Author:show.html.twig")
     */
    public function showAction($author)
    {
        $posts = $this->getDoctrine()->getRepository('JFCModelBundle:Post')->findBy(array(
           'author' => $author
        ));
        if (null === $author) {
            throw $this->createNotFoundException('No posts were found');
        }

        return array(
            'posts'  => $posts
        );
    }
}