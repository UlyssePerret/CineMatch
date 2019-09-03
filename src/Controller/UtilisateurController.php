<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionFormType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurController extends AbstractController
{

    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig');
    }

    /**
     * @Route("/utilisateur/inscription", name="inscription")
     * @param Request                      $request
     * @param ObjectManager                $objectManager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function inscription(
        Request $request,
        ObjectManager $objectManager,
        UserPasswordEncoderInterface $encoder
    )
    {
        $user = new User();
        $inscriptionForm = $this->createForm(InscriptionFormType::class, $user);
        $inscriptionForm->handleRequest($request);


// si le formulaire a été envoyé et qu'il est valide
        if($inscriptionForm->isSubmitted() && $inscriptionForm->isValid() ) {
// on encode le mot de passe avant d'ajouter l'utilisateur en base
            $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);

// on ajoute le rôle ROLE_USER à notre utilisateur
            $user->setStatut(1);
             
// on ajoute l'utilisateur à la base
            $objectManager->persist($user);
            $objectManager->flush();
            // on envoie un message de confirmation de création de compte
            $this->addFlash('success', 'Votre compte a bien été créé !');
// on redirige l'utilisateur vers le formulaire de connexion
            return $this->redirectToRoute('login');
        } else {
            $this->addFlash('danger', 'Veuillez remplir tous les champs du formulaire afin de vous inscrire !');
        }
        return $this->render('utilisateur/inscription.html.twig', [
            'inscription' => $inscriptionForm->createView(),
        ]);
    }
}

