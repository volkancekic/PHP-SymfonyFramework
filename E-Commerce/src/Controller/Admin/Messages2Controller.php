<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Messages2;
use App\Form\Admin\Messages2Type;
use App\Repository\Admin\Messages2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/messages2")
 */
class Messages2Controller extends AbstractController
{
    /**
     * @Route("/", name="admin_messages2_index", methods="GET")
     */
    public function index(Messages2Repository $messages2Repository): Response
    {
        return $this->render('admin/messages2/index.html.twig', ['messages2s' => $messages2Repository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_messages2_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $messages2 = new Messages2();
        $form = $this->createForm(Messages2Type::class, $messages2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($messages2);
            $em->flush();

            return $this->redirectToRoute('admin_messages2_index');
        }

        return $this->render('admin/messages2/new.html.twig', [
            'messages2' => $messages2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_messages2_show", methods="GET")
     */
    public function show(Messages2 $messages2, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $sql= ' UPDATE messages2 SET status="Okundu" WHERE id = :id' ;
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();

        return $this->render('admin/messages2/show.html.twig', ['messages2' => $messages2]);
    }

    /**
     * @Route("/{id}/edit", name="admin_messages2_edit", methods="GET|POST")
     */
    public function edit(Request $request, Messages2 $messages2): Response
    {
        $form = $this->createForm(Messages2Type::class, $messages2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_messages2_edit', ['id' => $messages2->getId()]);
        }

        return $this->render('admin/messages2/edit.html.twig', [
            'messages2' => $messages2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/update", name="admin_messages2_update", methods="GET|POST")
     */
    public function message2_update($id,Request $request, Messages2 $messages2): Response
    {
        $em = $this->getDoctrine()->getManager();
        $sql= ' UPDATE messages2 SET comment= :comment WHERE id = :id' ;
        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('comment', $request->request->get('comment'));
        $statement->bindValue('id', $id);
        $statement->execute();

        return $this->render('admin/messages2/show.html.twig', ['messages2' => $messages2,
            'id' => $id ]);
    }

    /**
     * @Route("/{id}", name="admin_messages2_delete", methods="DELETE")
     */
    public function delete(Request $request, Messages2 $messages2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$messages2->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($messages2);
            $em->flush();
        }

        return $this->redirectToRoute('admin_messages2_index');
    }
}
