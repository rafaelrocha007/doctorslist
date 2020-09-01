# DoctorsList

Listagem e criação de uma lista de médicos e suas especialidades através de uma API REST segurada por JWT.

##Backend
Backend baseado em Laravel 7.x, MySQL 5.7 e PHP 7.3.
Ambiente de desenvolvimento baseado em containers docker https://hub.docker.com/r/rafaelrocha007/laravel

##Frontend

##Instruções e requisitos

Para rodar em ambiente de desenvolvimento é necessário instalar o docker e docker-compose, feito isso, basta seguir os passos:

Clonar o projeto

git clone https://github.com/rafaelrocha007/doctors.git meu-projeto

    cd meu-projeto

    docker-compose up --build

Com os containers rodando o frontend ficará disponível em http://localhost:8000 e a API ficará disponível em http://localhost:8000/api 

Popular tabela de especialidades (specialties)

    php artisan db:seed
