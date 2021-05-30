<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Quiz;
use App\Entity\Reponse;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('W PHP 502 NCY 2 1 Quiz Timothee Hennequin');
    }

    public function configureMenuItems(): iterable
    {
       // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
         yield MenuItem::linkToCrud('Categorie', 'fas fa-list', Categorie::class);
         yield MenuItem::linkToCrud('Quiz', 'fas fa-list', Quiz::class);
         yield MenuItem::linkToCrud('Reponse', 'fas fa-list', Reponse::class);
    }
}
