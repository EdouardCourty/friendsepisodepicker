<?php

namespace App\Controller;

use App\Service\EpisodePicker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'main.')]
class MainController extends AbstractController
{
    public function __construct(
        private readonly EpisodePicker $episodePicker
    ) {
    }

    #[Route(path: 'random', name: 'random_episode')]
    public function getRandomEpisode(): Response
    {
        $episodeDto = $this->episodePicker->getRandomEpisode();

        return $this->render('episode.html.twig', [
            'episode' => $episodeDto
        ]);
    }
}
