<p align="center"><img src="public/repository-images/logo.png" width="250" height="250"></p>

# NewModern Loja Virtual

#### Sobre:

Loja Virtual desenvolvida como trabalho obrigatório para a disciplina de **Projeto Integrador I** do curso de **Tecnologia em Ánalise e Desenvolvimento de Sistemas**.

#### Ferramentas e Tecnologias utilizadas neste projeto:

-  **PHP 8.1.6**
-  **Composer version 2.3.5** 
-  **Laravel 9.12.2**
-  **Laravel Jetstream 2.8**
-  **Bootstrap**
-  **HTML 5**
-  **CSS 3**
-  **SCSS**
-  **JavaScript** 
-  **JQuery**
-  **MySQL 8.0.29**
-  **Mailtrap.io**
-  **Laravel Image Intervention Package (trabalhar com imagens)**
-  **Laravel Shoppingcart - bumbummen99/shoppingcart**
-  **Laravel PDF -  barryvdh/laravel-dompdf**
-  **Stripe Payment**
-  **VSCode**
-  **Banco de dados tratado com o padrão Factory** 
-  **Padrão MVC**

---------------------------------------------------------------------------------------------------------------------------------------------------------
<p align="center"><img src="public/repository-images/phplogo.png" width="250" height="200"></p>

## PHP 8.1.6

### Sobre:

Criada por Rasmus Lerdof, PHP é uma linguagem interpretada livre usada originalmente apenas para o desenvolvimento de aplicações presentes e atuantes no lado do servidor, capazes de gerar conteúdo dinâmico na World Wide Web. Hoje ela é uma das linguagens mais populares para desenvolvimento web.

### Instalação:

#### Atualizar Gerenciador de Pacotes
```
sudo apt update
```
#### Adicionar PPA for PHP 8.1
```
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
```
#### Instalar PHP 8.1 para Apache
```
sudo apt install php8.1
```
#### Verificar se a instalação foi bem-sucedida e a versão instalada
``` 
php -v
```
#### Instalar PHP 8.1 para Nginx
```
sudo apt install php8.1-fpm
```
#### Verificar se a instalação foi bem-sucedida e a versão instalada
``` 
php-fpm8.1 -v
```

#### Instalar Extensões para PHP
```
sudo apt install php8.1-common php8.1-mysql php8.1-xml php8.1-xmlrpc php8.1-curl php8.1-gd php8.1-imagick php8.1-cli php8.1-dev php8.1-imap php8.1-mbstring php8.1-opcache php8.1-soap php8.1-zip php8.1-redis php8.1-intl -y
```
---------------------------------------------------------------------------------------------------------------------------------------------------------
<p align="center"><img src="public/repository-images/composerlogo.png" width="250" height="250"></p>

## Composer

### Sobre:

Composer é uma ferramenta de gerenciamento de dependências em PHP. Essa ferramenta permite a declaração de bibliotecas desejadas no seu projeto e as instala para você.

### Instalação:

#### Atualizar Gerenciador de Pacotes
```
sudo apt update
```

#### Instalar os os pacotes necessários
```
sudo apt install php-cli unzip zip
```

#### Baixar...
``` cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
```

