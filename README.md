<p align="center">
  <img src="./media/logo.png" alt="Description of Image">
</p>

![Packagist License](https://img.shields.io/packagist/l/jojomak13/laravel-attributes)
![Packagist Downloads](https://img.shields.io/packagist/dd/jojomak13/laravel-attributes)
![Packagist Version](https://img.shields.io/packagist/v/jojomak13/laravel-attributes)
![Packagist Stars](https://img.shields.io/packagist/stars/jojomak13/laravel-attributes)

# Laravel Attributes

This package provides the ability to create custom attributes for Laravel controllers. You can use these attributes to add functionality like authorization, validation, or any other custom behavior to your controller methods.

## Installation

```bash
composer require jojomak13/laravel-attributes
```

## Basic Usage

Let's walk through creating a custom attribute for authorization using Laravel policies.

### Creating an Attribute

First, generate a new attribute class using the provided artisan command:

```bash
php artisan make:attribute PolicyAttribute
```

This will create a new attribute class in the `App\Attributes` namespace.

### Attribute Structure

Each attribute class contains two main methods:

1. `__construct`: Defines the parameters you want to pass to your attribute
2. `handle`: Contains the logic for your attribute's functionality

### Example Implementation

Here's an example of implementing a policy-based authorization attribute:

```php
<?php

namespace App\Attributes;

use Attribute;
use Illuminate\Support\Facades\Gate;
use Joseph\Attributes\Concerns\ICustomAttribute;

#[Attribute(Attribute::TARGET_METHOD)]
class PolicyAttribute implements ICustomAttribute
{
    public function __construct(string $ability, $arguments = [])
    {
        $this->ability = $ability;
        $this->arguments = $arguments;
    }

    public function handle(string $ability, $arguments = [])
    {
        Gate::authorize($ability, $arguments);
    }
}
```

### Using Attributes in Controllers

To use attributes in your controllers, follow these steps:

1. Import the `HasAttributes` trait
2. Import your custom attribute class
3. Add the attribute to your controller methods

Here's an example:

```php
<?php

namespace App\Http\Controllers;

use App\Attributes\PolicyAttribute;
use App\Models\Post;
use Illuminate\Routing\Controller;
use Joseph\Attributes\Traits\HasAttributes;

class PostController extends Controller
{
    use HasAttributes;

    #[PolicyAttribute('viewAny', Post::class)]
    public function index()
    {
        return 'posts here';
    }
}
```

In this example, the `PolicyAttribute` will check if the current user has permission to view posts before executing the `index` method.

## Additional Notes

- Attributes are executed before the controller method runs
- You can stack multiple attributes on a single method
- The `HasAttributes` trait is required for attribute functionality
- Custom attributes must implement the `ICustomAttribute` interface

For more advanced usage and additional examples, please refer to the [package documentation](https://github.com/jojomak13/attributes).
