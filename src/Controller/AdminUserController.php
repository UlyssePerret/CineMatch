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
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AbstractController
{
    
    /**
     * @Route("/admin/user/list", name="admin_user")
     * @IsGranted("ROLE_ADMIN")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository)
    {
        
        // SELECT * FORM user
        $users = $userRepository->findAll();

        return $this->render('admin_user/index.html.twig', [
            'controller_name' => 'AdminUserController',
            'users' => $users
        ]);
    }
    /**
     * @Route("/admin/user/adduser", name="adduser")
     * @Route("/admin/user/edituser/{id}", name="edituser")
     * @IsGranted("ROLE_ADMIN")
     * @param Request                      $request
     * @param ObjectManager                $objectManager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function adduser(
        Request $request,
        ObjectManager $objectManager,
        UserPasswordEncoderInterface $encoder,
        User $user = null
    ){
        if($user === null){
            $user = new User();
        }
        $inscriptionForm = $this->createForm(InscriptionFormType::class, $user);
        $inscriptionForm->handleRequest($request);


        // si le formulaire a été envoyé et qu'il est valide
        if ($inscriptionForm->isSubmitted() && $inscriptionForm->isValid()) {
            // on encode le mot de passe avant d'ajouter l'utilisateur en base
            $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);

            // on ajoute l'utilisateur à la base
            $objectManager->persist($user);
            $objectManager->flush();
            // on envoie un message de confirmation de création de compte
            $this->addFlash('success', 'Votre compte a bien été créé !');
    // on redirige l'utilisateur vers le formulaire de connexion
                return $this->redirectToRoute('admin_user');
            }
            return $this->render('admin_user/adduser.html.twig',[
                'ajoutermembre'=>$inscriptionForm->createView(),
            ]);
        }
    
}

