<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    private $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie(){

        $movieTrailer = count($this->movie['videos']['results']) > 0 ? ('https://www.youtube.com/embed/'. $this->movie['videos']['results'][0]['key']) : false;

        $movieImages = collect($this->movie['images']['backdrops'])
            ->map(function ($image){
            return 'https://image.tmdb.org/t/p/original/'.$image['file_path'];
        })->take(9);

        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500'. $this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'trailer' => $movieTrailer,
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(5),
            'screens' => $movieImages,
        ])->only([
            'poster_path','vote_average','title','genres','release_date','overview','trailer','crew','cast','screens',
        ]);
    }
}
