<?php

namespace App\Livewire;

use App\Services\CitySearchService;
use Livewire\Component;

class CitySearch extends Component
{
    public $cities = [];

    public $search_term;

    public $show_loader = false;

    public $show_results = false;

    public function searchForCity()
    {
        $service = new CitySearchService;
        
        $this->cities = $service->search($this->search_term);

        $this->show_loader = false;
        $this->show_results = true;
    }

    public function render()
    {
        return view('livewire.city-search');
    }
}
