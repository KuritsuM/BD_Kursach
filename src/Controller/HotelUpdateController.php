<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelUpdateController extends AbstractController
{
    /**
     * @Route("/hotel/update/{hotelid}/{redirect}", name="update_hotel")
     */
    public function index(Request $request, $hotelid, $redirect): Response
    {
        $hotel = $this->getDoctrine()->getRepository(Hotel::class)->find($hotelid);
        $form = $this->createForm(HotelType::class, $hotel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute($redirect);
        }

        return $this->render('hotel/index.html.twig', [
            'hotel_form' => $form->createView()
        ]);
    }
}
