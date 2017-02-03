<?php
namespace Devschool\AdminBundle\Controller;

use Devschool\FilmBundle\Entity\Realisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Devschool\AdminBundle\Form\RealisateurType;

/**
 * @Route("/admin/realisateur")
 */
class AdminGenreController extends Controller
{
    /**
     * @Route("/ajout")
     */
    public function addAction()
    {
        $realisateur = new Realisateur(); //on crée un nouveau Genre vide
        $form = $this->createForm(RealisateurType::class, $realisateur); //on le lie à un formulaire de type GenreType

        $form->handleRequest($request); //on lie le formulaire à la requête HTTP

        if ($form->isSubmitted() && $form->isValid()) { //si le formulaire a bien été soumis et qu'il est valide
            $genre = $form->getData(); //on crée un objet Genre avec les valeurs du formulaire soumis

            $em = $this->getDoctrine()->getManager(); //on récupère le gestionnaire d'entités de Doctrine

            $em->persist($genre); //on s'en sert pour enregistrer le genre (mais pas encore dans la base de données)

            $em->flush(); //écriture en base de toutes les données persistées

            return $this->redirectToRoute('admin_realisateur_liste'); //puis on redirige l'utilisateur vers la page des genres
        }

        return $this->render(
            'DevschoolAdminBundle:Realisateur:form.html.twig',
            ['form' => $form->createView()]
        );
    }

}