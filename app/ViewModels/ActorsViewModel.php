<?php

namespace App\ViewModels;

use ReflectionMethod;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    private $popularActors;
    private $page;

    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors(){

        return collect($this->popularActors)->map(function ($actor){

            $actorProfile = $actor['profile_path']
                ? 'https://image.tmdb.org/t/p/w235_and_h235_face'.$actor['profile_path']
                : 'https://ui-avatars.com/api/?size=235&name='.$actor['name'];

            return collect($actor)->merge([
                'profile_path' => $actorProfile,
                'known_for' => collect($actor['known_for'])->where('media_type','movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type','tv')->pluck('name')
                )->implode(', '),
            ])->only([
                'id', 'name','profile_path','known_for'
            ]);
        });

    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }

}
