@echo off
echo ###^> symfony/framework-bundle ###> .env
echo APP_ENV=dev>> .env
echo APP_SECRET=3e294dee9dde9aa9dce21fe2e4fa37de>> .env
echo ###^< symfony/framework-bundle ###>> .env
echo.>> .env
echo ###^> doctrine/doctrine-bundle ###>> .env
echo # Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url>> .env
echo # IMPORTANT: You SHOULD configure your server version, either here or in config/packages/doctrine.yaml>> .env
echo #>> .env
echo # DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db">> .env
echo DATABASE_URL="mysql://user:password@database:3306/symfony_db?serverVersion=8.0">> .env
echo ###^< doctrine/doctrine-bundle ###>> .env
echo.>> .env
echo ###^> nelmio/cors-bundle ###>> .env
echo CORS_ALLOW_ORIGIN='^https?://(localhost^|127\.0\.0\.1)(:[0-9]+)?$'>> .env
echo ###^< nelmio/cors-bundle ###>> .env