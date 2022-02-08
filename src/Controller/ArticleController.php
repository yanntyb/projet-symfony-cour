<?php

namespace App\Controller;

use App\Service\PlaceholderImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/article", name: "article_")]
class ArticleController extends AbstractController
{

    #[Route("/placeholder/{width}x{height}", name: "placeholder_test")]
    public function home(int $width, int $height, PlaceholderImageService $placeholderImage): Response{
        $imageLink = $placeholderImage->getNewImageAndSave($width, $height);
        return $this->render("article/placeholder.html.twig", [
            "src" => $imageLink,
            "dimensions" => [
                "width" => $width,
                "height" => $height
            ]
        ]);
    }
}