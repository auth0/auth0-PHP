#!/bin/bash

CONFIG_FILE=.env
AUTH0_DOMAIN=
AUTH0_CLIENT_ID=
AUTH0_CLIENT_SECRET=
AUTH0_COOKIE_SECRET=
AUTH0_CUSTOM_DOMAIN=
AUTH0_API_AUDIENCE=

composer install

if [ -f "${CONFIG_FILE}" ]; then
    echo 'Environment file (.env) already present. Skipping setup.'
    exit 0
else
    cp .env.example .env
    php bin/console secret:regenerate-app-secret .env.local

    echo ' '
    echo 'Please refer to your Auth0 Application details to fill in the following values: '
    echo '→ https://manage.auth0.com/#/applications '
    echo '-------------------------------------------------------------------------------'
    echo ' '

    printf 'Auth0 application domain: (e.g. your-app.us.auth0.com) '
    read answer
    AUTH0_DOMAIN=$answer

    [[ -z "$AUTH0_DOMAIN" ]] && { echo "Error: Provided domain is invalid."; exit 1; }

    printf 'Auth0 application client ID: '
    read answer
    AUTH0_CLIENT_ID=$answer

    [[ -z "$AUTH0_CLIENT_ID" ]] && { echo "Error: Provided client ID is invalid."; exit 1; }

    printf 'Auth0 application client secret: '
    read answer
    AUTH0_CLIENT_SECRET=$answer

    [[ -z "$AUTH0_CLIENT_SECRET" ]] && { echo "Error: Provided client secret is invalid."; exit 1; }

    sed -i '' "s/{DOMAIN}/$AUTH0_DOMAIN/g" "${CONFIG_FILE}"
    sed -i '' "s/{CLIENT_ID}/$AUTH0_CLIENT_ID/g" "${CONFIG_FILE}"
    sed -i '' "s/{CLIENT_SECRET}/$AUTH0_CLIENT_SECRET/g" "${CONFIG_FILE}"

    printf 'Is Auth0 configured to use a custom domain (y/n)? '
    read answer

    if [ "$answer" != "${answer#[Yy]}" ] ;then
      printf 'Custom domain: '
      read answer
      AUTH0_CUSTOM_DOMAIN=$answer

      [[ -z "$AUTH0_CUSTOM_DOMAIN" ]] && { echo "Error: Provided custom domain is invalid."; exit 1; }

      sed -i '' "s/CUSTOM_DOMAIN=null/CUSTOM_DOMAIN=$AUTH0_CUSTOM_DOMAIN/g" "${CONFIG_FILE}"
    fi

    printf 'Would you like to use a custom API? (y/n)? '
    read answer

    if [ "$answer" != "${answer#[Yy]}" ] ;then
      echo ' '
      echo 'Please refer to your Auth0 API details to fill in the following values: '
      echo '→ https://manage.auth0.com/#/apis '
      echo '-----------------------------------------------------------------------'
      echo ' '

      printf 'Auth0 API identifier/audience: '
      read answer
      AUTH0_API_AUDIENCE=$answer

      [[ -z "$AUTH0_API_AUDIENCE" ]] && { echo "Error: Provided API audience is invalid."; exit 1; }

      sed -i '' "s/API_IDENTIFIER=null/API_IDENTIFIER=$AUTH0_API_AUDIENCE/g" "${CONFIG_FILE}"
    fi

    AUTH0_COOKIE_SECRET=$(openssl rand 32 -hex)
    sed -i '' "s/{COOKIE_SECRET}/$AUTH0_COOKIE_SECRET/g" "${CONFIG_FILE}"
fi

echo 'Setup complete!'
