<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\AdRepository;
use App\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AdRepository $repo, Request $request)
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $ads = $repo->findSearch($data);


        if($form->isSubmitted()){
            
            return $this->render('ad.html.twig', [
                'ads' => $ads
            ]);
            }
        return $this->render('home.html.twig', [
            'ads' => $ads,
            'form' => $form->createView()
        ]);
    }

   


     //create a api to show the ads in json format after search in the form in  home page 

    /**
     * @Route("/api/ads", name="api_ads")
     */ 
//     public function apiAds(AdRepository $repo, Request $request)    
//     {
//         $data = new SearchData();
//         $form = $this->createForm(SearchType::class, $data);
//         $form->handleRequest($request);
//         $ads = $repo->findSearch($data); 

//         $data=array();
//         foreach ($ads as $key => $ad) {
//             $data[$key]['id']=$ad->getId();
//             $data[$key]['id_Article']=$ad->getArticle()->getId();
//             $data[$key]['Description']=$ad->getDescription();
//         }
    
//         return new JsonResponse($ads);
    
// }
      //create an api with get method to show the ads in json format after search in the form in  home page
    /**
     * 
     * @Route("/api/ads", name="api_ads")
     */
    public function apiAds(AdRepository $repo, Request $request)
    {
        $ads = $repo ->findAll();
        $dataAds = array();
        foreach ($ads as $key => $ad) {
            $dataAds[$key]['lat'] = $ad->getLat();
            $dataAds[$key]['longi'] = $ad->getLongi();
            
        }

        return new JsonResponse($dataAds);
    }

    /**
     * @Route("/tester" , name = "test" , methods={"GET"} )
     */
    public function test (RoleRepository $repo) {

        $data = $repo->findAll();
        

        return new JsonResponse($data);


    }

    /**
     * @Route("/ajax/apiAds" , name = "apiAds" , methods={"GET"} )
     */
    public function apiiAds(AdRepository $repo, Request $request): Response
    {
        $ads = $repo->findAll();
        $dataAds = array();
        foreach ($ads as $key => $ad) {
            $dataAds[$key]['lat'] = $ad->getLat();
            $dataAds[$key]['longi'] = $ad->getLongi();
            
        }
        $response = new Response();
        $response->setContent(json_encode($dataAds));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}