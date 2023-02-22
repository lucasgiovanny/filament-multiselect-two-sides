<?php

namespace LucasGiovanny\FilamentMultiselectTwoSides\Forms\Components\Fields;

use Filament\Forms\Components\Select;

class MultiselectTwoSides extends Select
{
    protected string $view = 'filament-multiselect-two-sides::forms.components.fields.multiselect-two-sides';

    public ?string $selectableLabel;

    public ?string $selectedLabel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->multiple();
        $this->setSelectableLabel(__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.label'));
        $this->setSelectedLabel(__('filament-multiselect-two-sides::filament-multiselect-two-sides.selected.label'));
    }

    public function setSelectableLabel(string $label): self
    {
        $this->selectableLabel = $label;

        return $this;
    }

    public function getSelectableLabel(): string
    {
        return $this->selectableLabel;
    }

    public function setSelectedLabel(string $label): self
    {
        $this->selectedLabel = $label;

        return $this;
    }

    public function getSelectedLabel(): string
    {
        return $this->selectedLabel;
    }
}
