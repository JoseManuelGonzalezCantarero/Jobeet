<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Affiliate;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAffiliateData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $affiliate = new Affiliate();

        $affiliate->setUrl('http://sensio-labs.com/');
        $affiliate->setEmail('address1@example.com');
        $affiliate->setTokenValue();
        $affiliate->setIsActive(true);
        $affiliate->addCategory($em->merge($this->getReference('category-programming')));

        $em->persist($affiliate);

        $affiliate = new Affiliate();

        $affiliate->setUrl('/');
        $affiliate->setEmail('address2@example.org');
        $affiliate->setTokenValue();
        $affiliate->setIsActive(false);
        $affiliate->addCategory($em->merge($this->getReference('category-programming')), $em->merge($this->getReference('category-design')));

        $em->persist($affiliate);
        $em->flush();

        $this->addReference('affiliate', $affiliate);
    }

    public function getOrder()
    {
        return 3; // This represents the order in which fixtures will be loaded
    }
}