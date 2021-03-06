<?php
// src/JFC/AdminBundle/Controller/RegisterController.php

namespace JFC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use JFC\ModelBundle\Form\RegisterFormType;
use JFC\ModelBundle\Entity\User;

/**
 * Class RegisterController
 */
class RegisterController extends Controller
{
    /**
     * Register user
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Array
     *
     * @Route("/register", name="jfc_user_register")
     * @Template("JFCAdminBundle:Register:register.html.twig")
     */
    public function registerAction(Request $request)
    {
        $defaultUser = new User();

        $form = $this->createForm(new RegisterFormType(), $defaultUser);

        // Form validation
        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {

                $user = $form->getData();

                $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));

                // Persists and flushes the newly created user
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // Flash message for successfully creating user
                $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'User Registration successful');

                $url = $this->generateUrl('jfc_core_index');

                return $this->redirect($url);
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Encodes Password
     *
     * @param $user
     * @param $plainPassword
     * @return string
     */
    private function encodePassword($user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
}