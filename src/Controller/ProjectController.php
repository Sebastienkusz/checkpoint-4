<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route(name="project_")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(
        ProjectRepository $projectRepository,
        CategoryRepository $categoryRepository
    ): Response
    {
        $projects   = $projectRepository->findAll();
        $categories = $categoryRepository->findAll();
        return $this->render('project/index.html.twig', [
            'projects'   => $projects,
            'categories' => $categories,
        ]);
    }

}
