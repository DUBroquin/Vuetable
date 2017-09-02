## Upgrading from v6.x to v7.x
  - composer require yajra/laravel-vuetables-oracle 
  - composer require yajra/laravel-vuetables-buttons
  - php artisan vendor:publish --tag=vuetables --force
  - php artisan vendor:publish --tag=vuetables-buttons --force

## Upgrading from v5.x to v6.x
  - Change all occurrences of `dubroquin\vuetables;` to `dubroquin\vuetables;`. (Use Sublime's find and replace all for faster update). 
  - Remove `vuetables` facade registration.
  - Temporarily comment out `dubroquin\vuetables\vuetableServiceProvider`.
  - Update package version on your composer.json and use `yajra/laravel-vuetables-oracle: ~6.0`
  - Uncomment the provider `dubroquin\vuetables\vuetableServiceProvider`. 
