<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\AdType;
use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\AdRepository;
use App\Repository\ReservationRepository;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo, Request $request)
    {
        /** 
         * extraire tous les donnée de la DB et stocké dans $ads
         * ads utilisé dans twig
         */
      /*  $ads = $repo->findAll();*/

      $data = new SearchData();
      $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
      $ads = $repo->findSearch($data);
       

        return $this->render('ad.html.twig', [
            'ads' => $ads,
            
        ]);
    }

    /**
 * permet d'ajouter une nouvelle specialité pour le medecin accessible au medecin
 * @Route("admin/ads/new/BySuper/user/{slug}", name="ads_create_BySuper")
 * @IsGranted("ROLE_ADMIN")
 */
// public function createAdBySuper(Request $request, User $user, EntityManagerInterface  $manager){

    
//     $user->getFirstname();
//     $user->getLastname();
//     $user->getHash();
//     $user->getTelephone();
    

//     $ad = new Ad(); 
//     $form = $this->createForm(AdType::class, $ad);
//     $form->handleRequest($request);

   
//     if($form->isSubmitted() && $form->isValid()){

//         foreach($ad->getExpertises() as $expertise){
//             $expertise->setAd($ad);
//             $manager->persist($expertise);
//         }

//         foreach($ad->getDiplomes() as $diplome){
//             $diplome->setAd($ad);
//             $manager->persist($diplome);
//         }
//         //$ad->setAuthor($this->getUser());
        
//         $manager->persist($ad);
//         $manager->flush();

 
//         $this->addFlash(
//             'success',
//             "L'annonce <strong>{$ad->getName()}</strong> a bien été ajouté !"
//         );

//         return $this->redirectToRoute('ads_show',[
//             'slug' => $ad->getSlug()
//         ]);
//     }

//     return $this->render('dashboard/newadBySuper.html.twig',[
//         'form' => $form->createView(),
//         'ad' => $ad,
//         'email' => $user->getEmail(),
//         'hash' => $user->getHash()
//     ]);
// } 

/**
 * permet d'ajouter une nouvelle specialité pour le medecin accessible au medecin
 * @Route("admin/ads/new", name="ads_create")
 * @IsGranted("ROLE_ADMIN")
 */
// public function createad(Request $request, EntityManagerInterface  $manager){
//     $ad = new Ad(); 
//     $form = $this->createForm(AdType::class, $ad);
//     $form->handleRequest($request);

   
//     if($form->isSubmitted() && $form->isValid()){
//         foreach($ad->getExpertises() as $expertise){
//             $expertise->setAd($ad);
//             $manager->persist($expertise);
//         }

//         foreach($ad->getDiplomes() as $diplome){
//             $diplome->setAd($ad);
//             $manager->persist($diplome);
//         }
//         //$ad->setAuthor($this->getUser());

//         $manager->persist($ad);
//         $manager->flush();

 
//         $this->addFlash(
//             'success',
//             "L'annonce <strong>{$ad->getName()}</strong> a bien été ajouté !"
//         );

//         return $this->redirectToRoute('ads_show',[
//             'slug' => $ad->getSlug()
//         ]);
//     }
   
//     return $this->render('dashboard/newad.html.twig',[
//         'form' => $form->createView(),
//         'ad' => $ad
//     ]);
// }

    /**
     * Afficher les ads d'un user connecter
     * 
     * @Route("/user/{slug}", name="user_ad")
     */
    // public function adperuser(User $user, PatientRepository $PatientRepo,ReservationRepository $ReservationRepo, AdRepository $AdRepo){

        
    //     $patient = $PatientRepo->findBy(["user"=>$user->getId()]);
    //     $titre = "";
    //     if(!$patient){
    //         $titre = "Statistique";
    //     }else{
    //         $titre = "Mes réservations";
    //     }

    //     $reservations = $ReservationRepo->findBy(["patient"=>$patient]);
    //     $ad = $AdRepo->findOneBy(["email" => $user->getEmail()]);
    //     return $this->render('dashboard/account/mesad.html.twig',[
    //         'user' => $user,
    //         'reservations' => $reservations,
    //         'titre' => $titre,
    //         'ad' => $ad
    //     ]); 
    // }

/**
 * editer le l'ads du medecin accessible par le medecin
 * @ParamConverter("Ad", options={"id" = "slug"})
 * @Route("/ads/{slug}/edit", name="edit_ad")
 * @return Response
 */
// public function editad(Ad $ad, Request $request, EntityManagerInterface  $manager) {

//     $form = $this->createForm(AdType::class,$ad);
//     $form->handleRequest($request);
    
//     if($form->isSubmitted() && $form->isValid()){

//         foreach($ad->getExpertises() as $expertise){
//             $expertise->setAd($ad);
//             $manager->persist($expertise);
//         }

//         foreach($ad->getDiplomes() as $diplome){
//             $diplome->setAd($ad);
//             $manager->persist($diplome);
//         }
        
//         $manager->persist($ad);
//         $manager->flush();

 

//         return $this->redirectToRoute('ads_show',[
//             'slug' => $ad->getSlug(),
//         ]);
//     }
    
//    return $this->render('dashboard/editad.html.twig',[
//        'form' => $form->createView(),
//        'ad' => $ad,
//        'titre' => "Modifier votre profile"
//    ]); 
// }



/**
 * @ParamConverter("Ad", options={"id" = "slug"})
 * @Route("/ads/{slug}", name="ads_show")
 */
    public function show(Ad $ad)
    {

        return $this->render('show.html.twig',[
            "ad" => $ad
        ]);
    }

     /**
     * permet de supprimer un user
     * @Route("/{slug}/deleteads", name="delete_ads_register")
     */
    // public function deleteads(Ad $ads, EntityManagerInterface $manager)
    // {
        
        
    //     $manager->remove($ads);
    //     $manager->flush();
    //     $this->addFlash(
    //         'success',
    //         "le compte a bien été supprimé !"
    //     );
    //     return $this->redirectToRoute('admin_ad_index');
    // }

}


