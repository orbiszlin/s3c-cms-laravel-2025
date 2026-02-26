# Orbis simple CMS

## How to install

> `sail` is a command with alias `vendor/bin/sail`
> 
> **On Windows, clone the project directly inside WSL!** (For example, through the cloning feature in PhpStorm when creating a project from VCS.) There are no problems with mapping WSL and Windows folders.
> 
> If you are updating a project that we already have set up and you have added something to it, use VCS Git and the rollback function to revert the changes. This will prevent conflicts when you update the project from the repository again.

1. Install Docker
2. Install dependencies by docker & sail, you can use `--ignore-platform-reqs` if you have dependencies problems
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php84-composer:latest \
        composer install
    ```
3. Copy [.env.example](.env.example) > [.env](.env) file and setup
    - Generate key `sail artisan key:generate` (**after sail is running** - `sail up`)
4. Start app by `sail up` or `sail up -d` _(**-d** is for detached mode withot logs)_
5. Install NPM by `sail npm install`
6. Build CSS/JS assets by `sail npm run build` (or `sail npm run dev` for development)
7. Migrate user preferences `sail artisan migrate:fresh --seed` - Migrate all data with seeder

## Code generators

> **Generators** are separately libraries installed as **DEV dependencies**.

**CRUD generator** - [laravel-crud-generator](https://github.com/awais-vteams/laravel-crud-generator?tab=readme-ov-file)

[laravel-crud-generator - Tutorial](https://medium.com/@awais.sds/generate-laravel-11-api-crud-in-2-min-2124540990f9)

### Steps to generate

**Create CRUD**

> **Note:** `user` or `users`, `{table_name}` ... are placeholders for table name and generator. **Use your own!**

1. Run command `sail artisan make:crud {table_name}` and select Tailwind CSS or run
   command `sail artisan make:crud {table_name} tailwind`
2. Add route `Route::resource('users', UserController::class);` to [web.php](routes/web.php)
3. Add CRUD to menu (menu links to routes) to [navigation.blade.php](resources/views/layouts/navigation.blade.php)
    ```bladehtml
        // add to <!-- Navigation Links -->
        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
            {{ __('Users') }}
        </x-nav-link>
        
        // add to <!-- Responsive Navigation Menu -->
        <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
            {{ __('Users') }}
        </x-responsive-nav-link>
    ```
4. Run `sail npm run build` to build assets or reset `sail npm run dev` to watch changes.
5. Manual update generated code and happy coding.

