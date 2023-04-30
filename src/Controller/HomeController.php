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
//sessionInterface


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AdRepository $repo, Request $request)
    {
        $session = $request->getSession();
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $ads = $repo->findSearch($data);
        $dataAds = array();
        foreach ($ads as $key => $ad) {
            $dataAds[$key]['lat'] = $ad->getLat();
            $dataAds[$key]['longi'] = $ad->getLongi();
            $dataAds[$key]['slug'] = $ad->getId();
            $dataAds[$key]['adresse'] = $ad->getId();
        }
        

        if($form->isSubmitted()){
            // dd($ads);
            $session->set('datajson', $ads);
            return $this->render('ad.html.twig', [
                'ads' => $ads,
                'json' => json_encode($dataAds),
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
   * @Route("/searchResult", name="searchResult", methods={"GET"})
   */
   public function searchResult(AdRepository $repo, Request $request): Response
   {
    $data = new SearchData();
    $form = $this->createForm(SearchType::class, $data);
    $form->handleRequest($request);
    $ads = $repo->findSearch($data);
    dd($ads);
    $dataAds = array();
    if ($ads !== null) {
        foreach ($ads as $key => $ad) {
            $dataAds[$key]['lat'] = $ad->getLat();
            $dataAds[$key]['longi'] = $ad->getLongi();
            $dataAds[$key]['slug'] = $ad->getSlug();
            $dataAds[$key]['adresse'] = $ad->getAdresse();
            $dataAds[$key]['image'] = $ad->getImage();

        }
    }
    $response = new Response();
    $response->setContent(json_encode($dataAds));
    $response->headers->set('Content-Type', 'application/json');
    if ($form->isSubmitted()) {
        
        return $response;
    }
    return $response;

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
    /**
     * @Route("/api_search_result", name="api_search_result", methods={"GET"})
     */
    public function searchResultApi(AdRepository $repo, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $ads = $repo->findSearch($data);
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
    /**
     * @Route("/ajax-ads", name="ajax-ads", methods={"GET"})
     */
    public function ajaxtest(Request $request): Response {

        $session = $request->getSession();
        // gets an attribute by name
        $ads = $session->get('datajson');

        $dataAds = array();
        foreach ($ads as $key => $ad) {
            $dataAds[$key]['lat'] = $ad->getLat();
            $dataAds[$key]['longi'] = $ad->getLongi();
            $dataAds[$key]['slug'] = $ad->getSlug();
            $dataAds[$key]['adresse'] = $ad->getAdresse();
        }

        $response = new Response();
        $response->setContent(json_encode($dataAds));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

   
    

}

