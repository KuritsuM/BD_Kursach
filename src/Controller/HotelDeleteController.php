<?php

namespace App\Controller;

use App\Entity\Hotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelDeleteController extends AbstractController
{
    /**
     * @Route("/hotel/delete/{hotelid}/{redirect}", name="delete_hotel")
     */
    public function deleteHotel($hotelid, $redirect): Response
    {

        $em = $this->getDoctrine()->getManager();
        $hotel = $this->getDoctrine()->getRepository(Hotel::class)->find($hotelid);

        if ($hotel != null) {
            $em->remove($hotel);
            $em->flush();
        }

        return $this->redirectToRoute($redirect);
    }
}
