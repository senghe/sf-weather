# Projekt SfNotifier - Wydarzenia

Projekt ma na celu przedstawienie moich umiejętności backendowych.

## Uruchomienie projektu

Projekt jest oparty o dockera. Aby go uruchomić, należy zrobić kilka kroków (komendy w terminalu):

1. Należy zamieścić katalog `docker` w konfiguracji Dockera.
2. Należy dodać host `notifier.local` do pliku hostów.
3. Wchodzimy do katalogu `docker` w katalogu projektu.
4. Uruchamiamy komendę: `docker-compose build` w celu zbudowania kontenerów.
5. Uruchamiamy komendę: `docker-compose up -d` w celu uruchomienia kontenerów.
6. Wchodzimy do kontenera głównego: `docker exec -it notifier_lamp /bin/bash`.
7. Wchodzimy do katalogu głównego projektu: `cd /var/www/notifier`.
8. Tworzymy bazę danych: `bin/console doctrine:database:create`.
9. Tworzymy tabele: `bin/console doctrine:schema:create`.
10. Uruchamiamy skrypt instalujący fixturki: `bin/console notifier:fixtures:load`.
11. Po wpisaniu w przeglądarce: `http://notifier.local/notifiers/list` powinna pojawić się nam lista wszystkich wydarzeń w systemie (REST API).

## Uruchomienie testów

Aby uruchomić testy, należy zrobić kilka kroków:

1. Wchodzimy do kontenera głównego: `docker exec -it notifier_lamp /bin/bash`.
2. Wchodzimy do katalogu głównego projektu: `cd /var/www/notifier`.
3. Uruchamiamy testy: `php /var/www/notifier/bin/phpunit --configuration /var/www/notifier/phpunit.xml.dist --bootstrap=tests/phpunit/bootstrap.php`.
