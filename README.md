# Projekt SfWeather

Projekt ma na celu przedstawienie moich umiejętności backendowych oraz frontendowych.

## Uruchomienie projektu

Projekt jest oparty o dockera. Aby go uruchomić, należy zrobić kilka kroków (komendy w terminalu):

1. Należy zamieścić katalog `docker` w konfiguracji Dockera.
2. Należy dodać host `weather.local` do pliku hostów.
3. Wchodzimy do katalogu `docker` w katalogu projektu.
4. Uruchamiamy komendę: `docker-compose build` w celu zbudowania kontenerów.
5. Uruchamiamy komendę: `docker-compose up -d` w celu uruchomienia kontenerów.
6. Wchodzimy do kontenera głównego: `docker exec -it weather_lamp /bin/bash`.
7. Wchodzimy do katalogu głównego projektu: `cd /var/www/weather`.
8. Tworzymy bazę danych: `bin/console doctrine:database:create`.
9. Tworzymy tabele: `bin/console doctrine:schema:create`.
11. Po wpisaniu w przeglądarce: `http://weather.local` powinna pojawić się nam strona projektu.

## Uruchomienie testów

Aby uruchomić testy, należy zrobić kilka kroków:

1. Wchodzimy do kontenera głównego: `docker exec -it weather_lamp /bin/bash`.
2. Wchodzimy do katalogu głównego projektu: `cd /var/www/weather`.
3. Uruchamiamy testy: `php /var/www/weather/vendor/bin/phpunit`.
