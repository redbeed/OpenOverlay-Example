# OpenOverlay Standalone App

This is a template / example laravel app for the [OpenOverlay][open-overlay] package with websocket. You can use this to
start with your overlay.

## About OpenOverlay

[OpenOverlay][open-overlay] give you the possibility to easy connection your service with Twitch EventSub. Find out more
here.

## Installation

1. Clone OpenOverlay Standalone
2. Run composer install

    ```bash 
    composer install
    ```

3. Copy `.env.example` to `.env`

   Add a custom passwort for ``DB_PASSWORD`` and ``DB_ROOT_PASSWORD``

    ```bash 
    cp .env.example .env
    ```


4. Start docker/sail
    ```bash
    ./vendor/bin/sail up
    ```

5. Generate APP Key
   ```bash 
   ./vendor/bin/sail artisan key:generate
   ```

6. Migrate Database
   ```bash 
   ./vendor/bin/sail artisan migrate
   ```

6. Create your account
   ```bash 
   http://localhost/register
   ```

## Services that this package use

- **[OpenOverlay][open-overlay]**
- **[Websockets][websockets]**
- **[Jetstream][jetstream]**

[open-overlay]: https://github.com/redbeed/OpenOverlay

[websockets]: https://github.com/beyondcode/laravel-websockets

[jetstream]: https://jetstream.laravel.com/1.x/introduction.html
