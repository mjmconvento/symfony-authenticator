<?php

namespace App\Controller;

use App\Entity\Tenant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SecuredPageController extends AbstractController
{
    /**
     * @var string DEFAULT_DB_NAME
     */
    private const DEFAULT_DB_NAME = 'Tenant One';

    /**
     * @return Response
     */
    public function securedPage(): Response
    {
        return $this->render('securedPage.html.twig', [
            'tenant' => $_GET['tenant'] ?? self::DEFAULT_DB_NAME,
            'tenantList' => $this->getDoctrine()->getRepository(Tenant::class)->findAll(),
            'api_key' => $this->getUser()->getApiKey()
        ]);
    }
}
