
# Installation du thème

## Installation :
- PHP version : `8.3`
- Configure the `.env.local` file - For local installation and the `.env` for production installation
- Then `sudo composer install` into the root
- Into the theme folder : `nvm use v14.16.1` & `sudo npm i`


## Develop :
- `grunt watch`
- Les fichiers compilés (`library/css/*.min.css`, `library/css/blocks/`, `library/css/editor/`, `library/js/scripts.js`) ne sont **pas versionnés** : ils sont générés par `npm run build` lors du déploiement (GitHub Actions). En local, `grunt watch` (ou `npm run build`) les génère.

## Mise en place du déploiement :
- Pour le staging : se rendre dans Github, onglet Settings puis Secrets and variables > Actions
- Ajouter un repository secret DEPLOY_KEY_STAGING - Coller la clé privée SSH

## Mise en place du Token Git :
- Dans Personal access tokens > Fine-grained tokens, cliquer sur Generate new token.
- Remplir les champs :
    - Token name : Dashboard WP – The French Pantry
    - Resource owner : 20h20
    - Expiration : 1 an, par exemple.
    - Repository access : Only select repositories > 20h20/thefrenchpantry.
    - Permissions > Repository permissions > Contents : Read-only.
- Cliquer sur Generate token et copier la valeur dans le wp-config.php

## Staging : 
- https://tgelso.julien-brochard.fr/
- to push to preproduction website : git branch > develop then git add ., git commit -m 'my commit', git push origin develop


## Prod 
- https://thefrenchpantryvt.com/
- Pour déployer en production : git checkout main puis git merge develop puis, pour le commit, :wq puis git push origin main.