<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Imagine\Image\Box;
use Imagine\Gd\Imagine;
use App\Entity\Property;
use App\Form\ImagesType;
use App\Form\NearByType;
use Doctrine\ORM\QueryBuilder;
use App\Entity\AttributeEnable;
use App\Form\AttributeEnableType;
use Imagine\Image\ImageInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PropertyCrudController extends AbstractCrudController
{

    public const ACTION_DUPLICATE = 'duplikovat';
    public const PROPERTY_BASE_PATH = 'upload/images/property';
    public const PROPERTY_UPLOAD_DIR = 'public/upload/images/property';
    private const IMAGE_UPLOAD_WIDTH = 800;

    public static function getEntityFqcn(): string
    {
        return Property::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('transactionType')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.active = true');
            })
                ->setLabel('Typ transakce'),
            AssociationField::new('type')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.active = true');
            })
                ->setLabel('Typ nemovitosti'),
            TextField::new('numRooms')
                ->setLabel('Počet místností'),
            TextField::new('area')
                ->setLabel('Plocha'),
            AssociationField::new('conditionProperty'),
            MoneyField::new('price')
                ->setLabel('Cena')
                ->setCurrency('CZK'),
            TextField::new('priceDescription')
                ->setLabel('Popis ceny'),
            AssociationField::new('energy')
                ->setLabel('Energetický štítek'),
            CollectionField::new('attributeEnables')
                ->setEntryType(AttributeEnableType::class)
                ->setFormTypeOption('by_reference', false)
                ->setLabel('Další atributy nemovitosti')
                ->hideOnIndex(),
            CollectionField::new('nearByGroups')
                ->setEntryType(NearByType::class)
                ->setFormTypeOption('by_reference', false)
                ->setLabel('Místa v okolí')
                ->hideOnIndex(),
            AssociationField::new('status')
                ->setLabel('Status nemovitosti'),
            TextField::new('heading')
                ->setLabel('Nadpis'),
            TextEditorField::new('description')
                ->setLabel('Popis nemovitosti'),
            AssociationField::new('region')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.active = true');
            }),
            TextField::new('city')
                ->setLabel('Obec'),
            TextField::new('ku')
                ->setLabel('Katastrální území'),
            TextField::new('address')
                ->setLabel('Adresa'),
            ImageField::new('thumbnail')
                ->setLabel('Úvodní fotka')
                ->setBasePath(self::PROPERTY_BASE_PATH)
                ->setUploadDir(self::PROPERTY_UPLOAD_DIR),
            TimeField::new('createdAt')
                ->setLabel('Datum vytvoření')
                ->hideOnForm(),
            TimeField::new('updatedAt')
                ->setLabel('Datum editace')
                ->hideOnForm(),
            TextField::new('createdBy')
                ->setLabel('Vytvořil')
                ->hideOnForm(),
            TextField::new('updatedBy')
                ->setLabel('Editoval')
                ->hideOnForm(),
            AssociationField::new('client')
                ->setLabel('Vlastník nemovitosti (klient)'),
            AssociationField::new('ownership')
                ->setLabel('Typ vlastnictví'),
            BooleanField::new('active')
                ->setLabel('Publikovat'),
            CollectionField::new('images')
                ->setEntryType(ImagesType::class)
                ->onlyOnForms()
                ->setLabel('Fotky'),
            CollectionField::new('images')
                ->setEntryType(ImagesType::class)
                ->setFormTypeOption('by_reference', false)
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail()
                ->setLabel('Fotky')
        ];
    }


    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->linkToCrudAction('duplicateProperty')
            ->setCssClass('btn btn-info');

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, $duplicate)
            ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addCssFile('css/lightbox.css')
            ->addCssFile('https://cdn.jsdelivr.net/npm/simplelightbox/dist/simple-lightbox.css')
            ->addJsFile('https://cdn.jsdelivr.net/npm/simplelightbox/dist/simple-lightbox.js');
    }

    public function duplicateProperty(AdminContext $adminContext, AdminUrlGenerator $adminUrlGenerator, EntityManagerInterface $entityManager): Response
    {
        /** @var Product $product  */
        $product = $adminContext->getEntity()->getInstance();

        $duplicatedProduct = clone $product;

        parent::persistEntity($entityManager, $duplicatedProduct);

        $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicatedProduct->getId())
            ->generateUrl();
        return $this->redirect($url);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Property) return;
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $user = $this->getUser();
        if ($user instanceof User) {
            $entityInstance->setCreatedBy($user->getId());
        }
        $this->resizeUploadedImages($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Property) return;
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);
        $user = $this->getUser();
        if ($user instanceof User) {
            $entityInstance->setCreatedBy($user->getId());
        }
        $this->resizeUploadedImages($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    private function resizeUploadedImages($entityInstance): void
    {
        foreach ($entityInstance->getImages() as $image) {
            $imageFile = $image->getImageFile();
            if ($imageFile) {

                [$width, $height] = getimagesize($imageFile->getPathname());

                if ($width > self::IMAGE_UPLOAD_WIDTH) {
                    $newHeight = ceil($height * (self::IMAGE_UPLOAD_WIDTH / $width));
                    $originalImage = imagecreatefromstring(file_get_contents($imageFile->getPathname()));
                    $resizedImage = imagecreatetruecolor(self::IMAGE_UPLOAD_WIDTH, $newHeight);
                    imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, self::IMAGE_UPLOAD_WIDTH, $newHeight, $width, $height);
                    imagejpeg($resizedImage, $imageFile->getPathname());
                    imagedestroy($originalImage);
                    imagedestroy($resizedImage);
                }
            }
        }
    }
}
