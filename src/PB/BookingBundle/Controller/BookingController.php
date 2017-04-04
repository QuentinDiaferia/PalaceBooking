<?php

// src/PB/BookingBundle/Controller/BookingController.php

namespace PB\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use PB\BookingBundle\Entity\Booking;
use PB\BookingBundle\Form\BookingType;

class BookingController extends Controller {

    public function indexAction() {
        return $this->render('PBBookingBundle:Booking:index.html.twig');
    }

    public function viewAction($id) {
    	return $this->render('PBBookingBundle:Booking:booking.html.twig', array(
    		'id' => $id
    	));
    }

    public function addAction(Request $request) {

    	$booking = new Booking();

    	$form = $this->createForm(BookingType::class, $booking);

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			// Si on a ajouté une réservation
			$em = $this->getDoctrine()->getManager();
			$em->persist($booking);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Réservation enregistrée.');

			return $this->redirectToRoute('pb_booking_view', array('id' => $booking->getId()));
		}

    	return $this->render('PBBookingBundle:Booking:add.html.twig', array(
    		'form' => $form->createView()
    	));

    }

	public function editAction($id) {
    	return $this->render('PBBookingBundle:Booking:edit.html.twig', array(
    		'id' => $id
    	));
    }

    public function cancelAction($id) {
    	return $this->render('PBBookingBundle:Booking:cancel.html.twig', array(
    		'id' => $id
    	));
    }
}