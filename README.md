# Orbis simple CMS

## How to install

> `sail` is a command with alias `vendor/bin/sail`
> 

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
6. Build CSS/JS assets by `sail npm run build`
7. Migrate user preferences `sail artisan migrate:fresh --seed` - Migrate all data with seeder
