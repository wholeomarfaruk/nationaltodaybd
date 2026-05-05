<?php

namespace App\Livewire;

use App\Models\Ad;
use Livewire\Component;

class Ads extends Component
{
    public $status;

    public $ads;
    public $search='';
    public $date_from;
    public $date_to;



    public function render()
    {
        $query = Ad::query();
        $search = $this->search;
        if ($this->search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
            });
        }

        if ($this->status && $this->status == 'active') {
            $query->where('status', 1);
        }
        if ($this->status && $this->status == 'inactive') {
            $query->where('status', 0);
        }
        if ($this->status && $this->status == 'expired') {
            $query->whereDate('expire_at', '<', now());
        }

        if ($this->date_from && $this->date_to) {
//   dd('here');
            $formatDateFrom = date('Y-m-d', strtotime($this->date_from));
            $formatDateTo = date('Y-m-d', strtotime($this->date_to));
            $query->whereDate('updated_at', '>=', $formatDateFrom)
                  ->whereDate('updated_at', '<=', $formatDateTo);
        }

        $this->ads = $query->get();



        return view('livewire.ads');
    }

}
