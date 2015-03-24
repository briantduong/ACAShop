<?php

namespace ACA\ShopBundle\Controller;
use ACA\ShopBundle\Shop\DBCommon;
use ACA\ShopBundle\Service\LoginService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Exception;

class LoginController extends Controller
{
    /**
     * Handle login
     */
    public function processLoginAction()
    {

        /** @var LoginService $loginService */
        $loginService = $this->get('service_login');
        $username = $_POST['username'];
        $password = $_POST['password'];
        /** @var Session $session */
        $session = $this->get('session');

        try{
            /** @var bool $didLogin This is the result of them logging in yay or neigh */
            $didLogin = $loginService->doLogin($username, $password); // Can throw an exception
            if(!$didLogin){
                throw new Exception('An unknown error occurred');
            }
            $session->set('logged_in', true);
            $session->set('user_id', $loginService->getUserId());
            $session->set('name', $loginService->getFullName());
        // If it does, it will end up in this catch block
        }catch(Exception $e){
            $session->set('is_error', true);
            $session->set('msg', $e->getMessage());
        }
        return new RedirectResponse('/');
    }

    public function processLogoutAction()
    {
        /** @var Session $session */
        $session = $this->get('session');
        $session->clear();
        return new RedirectResponse('/');
    }
}