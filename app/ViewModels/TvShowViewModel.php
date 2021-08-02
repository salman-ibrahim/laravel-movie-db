<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    private $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv(){

        $tvTrailer = count($this->tv['videos']['results']) > 0 ? ('https://www.youtube.com/embed/'. $this->tv['videos']['results'][0]['key']) : false;

        $tvImages = collect($this->tv['images']['backdrops'])
            ->map(function ($image){
                return 'https://image.tmdb.org/t/p/original/'.$image['file_path'];
            })->take(9);

        return collect($this->tv)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500'. $this->tv['poster_path'],
            'vote_average' => $this->tv['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->tv['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tv['genres'])->pluck('name')->flatten()->implode(', '),
            'trailer' => $tvTrailer,
            'crew' => collect($this->tv['credits']['crew'])->take(2),
            'cast' => collect($this->tv['credits']['cast'])->take(5),
            'screens' => $tvImages,
        ])->only([
            'poster_path','vote_average','name','genres','first_air_date','created_by','overview','trailer',
            'cast','screens',
        ]);
    }
}
