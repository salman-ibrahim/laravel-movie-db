<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Symfony\Component\HttpFoundation\Response;

class IndexViewModel extends ViewModel
{
    private $popularMovies;
    private $nowPlaying;
    private $genres;

    public function __construct($popularMovies, $nowPlaying, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlaying()
    {
        return $this->formatMovies($this->nowPlaying);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    /**
     * @return mixed
     */
    private function formatMovies($movies)
    {

        return collect($movies)->map(function ($movie){

            $movieGenres = collect($movie['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            $releaseDate = isset($movie['release_date']) ? Carbon::parse($movie['release_date'])->format('M d, Y') : "To Be Announced";

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => $releaseDate,
                'genres' => $movieGenres,
            ])->only([
                'poster_path', 'id', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }
}
