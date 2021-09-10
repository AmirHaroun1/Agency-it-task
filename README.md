<h2 align="center">
<a href="https://www.postman.com/grey-firefly-242861/workspace/agency-it-task" target="_blank">
AGENCY - IT Full-stack Task
</h2>

## Introduction

it was amazing working on this task using Laravel, it wasn't mentioned whether i should use **api** or **web** so i went for the first solution and developed apis.
<br />
For Testing The Apis i used postman , please check **[Task's PostMan Environment](https://www.postman.com/grey-firefly-242861/workspace/agency-it-task/collection/11934912-363ccaa8-bfcc-48ea-8c86-2f4b90d7da1c)** 
<br />
along the project there were some parts where we could replace eloquent with simple joins to improve the Performance, but this is a laravel task after all .
<br />
<br />
**AUTHINTECATION**
<br />
for Authenticating Api Requests i used **[SANCTUM](https://laravel.com/docs/8.x/sanctum)** to issue simple tokens.
<br>Created The Login and Logout Features That Should be found in controllers

## Prerequisites

- **PHP** = 8.0
- **LARAVEL** = 8.x

## Getting Started
1. **Open Postman Project's Environment as apis reference : [LINK](https://www.postman.com/grey-firefly-242861/workspace/agency-it-task/collection/11934912-363ccaa8-bfcc-48ea-8c86-2f4b90d7da1c)**
1. **Clone GitHub repo for this project locally**: `gh repo clone AmirHaroun1/Agency-it-task`
2. **cd into your Project Files**
3. **Install Composer Dependencies**: `composer install`
4. **Create a copy of your .env file**: `cp .env.example .env`
5. **Generate an app encryption key**: `php artisan key:generate`
6. **Create Database and edit the .env file**
7. **Migrate the database** : `php artisan migrate`


## Notes

- Repository Pattern would have really enhanced the code quality but because of a certain circumstances, i was short on time
