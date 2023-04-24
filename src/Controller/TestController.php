<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/api/email/test", name="app_test")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new Email controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
