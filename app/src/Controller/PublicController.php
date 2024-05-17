<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\User\AuthenticateUserService;
use App\Service\User\CheckIfUserExistsService;
use App\Service\User\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class PublicController extends AbstractController
{
    #[Route('/', name: 'public_home')]
    public function public(Request $request, CheckIfUserExistsService $checkIfUserExistsService): Response
    {
        $form = $this->createFormBuilder(null)
            ->add('email', EmailType::class)
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $email = $form->getData()['email'];
            /** @var User $user */
            $user = ($checkIfUserExistsService)($email);
            if(!$user){
                $session = $request->getSession();
                $session->set('user_email', $email);
                return $this->redirectToRoute('public_sign_in');
            }else{
                $session = $request->getSession();
                $session->set('user_email', $email);
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('public/index.html.twig', [
            'title' => 'Bienvenue !',

            'form' => $form,
        ]);
    }

    #[Route('/sign-in', name: 'public_sign_in')]
    public function sign_in(
        Request $request,
        CreateUserService $createUserService,
        AuthenticateUserService $authenticateUserService
    ): Response
    {
        $session = $request->getSession();
        $user_email = $session->get('user_email');
        if(!$user_email){
            return $this->redirectToRoute('public_home');
        }

        $form = $this->createFormBuilder(null, [
                'attr' => ['data-turbo-frame' => "_top"]
            ])
            ->setAction($this->generateUrl('public_sign_in'))
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'empty_data' => $user_email,
                'disabled' => true
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'options' => ['attr' => ['type' => 'password', 'required' => true,'class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Veuillez repéter le mot de passe'],
                'constraints' => [

                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $form->getData()["password"];

            $user = ($createUserService)(email: $user_email, password: $password);
            if($user){
                return ($authenticateUserService)(user: $user);
            }
        }

        return $this->render('public/sign_in.html.twig', [
            'title' => 'Inscription OK',
            'user_email' => $user_email,

            'form' => $form,
        ]);
    }
}
