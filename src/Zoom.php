<?php


namespace App;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Zoom
{

    protected $mailer;
    protected $templating;


    public function __construct(ContainerInterface $container, \Swift_Mailer $mailer)
    {
        $this->container = $container;
        $this->mailer = $mailer;

    }

    static function generateZoomToken($ZOOM_API_KEY,$ZOOM_API_SECRET)
    {
        $key = $ZOOM_API_KEY;
        $secret = $ZOOM_API_SECRET;
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+10 minute'),
        ];
        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }


    function  sendMail($clientmail,$docmail,$data)
    {
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 587,'TLS'))
        ->setUsername("doclife51@gmail.com")
        ->setPassword("bwlyhcgwvjiraxtv");

        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $date = new \DateTime("$data->start_time");
        $date->modify("+60 minutes");
        $zoomStartDate = $date->format('d-m-Y')."  ".$date->format('H:i:s');
        $message = (new \Swift_Message('Docrapide réservation'))
            ->setFrom(['contact@docrapide.ma' => 'Docrapide'])
            ->setTo([$docmail,$clientmail])
            ->setBody( '<html>' .
                ' <head></head>' .
                ' <body>' .
                ' Bonjour <br>' .
                'merci d\'avoir choisi notre platforme <b>docrapide.ma</b> <br>'.
                '<a href="'.$data->join_url.'">Cliquez ici pour rejoindre la réunion sur zoom .</a> <br>'.
                'Si un mots de passe vous a était demandé pour rejoindre le meet veillez saisir  <b>'.$data->password.'</b><br>'.
                'on vous rappel que vous avez pris un rendez-vous pour le  <b>'.$zoomStartDate.'</b>'.
                ' </body>' .
                '</html>',
                'text/html');

        // Send the message
        $mailer->send($message);
    }
   
   
   
    static function createZoomMeeting($startDate,$duration,$docmail,$clientmail,$key,$secret,HttpClientInterface $client)
    {
        $request = Request::createFromGlobals();

        $key = $_ENV['ZOOM_API_KEY'];
        $secret = $_ENV['ZOOM_API_SECRET'];

        $response = $client->request('POST', 'https://api.zoom.us/v2/users/me/meetings',
            [
                'headers' => [
                    "Authorization" => "Bearer". Zoom::generateZoomToken($key,$secret)
                ],
                'json' => [
                    "topic" => "docLife meet",
                    "type" => 2,
                    "start_time" => $startDate,
                    "duration" => "".$duration,
                    "password" => "123456"
                    ,"settings"=>
                        [
                            "join_before_host"=> "true",
                        ]
                ],
            ]);



        $data = json_decode($response->getContent());
        if($data != null and $data->join_url != null)
        {
            
            Zoom::sendMail($clientmail,$docmail,$data);
            return $data;
        }


        return $data;
        //in that place we must handel the error using a code and a message
        //exit("Probleme with Zome api");


    }





}
