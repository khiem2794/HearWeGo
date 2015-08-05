<?php
/**
 * Created by PhpStorm.
 * User: khiem
 * Date: 05/08/2015
 * Time: 10:28
 */

namespace HearWeGo\HearWeGoBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticationHandler extends \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler
{
    protected $container;

    function __construct(HttpUtils $httpUtils, \Symfony\Component\DependencyInjection\ContainerInterface $cont, array $options)
    {
        parent::__construct($httpUtils, $options);
        $this->container=$cont;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($failureUrl = $request->get($this->options['failure_path_parameter'], null, true)) {
            $this->options['failure_path'] = $failureUrl;
        }

        if (null === $this->options['failure_path']) {
            $this->options['failure_path'] = $this->options['login_path'];
        }

        if ($this->options['failure_forward']) {
            if (null !== $this->logger) {
                $this->logger->debug('Authentication failure, forward triggered.', array('failure_path' => $this->options['failure_path']));
            }

            $subRequest = $this->httpUtils->createRequest($request, $this->options['failure_path']);
            $subRequest->attributes->set(Security::AUTHENTICATION_ERROR, $exception);

            return $this->httpKernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
        }

        if (null !== $this->logger) {
            $this->logger->debug('Authentication failure, redirect triggered.', array('failure_path' => $this->options['failure_path']));
        }

        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        return $this->httpUtils->createRedirectResponse($request, $this->options['failure_path']);
    }


}