<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\EmployeeInfo;
use App\Entity\Hotel;
use App\Entity\Position;
use App\Form\EmployeeInfoType;
use App\Form\EmployeeType;
use App\Form\HotelType;
use App\Form\PositionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{


    /**
     * HotelController constructor.
     */
    public function __construct()
    {
    }


    /**
     * @Route("/", name="hotel")
     */
    public function index(): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);


        return $this->render('hotel/index.html.twig', [
            'hotel_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/position", name="create_position")
     */
    public function createPosition(Request $request) : Response {
        $position = new Position();
        $form = $this->createForm(PositionType::class, $position);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //var_dump($position);

            $em = $this->getDoctrine()->getManager();
            $em->persist($position);
            $em->flush();
        }

        return $this->render('hotel/position_create.html.twig', [
            'position_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/employee", name="create_employee")
     */
    public function createEmployee(Request $request) {
        $employee = new Employee();
        $employeeForm = $this->createForm(EmployeeType::class, $employee);

        $employeeForm->handleRequest($request);

        if ($employeeForm->isSubmitted() && $employeeForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($employee);
            $em->flush();
        }

        return $this->render('hotel/employee_create.html.twig', [
            'employee_form' => $employeeForm->createView()
        ]);
    }
}
