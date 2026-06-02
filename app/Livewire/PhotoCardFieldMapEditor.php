<?php

namespace App\Livewire;

use App\Models\PhotoCardFieldMap;
use App\Models\PhotoCardTemplate;
use Livewire\Component;

class PhotoCardFieldMapEditor extends Component
{
    public $templateId;
    public $template;
    public $maps = [];
    public $allFieldKeys = [];

    public function mount($templateId)
    {
        $this->templateId = $templateId;
        $this->template = PhotoCardTemplate::findOrFail($templateId);

        $config = $this->template->config;
        $this->allFieldKeys = array_merge(
            $config['required_fields'] ?? [],
            $config['optional_fields'] ?? []
        );

        $this->loadMaps();
    }

    protected function loadMaps()
    {
        $existingMaps = PhotoCardFieldMap::where('photocard_template_id', $this->templateId)
            ->get()
            ->keyBy('field_key');

        $this->maps = [];
        foreach ($this->allFieldKeys as $key) {
            $map = $existingMaps->get($key);
            $this->maps[$key] = [
                'field_key' => $key,
                'source_type' => $map?->source_type ?? 'post_field',
                'source_value' => $map?->source_value ?? '',
            ];
        }
    }

    public function save()
    {
        foreach ($this->maps as $fieldKey => $mapData) {
            PhotoCardFieldMap::updateOrCreate(
                [
                    'photocard_template_id' => $this->templateId,
                    'field_key' => $fieldKey,
                ],
                [
                    'source_type' => $mapData['source_type'],
                    'source_value' => $mapData['source_value'],
                ]
            );
        }

        $this->dispatch('fieldMapSaved', ['success' => true]);
    }

    public function render()
    {
        $postFieldOptions = [
            'title' => 'Post Title',
            'excerpt' => 'Post Excerpt',
            'featured_image_path' => 'Featured Image',
            'category_name' => 'Category Name',
            'created_at' => 'Created Date',
        ];

        $settingOptions = [
            'site_logo' => 'Site Logo',
        ];

        return view('livewire.photo-card-field-map', [
            'postFieldOptions' => $postFieldOptions,
            'settingOptions' => $settingOptions,
            'requiredFields' => $this->template->config['required_fields'] ?? [],
        ]);
    }
}
