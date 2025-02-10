# Projekta instalācija

1. Uzinstalējiet docker un docker-compose
2. Uzinstalējiet composer globāli
3. Noklonējiet šo repozitoriju
4. Pārējiet uz mapi, kur ir šis fails
5. Terminālī izpildiet komandas:
- **docker-compose up -d**
- **composer install**
- **composer dump-autoload**
6. Ieejiet jauizveidotajā php-apache konteinerī un izpildiet komandu pdo_mysql draivera korektai instalēšanai:
- **./install.sh**
7. Pārlūkā dodieties uz phpMyAdmin http://localhost:8080 - lietotājs root parole 3954895ergZCX$
8. Atvēriet datubāzi tests un importējiet mysqldump.sql failu tajā (fails ir tajā pašā mapē, kur šis README)
9. Pārlūkā dodaties uz http://localhost/ un notestējiet testēšanas sistēmu (ja lietotāja vārds tai vēl nav zināms, tā automātiski izveido jaunu lietotāju)
10. Frontenda pirmkods React ir pieejams https://github.com/vkrizevics/tests-react/
