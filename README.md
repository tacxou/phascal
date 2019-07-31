# Lisez moi

[TOC]

## Pas à pas

- Création du fichier README.md
- Création du dossier docs

### Backend

- Modification du dossier docs
  - Création du dossier `laragon_install`
    - Inclusion des captures d'écran d'installation de laragon
  - Création du dossier `laragon_config`
    - Inclusion des captures d'écran de configuration de laragon
- Installation  et [téléchargement](https://github.com/phalcon/cphalcon/releases/tag/v3.4.4) de Phalcon
  - Prendre en fonction de la version de PHP, prendre en compte si version TS
    - Exemple : `phalcon_x64_vc15_php7.2_3.4.4`
  - Mettre `php_phalcon.dll`  dans le dossier `ext` de PHP. 
  - Activation de Phalcon dans Laragon (voir capture d'écran)
- Création du virtual host `pasback` (voir capture d'écran)
- Installation de Phalcon Devtools
  - Via Composer : `composer global require phalcon/devtools`
- Suppression du répertoire `pasback` dans Laragon
- Création du projet `pasback`
  - Via CLI : `phalcon project pasback simple`
- Modification du virtual host Nginx dans Laragon (voir capture d'écran)
  - Voir exemple dans `Configuration/Virtual host/Backend`
- Ajout des IDE Stubs dans le projet `pasback`
  - Via CLI : `composer require --dev phalcon/ide-stubs`
- Changements divers dans le code de `pasback`

### Frontend

- Modification du dossier docs
- Installation de Vue CLI
  - Via CLI : `yarn global add @vue/cli`
- Suppression du répertoire `pasfront` dans Laragon
- Création du projet `pasfront`
  - Via CLI : `vue create pasfront`
  - Commande interractive (cocher les choix multiples avec espace)
    - `Please pick a preset: Manually select features`
    - `Check the features needed for your project: Babel, Router, Vuex, Linter / Formatter`
    - `Use history mode for router? (Y/n): y`
    - `Pick a linter / formatter config: ESLint with error prevention only`
    - `Pick additional lint features: Lint on save`
    - `Where do you prefer placing config for ...? In dedicated config files `
- Ajout de Axios aux dépendances
  - Via CLI : `yarn add axios`
  - Injecter axios en global dans VueJS par [prototype](https://fr.vuejs.org/v2/cookbook/adding-instance-properties.html#Un-exemple-en-situation-reelle-Remplacer-Vue-Resource-par-Axios)
    - Dans `main.js` ajouter la ligne `Vue.prototype.$http = axios`
- Démarrage du serveur de développement
  - Via CLI : `yarn serve`

## Configuration

### Virtual host

#### Backend

```javascript
server {
    listen 80;
    server_name pasback.local *.pasback.local;
    root "C:/laragon/www/pasback/public/";
    client_max_body_size 100M;
    fastcgi_read_timeout 1800;
    
    index index.html index.htm index.php;
 
    location / {
        try_files $uri $uri/ /index.php?_url=$uri&$args;
		autoindex on;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass php_upstream;
        
        if ($request_method ~* "(GET|POST|PUT)") {
            add_header "Access-Control-Allow-Origin" *;
        }
    }
	
    charset utf-8;
	
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    location ~ /\.ht {
        deny all;
    }
}
```

