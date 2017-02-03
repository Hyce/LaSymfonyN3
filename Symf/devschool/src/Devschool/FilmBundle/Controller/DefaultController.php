<?php

namespace Devschool\FilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="page_accueil")
     */
    public function indexAction()
    {
        return $this->render('DevschoolFilmBundle:Default:index.html.twig');
    }

    /**
     * @Route("/films", name="page_films")
     */
    public function listAction()
    {

        $films = $this->getDoctrine()->getRepository('DevschoolFilmBundle:Film')->findAll();

        $titre_de_la_page = 'Films de la bibliothèques';

        return $this->render(
            'DevschoolFilmBundle:Film:list.html.twig',
            ['films' => $films]
        );
    }

    /**
     * @Route("/film/{id}", requirements={"id": "\d+"}, name="page_livre")
     */
    public function showAction($id)
    {
        $film = $this->getDoctrine()->getRepository('DevschoolFilmBundle:Film')->find($id);

        return $this->render(
            'DevschoolFilmBundle:Film:show.html.twig',
            ['film' => $film]
        );
    }
}
