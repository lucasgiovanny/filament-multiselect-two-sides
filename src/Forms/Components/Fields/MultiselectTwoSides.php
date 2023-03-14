<?php

namespace LucasGiovanny\FilamentMultiselectTwoSides\Forms\Components\Fields;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;

class MultiselectTwoSides extends Select
{
    protected string $view = 'filament-multiselect-two-sides::forms.components.fields.multiselect-two-sides';

    public ?string $selectableLabel;

    public ?string $selectedLabel;

    public bool $searchable = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->multiple();
        $this->setSelectableLabel(__('filament-multiselect-two-sides::filament-multiselect-two-sides.selectable.label'));
        $this->setSelectedLabel(__('filament-multiselect-two-sides::filament-multiselect-two-sides.selected.label'));
    }

    public static function make(string $name): static
    {
        $static = parent::make($name);
        $id = $static->getNameId();

        $static->listeners = [
            "{$id}_ms-two-sides::selectOption" => [fn (Component $component, string $statePath, string $value) => $this->selectOption($value)],
            "{$id}_ms-two-sides::unselectOption" => [fn (Component $component, string $statePath, string $value) => $this->unselectOption($value)],
            "{$id}_ms-two-sides::selectAllOptions" => [fn (Component $component) => $this->selectAll()],
            "{$id}_ms-two-sides::unselectAllOptions" => [fn (Component $component) => $this->unselectAll()],
        ];

        return $static;
    }

    public function getNameId() {
        return strtolower($this->getName());
    }

    protected function setSelectableLabel(string $label): self
    {
        $this->selectableLabel = $label;

        return $this;
    }

    public function getSelectableLabel(): string
    {
        return $this->selectableLabel;
    }

    protected function setSelectedLabel(string $label): self
    {
        $this->selectedLabel = $label;

        return $this;
    }

    public function getSelectedLabel(): string
    {
        return $this->selectedLabel;
    }

    public function selectableLabel(string $label): self
    {
        return $this->setSelectableLabel($label);
    }

    public function selectedLabel(string $label): self
    {
        return $this->setSelectedLabel($label);
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    public function enableSearch(): self
    {
        $this->searchable = true;

        return $this;
    }

    public function getSelectableOptions(): array
    {
        return $options = collect($this->getOptions())
            ->diff($this->getSelectedOptions())
            ->toArray();
    }

    public function getSelectedOptions(?string $search = null): array
    {
        return collect($this->getOptions())
            ->filter(fn (string $label, string $value) => in_array($value, $this->getState()))
            ->toArray();
    }

    public function selectOption(string $value): void
    {
        $state = array_unique(array_merge($this->getState(), [$value]));
        $this->state($state);
    }

    public function unselectOption(string $value): void
    {
        $state = $this->getState();
        unset($state[array_search($value, $state)]);
        $this->state($state);
    }

    public function selectAll(): void
    {
        $this->state(array_keys($this->getOptions()));
    }

    public function unselectAll(): void
    {
        $this->state([]);
    }
}
