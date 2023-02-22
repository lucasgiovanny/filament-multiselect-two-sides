# Filament Multiselect Two Sides

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lucasgiovanny/filament-multiselect-two-sides.svg?style=flat-square)](https://packagist.org/packages/lucasgiovanny/filament-multiselect-two-sides)
[![Total Downloads](https://img.shields.io/packagist/dt/lucasgiovanny/filament-multiselect-two-sides.svg?style=flat-square)](https://packagist.org/packages/lucasgiovanny/filament-multiselect-two-sides)


This package is a Filament package that allows you to create a multiselect with two sides.

![Example of Filament Multiselector Two Sides](example.png)


## Installation

You can install the package via composer:

```bash
composer require lucasgiovanny/filament-multiselect-two-sides
```

Optionally, you can publish the translations:

```bash
php artisan vendor:publish --tag="filament-multiselect-two-sides-translations"
```

## Usage

```php
use LucasGiovanny\FilamentMultiselectTwoSides\Forms\Components\Fields\MultiselectTwoSides;

return $form
    ->schema([
        MultiselectTwoSides::make('roles')
            ->options([
                'admin'   => 'Admin',
                'manager' => 'Manager',
                'user'    => 'User',
            ]),
    ]);

```

### Setting labels

```php
MultiselectTwoSides::make('roles')
    ->options([
        
        'admin'   => 'Admin',
        'manager' => 'Manager',
        'user'    => 'User',
    ]
    ])
    ->selectableLabel('Available Roles')
    ->selectedLabel('Selected Roles'),
```

### Enabling the search

By default, the search is disabled. To enable it, use the `enableSearch` method.

```php
MultiselectTwoSides::make('roles')
    ->options([
        'admin'   => 'Admin',
        'manager' => 'Manager',
        'user'    => 'User',
    ])
    ->enableSearch(),
```

### Setting the default selected options

```php
MultiselectTwoSides::make('roles')
    ->options([
        'admin'   => 'Admin',
        'manager' => 'Manager',
        'user'    => 'User',
    ])
    ->default(['admin', 'manager']),
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lucas Giovanny](https://github.com/lucasgiovanny)
- [Léo França](https://github.com/leoarkiteto)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
