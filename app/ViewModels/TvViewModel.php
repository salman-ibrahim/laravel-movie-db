<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{

    private $popularTv;
    private $topRatedTv;
    private $genres;
    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres(): \Illuminate\Support\Collection
    {
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    /**
     * @return mixed
     */
    private function formatTv($tv)
    {

        //        return collect($tv)->map(function ($tvShows){
//            return $tvShows;
//        })->dump();

        return collect($tv)->map(function ($tv){

            $tvGenres = collect($tv['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            $firstAirDate = isset($tv['first_air_date']) ? Carbon::parse($tv['first_air_date'])->format('M d, Y') : "To Be Announced";
            return collect($tv)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $tv['poster_path'],
                'vote_average' => $tv['vote_average'] * 10 . '%',
                'first_air_date' => $firstAirDate,
                'genres' => $tvGenres,
            ])->only([
                'poster_path', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });

    }
}
