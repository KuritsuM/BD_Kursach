<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Employee;
use App\Entity\EmployeeInfo;
use App\Entity\Food;
use App\Entity\FoodIngridients;
use App\Entity\FoodOrder;
use App\Entity\Hotel;
use App\Entity\IngridientsOrder;
use App\Entity\Position;
use App\Entity\Reservation;
use App\Form\ClientType;
use App\Form\EmployeeInfoType;
use App\Form\EmployeeType;
use App\Form\FoodIngridientsType;
use App\Form\FoodOrderType;
use App\Form\FoodType;
use App\Form\HotelType;
use App\Form\IngridientOrderType;
use App\Form\PositionType;
use App\Form\ReservationType;
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
     * @Route("/hotel", name="hotel")
     */
    public function createHotel(Request $request): Response
    {
        // rework this!

        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($hotel);
            $em->flush();
        }

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

            //dd($request);

            foreach ($request->request->get('employee')['positions'] as $positionId) {
                $position = $this->getDoctrine()->getRepository(Position::class)->find($positionId);

                //dd($position);

                $employee->addPosition($position);

                $position->addEmployee($employee);
                $em->persist($position);
            }

            $em->persist($employee);

            $em->flush();
        }

        return $this->render('hotel/employee_create.html.twig', [
            'employee_form' => $employeeForm->createView()
        ]);
    }

    /**
     * @Route("/client", name="create_client")
     */
    public function createClient(Request $request) {
        $client = new Client();
        $clientForm = $this->createForm(ClientType::class, $client);

        $clientForm->handleRequest($request);

        if ($clientForm->isValid() && $clientForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($client);
            $em->flush();
        }

        return $this->render('hotel/client_create.html.twig', [
            'client_form' => $clientForm->createView()
        ]);
    }

    /**
     * @Route("/reservation", name="create_reservation")
     */
    public function createReservation(Request $request) {
        $reservation = new Reservation();
        $reservationForm = $this->createForm(ReservationType::class, $reservation);

        $reservationForm->handleRequest($request);

        if ($reservationForm->isSubmitted() && $reservationForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($reservation);
            $em->flush();
        }

        return $this->render('hotel/create_reservation.html.twig', [
            'reservation_form' => $reservationForm->createView()
        ]);
    }

    /**
     * @Route("/foodorder", name="create_food_order")
     */
    public function createFoodOrder(Request $request) {
        $foodOrder = new FoodOrder();
        $foodOrderForm = $this->createForm(FoodOrderType::class, $foodOrder);

        $foodOrderForm->handleRequest($request);

        if ($foodOrderForm->isSubmitted() && $foodOrderForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //dd($request);

            foreach ($request->request->get('food_order')['food'] as $foodId) {
                $food = $this->getDoctrine()->getRepository(Food::class)->find($foodId);

                $food->addFoodOrder($foodOrder);

                $foodOrder->addFood($food);

                $em->persist($food);
            }

            foreach ($request->request->get('food_order')['hotels'] as $hotelId) {
                $hotel = $this->getDoctrine()->getRepository(Hotel::class)->find($hotelId);

                $hotel->addFoodOrder($foodOrder);

                $foodOrder->addHotel($hotel);

                $em->persist($hotel);
            }

            $em->persist($foodOrder);
            $em->flush();
        }

        return $this->render('hotel/create_food_order.html.twig', [
            'food_order_form' => $foodOrderForm->createView()
        ]);
    }

    /**
     * @Route("/food", name="create_food")
     */
    public function createFood(Request $request) {
        $food = new Food();
        $foodForm = $this->createForm(FoodType::class, $food);

        $foodForm->handleRequest($request);

        if ($foodForm->isSubmitted() && $foodForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //dd($request);

            foreach ($request->request->get('food')['foodIngridients'] as $ingrId) {
                $ingr = $this->getDoctrine()->getRepository(FoodIngridients::class)->find($ingrId);

                $ingr->addFood($food);

                $food->addFoodIngridient($ingr);

                $em->persist($ingr);
            }

            $em->persist($food);
            $em->flush();
        }

        return $this->render('hotel/create_food.html.twig', [
            'food_form' => $foodForm->createView()
        ]);
    }

    /**
     * @Route("/foodingridients", name="food_ingridients")
     */
    public function createIngridient(Request $request) {
        $ingridient = new FoodIngridients();
        $ingrForm = $this->createForm(FoodIngridientsType::class, $ingridient);

        $ingrForm->handleRequest($request);

        if ($ingrForm->isSubmitted() && $ingrForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($ingridient);
            $em->flush();
        }

        return $this->render('hotel/food_ingridients.html.twig', [
            'food_ingridients_form' => $ingrForm->createView()
        ]);
    }

    /**
     * @Route("/ingridientsorder", name="create_ingridients_order")
     */
    public function createIngridientOrder(Request $request) {
        $order = new IngridientsOrder();
        $orderForm = $this->createForm(IngridientOrderType::class, $order);

        $orderForm->handleRequest($request);

        //dd($request);

        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($request->request->get('ingridient_order')['foodIngridients'] as $ingrId) {
                $ingr = $this->getDoctrine()->getRepository(FoodIngridients::class)->find($ingrId);

                $ingr->addIngridientsOrder($order);
                $order->addFoodIngridient($ingr);

                $em->persist($ingr);
            }

            $em->persist($order);
            $em->flush();
        }

        return $this->render('hotel/ingridients_order.html.twig', [
           'order_form' => $orderForm->createView()
        ]);
    }
}
