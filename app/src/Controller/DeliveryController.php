<?php

declare(strict_types=1);

namespace App\Controller;

use App\Registry\CalculatorRegistry;
use App\Request\DeliveryCalculateRequest;
use Jrm\RequestBundle\MapRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DeliveryController extends AbstractController
{
    public function __construct(
        private readonly CalculatorRegistry $calculatorRegistry,
    ) {
    }

    #[Route(path: '/deliveries/calculate/{slug}', methods: 'GET')]
    public function calculate(#[MapRequest] DeliveryCalculateRequest $request): JsonResponse
    {
        $cost = $this->calculatorRegistry->resolve($request->slug)->calculate($request->weight());

        return new JsonResponse($cost);
    }

    #[Route(path: '/deliveries', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('delivery/index.html.twig');
    }
}
