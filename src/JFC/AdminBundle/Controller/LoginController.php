<?php
// src/JFC/AdminBundle/Controller/LoginController.php

namespace JFC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends Controller
{
    /**
     * Login action
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Array
     *
     * @Route("/login", name="jfc_admin_login")
     * @Template("JFCAdminBundle:Login:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);

        return array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
        );
    }

    /**
     * Login check action
     *
     * @Route("/login_check", name="jfc_admin_login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
     * Logout action
     *
     * @Route("/logout", name="jfc_admin_logout")
     */
    public function logoutAction()
    {
    }
}