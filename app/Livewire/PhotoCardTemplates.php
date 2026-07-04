<?php

namespace App\Livewire;

use App\Models\PhotoCardTemplate;
use App\Services\PhotoCard\PreviewGenerator;
use Livewire\Component;
use Livewire\WithPagination;

class PhotoCardTemplates extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $templates = PhotoCardTemplate::when($this->search, fn($q) =>
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('slug', 'like', '%' . $this->search . '%')
        )->latest()->paginate(10);

        return view('livewire.photo-card-templates', ['templates' => $templates]);
    }

    public function toggleActive($id)
    {
        $template = PhotoCardTemplate::find($id);

        if (!$template) {
            $this->dispatch('templateNotFound', ['error' => true]);
            return;
        }

        $template->update(['is_active' => !$template->is_active]);

        $this->dispatch('templateToggled', [
            'success' => true,
            'active' => $template->is_active,
        ]);
    }

    public function regeneratePreview($id)
    {
        $template = PhotoCardTemplate::find($id);

        if (!$template) {
            $this->dispatch('templateNotFound', ['error' => true]);
            return;
        }

        $preview = app(PreviewGenerator::class)->generate($template);

        $this->dispatch('previewRegenerated', ['success' => (bool) $preview]);
    }
}
