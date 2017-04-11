<?php

// src/PB/BookingBundle/Controller/BookingController.php

namespace PB\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use PB\BookingBundle\Entity\Booking;
use PB\BookingBundle\Form\BookingType;

class BookingController extends Controller {

    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $listBookings = $em->getRepository('PBBookingBundle:Booking')->findAll();

        return $this->render('PBBookingBundle:Booking:index.html.twig', array(
            'listBookings' => $listBookings
        ));
    }

    public function viewAction($id) {

        $booking = $this->getDoctrine()->getManager()->getRepository('PBBookingBundle:Booking')->find($id);

        if ($booking === null) {
            throw new NotFoundHttpException("La réservation d'id ".$id." n'existe pas.");
        }

    	return $this->render('PBBookingBundle:Booking:booking.html.twig', array(
    		'booking' => $booking
    	));
    }

    public function addAction(Request $request) {

    	$booking = new Booking();

    	$form = $this->createForm(BookingType::class, $booking);

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

			$em = $this->getDoctrine()->getManager();
            $booking->setUser($this->getUser());
			$em->persist($booking);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Réservation enregistrée.');

            return $this->redirectToRoute('pb_booking_view', array('id' => $booking->getId()));
		}

    	return $this->render('PBBookingBundle:Booking:add.html.twig', array(
    		'form' => $form->createView()
    	));

    }

	public function editAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('PBBookingBundle:Booking')->find($id);

        if ($booking === null) {
            throw new NotFoundHttpException("La réservation d'id ".$id." n'existe pas.");
        }

        $form = $this->createForm(BookingType::class, $booking);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $booking->setAccepted(null);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Réservation modifiée.');

            return $this->redirectToRoute('pb_booking_view', array('id' => $booking->getId()));
        }

    	return $this->render('PBBookingBundle:Booking:edit.html.twig', array(
    		'form' => $form->createView()
    	));
    }

    public function cancelAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('PBBookingBundle:Booking')->find($id);

        if ($booking === null) {
            throw new NotFoundHttpException("La réservation d'id ".$id." n'existe pas.");
        }

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->remove($booking);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Réservation annulée.');

            return $this->redirectToRoute('pb_booking_home');
        }

    	return $this->render('PBBookingBundle:Booking:cancel.html.twig', array(
    		'booking' => $booking,
            'form' => $form->createView()
    	));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function validateAction($id) {

        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('PBBookingBundle:Booking')->find($id);
        $booking->setAccepted(true);
        $em->flush();

        return $this->redirectToRoute('pb_booking_home');
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function refuseAction($id) {

        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('PBBookingBundle:Booking')->find($id);
        $booking->setAccepted(false);
        $em->flush();

        return $this->redirectToRoute('pb_booking_home');
    }
}