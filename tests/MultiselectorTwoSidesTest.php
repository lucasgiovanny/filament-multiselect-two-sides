<?php

use LucasGiovanny\FilamentMultiselectTwoSides\Forms\Components\Fields\MultiselectTwoSides;

it('can enable search', function () {
    $field = MultiselectTwoSides::make('multi-select')
                ->enableSearch();

    expect($field->searchable)
        ->toBeTrue();
});

it('can set selectable label', function () {
    $newLabel = 'New label';
    $field = MultiselectTwoSides::make('multi-select')
                ->selectableLabel($newLabel);

    expect($field->getSelectableLabel())
        ->toBe($newLabel);
});

it('can set selected label', function () {
    $newLabel = 'New label';
    $field = MultiselectTwoSides::make('multi-select')
                ->selectedLabel($newLabel);

    expect($field->getSelectedLabel())
        ->toBe($newLabel);
});
