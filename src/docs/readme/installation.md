- [About](about.md)
- [Installation](installation.md)

#### Installation
-----------------
- Install the package using composer

```bash
composer require mgcodeur/laravel-api-auth-master
```

- Install

```bash
php artisan mg-auth:install
```

- Migrate the database

```bash
php artisan migrate
```

#### In your Auth Model :
-----------------
- Add the following trait to your model

```php
use Mgcodeur\LaravelApiAuthMaster\Traits\Models\AuthMasterTrait
```

- Add the following fields to fillable array

```php
protected $fillable = [
    --//--,
    'first_name',
    'last_name',
];
```

#### NB : password field is automatically hashed by the package using the Hash facade
