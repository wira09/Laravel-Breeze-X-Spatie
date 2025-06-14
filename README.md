# Tutorial Laravel Breeze x Spatie Laravel Permission (Wira Teknologi)

Tutorial ini membahas cara mengintegrasikan Laravel Breeze dengan Spatie Laravel Permission untuk membuat sistem autentikasi dan manajemen role & permission di Laravel.

---

## 1. Instalasi Laravel

```bash
composer create-project laravel/laravel laravel-spatie
cd laravel-spatie
```

## 2. Instalasi Laravel Breeze

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

## 3. Instalasi Spatie Laravel Permission

```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

## 4. Setup Model User

Tambahkan trait `HasRoles` pada model `User`:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    // ...
}
```

## 5. Seeder Role & Permission

Buat seeder untuk role dan permission:

```php
php artisan make:seeder RolePermissionSeeder
```

Contoh isi seeder:

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Role::create(['name' => 'admin']);
Role::create(['name' => 'penulis']);
Permission::create(['name' => 'lihat-tulisan']);

$admin = User::find(1);
$admin->assignRole('admin');
$admin->givePermissionTo('lihat-tulisan');
```

Jalankan seeder:

```bash
php artisan db:seed --class=RolePermissionSeeder
```

## 6. Registrasi Middleware

Di `AppServiceProvider.php` method `boot()`:

```php
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

public function boot()
{
    Route::aliasMiddleware('role', RoleMiddleware::class);
    Route::aliasMiddleware('permission', PermissionMiddleware::class);
    Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
}
```

## 7. Proteksi Route

```php
Route::get('/admin', function () {
    return 'Admin Page';
})->middleware(['auth', 'role:admin']);

Route::get('/penulis', function () {
    return 'Penulis Page';
})->middleware(['auth', 'role:penulis']);

Route::get('/tulisan', function () {
    return 'Tulisan';
})->middleware(['auth', 'role_or_permission:lihat-tulisan|admin'])->name('tulisan');
```

## 8. Custom Error 403

Buat file `resources/views/errors/403.blade.php` untuk tampilan error akses.

---

Selesai! Anda sudah berhasil mengintegrasikan Laravel Breeze dengan Spatie Laravel Permission dan selebihnya bisa anda download di [sini](https://drive.google.com/file/d/1flNdy6IbqYeMmV3fKHbroz69pL_JHj3b/view?usp=sharing).

Referensi: [santrikoding.com](https://santrikoding.com/tutorial/laravel-breeze-spatie-laravel-permission) & [dirumahrafif](https://youtu.be/gny17Yln1Nw?si=4B1kngYqWhcSI5ih)
