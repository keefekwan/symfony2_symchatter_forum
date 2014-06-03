<?php
// src/JFC/CoreBundle/Controller/AuthorController.php

namespace JFC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JFC\ModelBundle\Entity\Category;
use JFC\ModelBundle\Entity\Post;
use Doctrine\Common\Collections;

class CategoryController extends Controller
{
    /**
     * Show posts by Category
     *
     * @param null $category
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @internal param string $slug
     *
     * @return array
     *
     * @Route("category/{category}", name="jfc_core_category_show")
     * @Template("JFCCoreBundle:Category:show.html.twig")
     */
    public function showAction($category)
    {
        $em = $this->getDoctrine()->getManager();

        // Original code without sort DESC - sorts by ASC
//        $category = $em->getRepository('JFCModelBundle:Category')
//            ->findOneByTitle($category);

//        if (!$category) {
//            throw $this->createNotFoundException('Unable to find blog posts');
//        }

//        $posts = $category->getPosts(); // Gets blogs from each category selected

        // Sorts DESC with custom query
        $posts = $em->getRepository('JFCModelBundle:Post')
            ->getBlogsByCategory($category);

        if (!$posts) {
            throw $this->createNotFoundException('Unable to find blog posts');
        }

        return array(
            'posts'    => $posts,
//            'category' => $category
        );
    }
}