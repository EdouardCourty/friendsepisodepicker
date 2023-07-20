<?php

namespace App\Service;

use App\DTO\EpisodeDTO;
use Symfony\Component\Serializer\SerializerInterface;

readonly class EpisodePicker
{
    private string $filePath;

    public function __construct(
        private SerializerInterface $serializer,
        string $rootPath,
    ) {
        $this->filePath = $rootPath . '/data/episodes.json';
    }

    private function getRawEpisodesData(): array
    {
        $fileContent = file_get_contents($this->filePath);

        return json_decode($fileContent, true);
    }

    public function getRandomEpisode(): EpisodeDTO
    {
        $episodes = $this->getRawEpisodesData();
        $episode = $episodes[array_rand($episodes)];

        return $this->serializer->deserialize(json_encode($episode), EpisodeDTO::class, 'json');
    }
}
