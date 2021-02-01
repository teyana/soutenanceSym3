<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


// use Symfony\Component\Security\Core\userPasswordEncoderInterface

class LoginFormAuthenticator extends AbstractGuardAuthenticator
{
    protected $encoder;

    public function __construct(userPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('route') === 'security_login'
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        return $request->request->get('login'); //Array avec 3 infos - on sort les infos de connexions
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider-loadUserByUsername($credentials['email']); //Va chercher l'utilisateur qui correspond à cet email. Le provider cherche grace à (security.yaml), et on trouve l'email dans la bdd
    }

    public function checkCredentials($credentials, UserInterface $user) // Vérifier que le mot de passe fourni, correspond à celui de l'utilisateur trouvé
    {
        // vérifier que $credentials['password'] correspond bien à $user->getPassword()
        $this->encoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->attributes->set(Security::AUTHENTICATION_ERROR, $exception);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return new RedirectResponse('/');
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }

    public function supportsRememberMe()
    {
        // todo
    }
}
