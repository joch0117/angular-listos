<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    #[Route('/api/demo', name: 'app_demo',methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'bienvenu sur le premier controller de test',
            'status'=> 'succes',
            'time'=> date('Y-m-d H:i:s')
        ]);
    }
}
