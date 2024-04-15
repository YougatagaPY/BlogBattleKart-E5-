<?php
// src/Controller/DriverController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use App\Form\QuizType;

class DriverController extends AbstractController
{
    #[Route('/quiz', name: 'driver_quiz')]
    public function quiz(Request $request): Response
    {
        $form = $this->createForm(QuizType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $driverNumber = $this->selectDriverBasedOnAnswers($form->getData());

            // Redirige l'utilisateur vers la page de résultat, en passant le numéro du pilote
            return $this->redirectToRoute('driver_result', ['driver_number' => $driverNumber]);
        }

        // Affiche la vue du formulaire du quiz si celui-ci n'est pas encore soumis ou est invalide
        return $this->render('driver/quiz.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function selectDriverBasedOnAnswers($answers)
    {
        return $this->determineDriverNumber($answers);
    }

    private function determineDriverNumber($answers)
{
    // Logique basée sur les réponses aux questions
    switch ($answers['color']) {
        case 'red':
            return 16; // Sebastian Vettel (Aston Martin)
        case 'blue':
            return 77; // Valtteri Bottas (Stake)
        case 'green':
            return 14; // Fernando Alonso (Aston Martin)
        case 'yellow':
            return 3; // Daniel Ricciardo (AlphaTauri)
        case 'other':
            return 55; // Carlos Sainz Jr (Ferrari)
    }

    switch ($answers['preRaceRoutine']) {
        case 'music':
            return 44; // Lewis Hamilton (Mercedes)
        case 'meditate':
            return 23; // Alex Albon (Williams)
        case 'talk_to_team':
            return 10; // Pierre Gasly (Alpine)
    }

    switch ($answers['experience']) {
        case 'experienced':
            return 1; // Max Verstappen (Red Bull)
        case 'intermediate':
            return 22; // Yuki Tsunoda (AlphaTauri)
        case 'beginner':
            return 2; // Logan Sargeant (Williams)
    }

    switch ($answers['style']) {
        case 'aggressive':
            return 1; // Max Verstappen (Red Bull)
        case 'strategic':
            return 14; // Fernando Alonso (Aston Martin)
        case 'defensive':
            return 20; // Kevin Magnussen (Haas)
    }

    switch ($answers['weather']) {
        case 'rainy':
            return 44; // Lewis Hamilton (Mercedes)
        case 'dry':
            return 16; // Charles Leclerc (Ferrari)
        case 'mixed':
            return 10; // Pierre Gasly (Alpine)
    }

    switch ($answers['track']) {
        case 'urban':
            return 55; // Carlos Sainz Jr (Ferrari)
        case 'road':
            return 63; // George Russell (Mercedes)
        case 'mixed':
            return 77; // Valtteri Bottas (Stake)
    }

    switch ($answers['engine']) {
        case 'powerful':
            return 77; // Valtteri Bottas (Stake)
        case 'balanced':
            return 16; // Charles Leclerc (Ferrari)
        case 'efficient':
            return 31; // Esteban Ocon (Alpine)
    }

    switch ($answers['tire']) {
        case 'soft':
            return 44; // Lewis Hamilton (Mercedes)
        case 'medium':
            return 77; // Valtteri Bottas (Stake)
        case 'hard':
            return 55; // Carlos Sainz Jr (Ferrari)
    }

    return 1; // Charles Leclerc (Ferrari) par défaut
}


    

    #[Route('/driver/result/{driver_number}', name: 'driver_result')]
    public function result($driver_number): Response
    {
        $driver = $this->fetchDriverFromApi($driver_number);

        if ($driver === null) {
            // Vous pouvez également ajouter une gestion d'erreur personnalisée ici
            throw $this->createNotFoundException('Pilote non trouvé.');
        }

        return $this->render('driver/result.html.twig', [
            'driver' => $driver,
        ]);
    }

    private function fetchDriverFromApi($driverNumber)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.openf1.org/v1/drivers', [
            'query' => [
                'driver_number' => $driverNumber,
                'session_key' => '9158' // Remplacez ceci par votre véritable clé de session
            ]
        ]);
    
        if ($response->getStatusCode() === 200) {
            $drivers = $response->toArray();
    
            // Vérifiez que les données retournées ne sont pas vides et que le premier élément existe
            return count($drivers) > 0 ? $drivers[0] : null;
        } else {
            // Gérer les erreurs de requête ici
            throw new \Exception('Erreur lors de la récupération des données du pilote de l\'API. Statut: ' . $response->getStatusCode());
        }
    }
    
}
