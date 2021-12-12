<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setFirstName('Admin')
            ->setLastName('Admin')
            ->setEmail('admin@mairie.bj')
            ->setPassword($this->encoder->encodePassword($admin, 'password'))
            ->setRoles(['ROLE_ADMIN'])
            ->setCreatedAt(new \DateTime())
            ->setIsVerified(true);

        $manager->persist($admin);


        $redact = new User();
        $redact->setFirstName('Rédaction')
            ->setLastName('Rédaction')
            ->setEmail('redact@mairie.bj')
            ->setPassword($this->encoder->encodePassword($redact, 'password'))
            ->setRoles(['ROLE_REDACTOR'])
            ->setCreatedAt(new \DateTime())
            ->setIsVerified(true);

        $manager->persist($redact);

        foreach ($this->getCategoriesBase() as $categoryName) {
            $category = new Categories();
            $category->setName($categoryName)
                ->setCreatedAt(new \DateTime());
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getCategoriesBase(): array
    {
        return [
            'demarches',
            'projets',
            'conseils',
            'infos',
        ];
    }
}
