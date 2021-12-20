<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Hotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelReadController extends AbstractController
{
    /**
     * @Route("/", name="hotel_read")
     */
    public function hotelRead(): Response
    {
        $hotel = $this->getDoctrine()->getRepository(Hotel::class)->findAll();
        $emp = $this->getDoctrine()->getRepository(Employee::class)->findAll();

        return $this->render('hotel_read/hotel.html.twig', [
            'hotel' => $hotel,
            'employees' => $emp
        ]);
    }
}
