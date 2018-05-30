<?php

namespace App\Controller;

use App\Entity\Demand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DemandController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function newAction()
    {
        $demand = (new Demand);
        $this->em->persist($demand);
        $this->em->flush();

        return $this->redirectToRoute('demand', ['code' => $demand->getId()]);
    }

    public function showAction(string $code)
    {
        $demand = $this->em->getRepository(Demand::class)->find($code);

        return new Response($demand->getId());
    }
}
