<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DriverController extends AbstractController
{
    
    #[Route('/drivers', name: 'drivers')]
    public function index(): Response
    {
        // Effectuer une requête HTTP pour récupérer les données de l'API
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.openf1.org/v1/drivers');
    
        // Vérifier si la requête a réussi
        if ($response->getStatusCode() === 200) {
            // Convertir les données JSON en tableau PHP
            $drivers = $response->toArray();
            
            // Limiter le nombre de pilotes à 30
            $limitedDrivers = array_slice($drivers, 0, 30);
    
            // Passer les données limitées à la vue pour l'affichage
            return $this->render('driver/index.html.twig', [
                'drivers' => $limitedDrivers,
            ]);
        } else {
            // Gérer les erreurs de requête
            return new Response('Erreur lors de la récupération des données de l\'API', $response->getStatusCode());
        }
    }
}
