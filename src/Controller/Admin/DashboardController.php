<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Controller\Admin\UserCrudController;
use App\Entity\AllowedSites;
use App\Entity\Attributes;
use App\Entity\Client;
use App\Entity\ConditionProperty;
use App\Entity\Energy;
use App\Entity\NearBy;
use App\Entity\Ownership;
use App\Entity\Property;
use App\Entity\Region;
use App\Entity\Status;
use App\Entity\TransactionType;
use App\Entity\Type;
use Attribute;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container
            ->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)
            ->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Reality');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa-brands fa-dashcube');

        yield MenuItem::section('Nemovitosti', 'fa-solid fa-building-flag');
        yield MenuItem::subMenu('Akce', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat', 'fas fa-plus', Property::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit', 'fas fa-eye', Property::class)
        ]);

        yield MenuItem::section('Nastavení', 'fa-solid fa-gear');
        yield MenuItem::subMenu('Typy nemovitostí', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat typ', 'fas fa-plus', Type::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit typy', 'fas fa-eye', Type::class)
        ]);

        yield MenuItem::subMenu('Typy transakcí', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat transakci', 'fas fa-plus', TransactionType::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit transakce', 'fas fa-eye', TransactionType::class)
        ]);

        yield MenuItem::subMenu('Typy vlastnictví', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat typ', 'fas fa-plus', Ownership::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit typy', 'fas fa-eye', Ownership::class)
        ]);

        yield MenuItem::subMenu('Stav nemovitosti', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat', 'fas fa-plus', ConditionProperty::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit', 'fas fa-eye', ConditionProperty::class)
        ]);

        yield MenuItem::subMenu('Status nemovitosti', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat status', 'fas fa-plus', Status::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit statusy', 'fas fa-eye', Status::class)
        ]);

        yield MenuItem::subMenu('Energetické štítky', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat štítek', 'fas fa-plus', Energy::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit štítky', 'fas fa-eye', Energy::class)
        ]);

        yield MenuItem::subMenu('Atributy nemovitosti', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat atribut', 'fas fa-plus', Attributes::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit atributy', 'fas fa-eye', Attributes::class)
        ]);

        yield MenuItem::subMenu('Místa v okolí', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat místo', 'fas fa-plus', NearBy::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit místa', 'fas fa-eye', NearBy::class)
        ]);

        yield MenuItem::subMenu('Regiony', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Přidat region', 'fas fa-plus', Region::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit regiony', 'fas fa-eye', Region::class)
        ]);

        yield MenuItem::section('Lidé', 'fa-solid fa-people-group');
        yield MenuItem::subMenu('Klienti', 'fa-solid fa-restroom')->setSubItems([
            MenuItem::linkToCrud('Přidat klienta', 'fas fa-plus', Client::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit klienty', 'fas fa-eye', Client::class)
        ]);
        yield MenuItem::subMenu('Uživatelé', 'fas fa-user-group')->setSubItems([
            MenuItem::linkToCrud('Zobrazit uživatele', 'fas fa-eye', User::class)
        ]);

        yield MenuItem::section('Weby a data', 'fa-solid fa-wrench');
        yield MenuItem::subMenu('Povolené weby', 'fa-solid fa-globe')->setSubItems([
            MenuItem::linkToCrud('Přidat web', 'fas fa-plus', AllowedSites::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Zobrazit weby', 'fas fa-eye', AllowedSites::class)
        ]);
    }
}
