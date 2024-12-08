# Passport Package Setup

## Step 1: Install Passport
Run the following command to install the Passport package:
`composer require laravel/passport`

## Step 2: Publish Passport’s Assets
Publish Passport's assets by running:
`php artisan vendor:publish --provider="Laravel\Passport\PassportServiceProvider"`

## Step 3: Run the Migrations
Run the migrations to create the necessary tables for Passport:
`php artisan migrate`

## Step 4: Install Passport
Install Passport and generate the necessary encryption keys:
`php artisan passport:install`

## Step 5: Generate Passport Keys (if needed)
If you need to generate Passport's encryption keys (this is usually done once), run the following:
`php artisan passport:keys`

## Step 6: Create Personal Access Client
Create a personal access client to allow users to create personal access tokens:
`php artisan passport:client --personal`

