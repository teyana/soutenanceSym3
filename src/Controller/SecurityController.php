<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $form = $this->createForm(LoginType::class, ['email' => $utils->getLastUsername()]);

        return $this->render('security/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $utils->getLAstAuthenticationError()
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/new_login", name="security_new_login")
     */
    public function create(FormFactoryInterface $factory, Request $request, EntityManagerInterface $em)
    {
        $builder = $factory->createBuilder(FormType::class, null, [
            'data_class' => User::class
        ]);

        $builder->add('full_name', TextType::class, [
            'label' => 'Prénom et nom',
            'attr' => ['placeholder' => 'Entrez Votre prénom et votre nom']
        ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'attr' => ['placeholder' => 'Entrez une adresse email de connexion']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => "Entrez un mot de passe de connexion"]
            ]);


        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = new User;

            $hash = $this->encoder->encodePassword($user, "password");

            $user->setEmail($data->getEmail());
            $user->setFullName($data->getFullName());
            $user->setPassword($hash);

            $em->persist($user);
            $em->flush();

            $this->addFlash('sucess', "Votre inscription est validé ! Vous pouvez vous connecter dès maintenant {$data->getFullName()}");

            return $this->redirectToRoute('security_login');
        }

        $formView = $form->createView();

        return $this->render('security/new_login.html.twig', [
            'formView' => $formView
        ]);
    }
}
