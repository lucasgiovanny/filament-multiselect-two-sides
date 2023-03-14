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

it('can set id', function () {
    $name = 'test-name';
    $field = MultiselectTwoSides::make($name);

    expect($field->getNameId())
        ->toBe($name);
});

it('can set listeners', function () {
    $name = 'test-name';
    $field = MultiselectTwoSides::make($name);

    $keys = [
        "{$name}_ms-two-sides::selectOption",
        "{$name}_ms-two-sides::unselectOption",
        "{$name}_ms-two-sides::selectAllOptions",
        "{$name}_ms-two-sides::unselectAllOptions",
    ];

    expect($field->getListeners())
        ->toHaveKeys($keys);
});
