<?php

namespace App\Controller;

use App\Entity\Demand;
use App\Form\DemandReceiverType;
use App\Form\DemandSenderType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function newAction(Request $request)
    {
        $demand = new Demand;
        $form = $this->createForm(DemandSenderType::class, $demand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($demand);
            $this->em->flush();

            return $this->redirectToRoute('demand', ['code' => $demand->getId()]);
        }

        return $this->render('demand/new.html.twig', ['form' => $form->createView()]);
    }

    public function showAction(string $code, Request $request)
    {
        $demand = $this->em->getRepository(Demand::class)->find($code);
        if ($demand->getStatus() === Demand::STATUS_FILLED) {
            return $this->render('demand/show.html.twig', ['demand' => $demand]);
        }

        if ($demand->getStatus() === Demand::STATUS_NEW) {
            $demand->setStatus(Demand::STATUS_READ);
            $this->em->flush();
        }

        $demand
            ->setIp($request->getClientIp())
            ->setUserAgent($request->headers->get('User-Agent'));

        $form = $this->createForm(DemandReceiverType::class, $demand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demand->setStatus(Demand::STATUS_FILLED);
            $demand->setResponseDatetime(new DateTimeImmutable());
            $this->em->flush();

            return $this->redirectToRoute('demand', ['code' => $demand->getId()]);
        }

        return $this->render('demand/fill.html.twig', ['form' => $form->createView()]);
    }
}
