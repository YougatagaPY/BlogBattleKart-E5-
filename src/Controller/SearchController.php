<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\ArticleRepository;


class SearchController extends AbstractController
{
    // Affiche une barre de recherche
    public function searchBar(): Response
    {
        $form = $this->createFormBuilder(null)
            ->setAction($this->generateUrl('app_leresult'))
            ->setMethod('GET')  // Utilisation de la méthode GET
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ])
            ->getForm();

        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/lereesult', name: 'app_leresult')]
    public function Leresult(Request $request, ArticleRepository $repo): Response
    {
        // Récupération de toutes les données de requête
        $formData = $request->query->all();

        // Extraction du terme de recherche du tableau 'form'
        $query = isset($formData['form']['query']) ? $formData['form']['query'] : '';

        $articles = [];

        // Effectuer la recherche si un terme de recherche est fourni
        if ($query) {
            $articles = $repo->ShowSeach($query);
        }

        // Rendu de la vue avec les articles trouvés et le terme de recherche
        return $this->render('search/index.html.twig', [
            'articles' => $articles,
            'query' => $query
        ]);
    }
    
}
