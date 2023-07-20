<?php

namespace App\Controller;

use App\Service\EpisodePicker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'main.')]
class MainController extends AbstractController
{
    private const TEXT_COLOR_CLASS_NAMES = [
        'text-danger',
        'text-success',
        'text-info',
        'text-warning'
    ];

    public function __construct(
        private readonly EpisodePicker $episodePicker
    ) {
    }

    #[Route(path: '', name: 'random_episode')]
    public function getRandomEpisode(): Response
    {
        $episodeDto = $this->episodePicker->getRandomEpisode();

        return $this->render('episode.html.twig', [
            'episode' => $episodeDto,
            'randomTextColor' => self::TEXT_COLOR_CLASS_NAMES[array_rand(self::TEXT_COLOR_CLASS_NAMES)]
        ]);
    }
}
