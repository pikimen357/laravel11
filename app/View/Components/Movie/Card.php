<?php

namespace App\View\Components\Movie;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */

    public $index;
    public $title;
    public $image;
    public $releasedate;
    public $isOld;
    public $isTrend;

    public function  __construct($index, $title, $image, $releasedate)
    {
        $this->index = $index;
        $this->title = $title;
        $this->image = $image;
        $this->releasedate = $releasedate;

    }

    private function isValid(): bool{
        return $this->title /* && $this->image */ && $this->releasedate;
    }

    public function getImage(): string{
        if($this->image){
            return $this->image;
        }
        return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOuAMhrK77mWnEemaIkbEAEwXB76KPONRVCw&s';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        if(!$this->isValid()){

            return '';

        } else {

            $carbonDate = Carbon::parse($this->releasedate);
            $this->isOld = $carbonDate->year < 2010;
            $this->isTrend = $carbonDate->year === Carbon::now()->year;

            //  uppercase title only when year >= 2000
            $this->title = $this->isOld ? $this->title : Str::upper($this->title);

            $this->releasedate = $carbonDate->format('d M, Y');
        }

        return view('components.movie.card');
    }
}