#### Instalar Composer globalmente
```
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

#### Verificar se a instalação foi bem-sucedida e a versão instalada
``` 
composer --version
```
#### Caso ocorra problema de permissão, utilize esse comando:
```
sudo chmod +x /usr/local/bin/composer
```

---------------------------------------------------------------------------------------------------------------------------------------------------------
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Laravel
  
#### Sobre:

Laravel é um framework web PHP de código aberto. É usado principalmente para construir aplicações web baseadas em PHP.

O Laravel é adequado para desenvolvimento de aplicativos em pequena escala e em nível empresarial. Sua sintaxe elegante, recursos avançados e ferramentas robustas ajudam a simplificar o desenvolvimento de aplicativos da web. O Laravel é altamente escalável e possui suporte embutido para sistemas de cache distribuídos.

### Instalação:

#### Instalar o instalador do laravel

```
composer global require laravel/installer
```

#### Para criar e instalar um projeto usando Laravel:
```
laravel new <nome_projeto>
```

#### Criar projeto Laravel utilizando Composer
```
composer create-project laravel/<project_name>
```

#### Para iniciar o servidor de desenvolvimento do Laravel, insira os comandos:
```
cd /<project_name>
php artisan serve
```

#### Pronto!
```
Iniciando o servidor de desenvolvimento Laravel: http://127.0.0.1:8000
``` 


---------------------------------------------------------------------------------------------------------------------------------------------------------
<p align="center"><img src="public/repository-images/jetstream.png" width="400" height="200"></p>


## Jetstream 2.8
  
#### Sobre:

Laravel Jetstream é um kit inicial de aplicativos para Laravel. Jetstream fornece a implementação para login, registro, verificação de e-mail, autenticação de dois fatores, gerenciamento de sessão, API via Laravel Sanctum e recursos opcionais de gerenciamento de equipe.

Jetstream é projetado usando Tailwind CSS e oferece sua escolha de andaimes Livewire ou Inertia.

### Instalação:

#### Entrar no diretorio do projeto:

```
cd <nome_projeto>
```

#### Instalar Jetstream com Livewire :

```
php artisan jetstream:install livewire
```

#### Finalizar a instalação :

```
npm install && npm run dev
```

#### Migrar para o BD :

```
php artisan migrate
```

#### Rodar a Seeder :

```
php artisan db:seed
```

---------------------------------------------------------------------------------------------------------------------------------------------------------

## Laravel Image Intervention Package
[documentação oficial](https://image.intervention.io/v2/introduction/installation)

### Sobre:
 Biblioteca PHP para processamento de imagem.

#### Entrar no projeto:

```
cd <nome_projeto>
```

 
#### Instalar via Composer:

```
composer require intervention/image
```

### Configurar: 

#### Entrar em config/app.php e colar: ```Intervention\Image\ImageServiceProvider::class,``` em Package Service Providers

```
/*
 * Package Service Providers...
 */
 // Image intervention.io
 Intervention\Image\ImageServiceProvider::class,
```

#### No mesmo arquivo (config/app.php) Adicione a facade deste pacote ao array $aliases. 

```
'Image' => Intervention\Image\Facades\Image::class
```

```
  'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
        'Image' => Intervention\Image\Facades\Image::class,
    ])->toArray(),

```

#### Publicar:

```
php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
```

#### Caso ocorra o seguinte problema: ```GD Library extension not available with this PHP installation```

```
sudo apt-get install php8.1-gd
```
 --------------------------------------------------------------------------------------------------------------------------------------------------------
 ## bumbummen99/shoppingcart
 [documentação oficial](https://packagist.org/packages/bumbummen99/shoppingcart)

### Sobre:

Laravel Shoppingcart

### Instalação: Instalar o Pacote pelo composer;

#### Execute o comando necessário do Composer no Terminal:
```
composer require bumbummen99/shoppingcart
```
#### Você definitivamente deveria publicar o arquivo de configuração e dar uma olhada nele
```
php artisan vendor:publish --provider="Gloudemans\Shoppingcart\ShoppingcartServiceProvider" --tag="config"
```
#### Isso lhe dará um arquivo de configuração cart.php no qual você pode fazer alterações no comportamento dos pacotes.

---------------------------------------------------------------------------------------------------------------------------------------------------------
## Estado-Cidade Seeder
[repositório GitHub](https://github.com/paulodealmeida/Estados-Cidades-Laravel-Seed)

#### Sobre:
- Seed para Laravel com Estados e Cidades com o código do IBGE
- 26 Estados e 5.565 Cidades, todos com o código do IBGE

---------------------------------------------------------------------------------------------------------------------------------------------------------
<p align="center"><img src="public/repository-images/stripe.png" width="400" height="200"></p>


## Stripe Payment
[documentação oficial](https://stripe.com/docs/development/quickstart/php)
  
#### Sobre:
Stripe é uma companhia tecnológica. Seu software permite a indivíduos e negócios receber pagamentos por internet. Proporciona a infra-estrutura técnica, de prevenção de fraude e bancária necessária para operar sistemas de pagamento em linha.

### Instalação: Instalar o Pacote pelo composer;

#### Execute o comando no diretório do projeto:
```
composer require stripe/stripe-php
```
---------------------------------------------------------------------------------------------------------------------------------------------------------
 ## barryvdh/laravel-dompdf
 [repositório oficial](https://github.com/barryvdh/laravel-dompdf)

### Sobre:

Laravel PDF. Pacote utilizado para baixar boleto(invoice) em PDF (user process).

### Instalação: Instalar o Pacote pelo composer:

Seguir o README do repositório oficial.


