<?php

/**
 * Created by PhpStorm.
 * User: asus
 * Date: 22/11/2017
 * Time: 16:07
 */
namespace FrontEndBundle\Controller\Redirection ;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface

{
    /**

     * @var \Symfony\Component\Routing\RouterInterface

     */
    private $router;
    protected $security;

    /** * @param RouterInterface $router */
    public function __construct(RouterInterface $router)
    { $this->router = $router; }
    /** * @param Request $request
     * * @param TokenInterface $token
     * @return RedirectResponse */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {

        // Get list of roles for current user

        $roles = $token->getRoles();

        // Tranform this list in array

        $rolesTab = array_map(function($role) {

            return $role->getRole();
        }, $roles);



        if (in_array('ROLE_ADMIN', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('esprit_Acceuilpage'));
        if (in_array('ROLE_ETUDIANT', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('front_end_homepage'));
        if (in_array('ROLE_RESPONSABLE', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('esprit_Acceuilpage'));
        if (in_array(' ROLE_PROFESSEUR', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('AficheRevision'));



        // otherwise we redirect user to the member area
        return $redirection;
    }
}

