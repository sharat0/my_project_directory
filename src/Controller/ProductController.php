<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'Product',
        ]);
    }
    public function createProduct(ValidatorInterface $validator): Response
    {
        $product = new Product();
        // This will trigger an error: the column isn't nullable in the database
        $product->setUid(1);
        // This will trigger a type mismatch error: an integer is expected
        // $product->setPrice('1999');

        // ...

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        // ...
    }
}
