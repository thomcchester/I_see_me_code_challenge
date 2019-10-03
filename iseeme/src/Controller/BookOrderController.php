<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BookOrder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class BookOrderController extends AbstractController
{
      /**
     * @Route("/book_order_null_order_status_null_customer_service_note", name="create_book_order_null_order_status_null_customer_service_note")
     */
    public function createBookOrderNullOrderStatusNullCustomerServiceNote(): Response
    {
        //Using the entity manager to tor create for me here
        $entityManager = $this->getDoctrine()->getManager();

        $book_order = new BookOrder();
        $book_order->setOrderStatus(null);
        $book_order->setCustomerServiceNote(null);

        $entityManager->persist($book_order);

        $entityManager->flush();

        return new Response('Saved new book_order with id '.$book_order->getId());
    }

    /**
     * @Route("/book_order_error_order_status_null_customer_service_note", name="create_book_order_error_order_status_null_customer_service_note")
     */
    public function createBookOrderErrorOrderStatusNullCustomerServiceNote(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $book_order = new BookOrder();
        $book_order->setOrderStatus("error");
        $book_order->setCustomerServiceNote(null);

        $entityManager->persist($book_order);

        $entityManager->flush();

        return new Response('Saved new book_order with id '.$book_order->getId());
    }

     /**
     * @Route("/book_order_error_order_status_some_other_text_customer_service_note", name="create_book_order_error_order_status_some_other_text_customer_service_note")
     */
    public function createBookOrderErrorOrderStatusSomeOtherTextCustomerServiceNote(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $book_order = new BookOrder();
        $book_order->setOrderStatus("error");
        $book_order->setCustomerServiceNote("some other text is in here");

        $entityManager->persist($book_order);

        $entityManager->flush();

        return new Response('Saved new book_order with id '.$book_order->getId());
    }

     /**
     * @Route("/book_order_error_order_status_connection_failed_customer_service_note", name="create_book_order_error_order_status_connection_failed_customer_service_note")
     */
    public function createBookOrderErrorOrderStatusConnectionFailedCustomerServiceNote(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $book_order = new BookOrder();
        $book_order->setOrderStatus("error");
        $book_order->setCustomerServiceNote("stuff and things connection failed");

        $entityManager->persist($book_order);

        $entityManager->flush();

        return new Response('Saved new book_order with id '.$book_order->getId());
    }
    
   /**
     * @Route("/fix_statuses", name="book_orders_fix_statuses")
     */
    public function fix_statuses()
    {
        $orders = $this->getDoctrine()
            ->getRepository(BookOrder::class)
            ->findAll();

        if (!$orders) {
            throw $this->createNotFoundException(
                'did not find things '
            );
        }

        $hold_string= "";
        foreach($orders as $order){
            if ($order->getMeetsOrderApproveCriteria() == 'true'){
                $order->setOrderStatus('new');
            }
            $hold_string .= $order->getOrderStatus();
        }

        return new Response($hold_string);

    }
}
