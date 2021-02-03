<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/project/new", name="project_new")
     */
    public function newProject(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();
        }
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/project/edit/{id}", methods={"GET", "POST"}, name="project_edit")
     */
    public function editProject(
        int $id,
        ProjectRepository $projectRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $project = $projectRepository->findOneBy(['id' => $id]);

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();
        }
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
