# Player Stats Import

Player Stats Import is a backend application built off `Laravel 7`. It has the following features:

 - A command for fetching Player Stats from a 3rd party API and saving in local database
 - Get API's for fetching all or single Player Stats once saved

## Installation

Run composer install after cloning

```bash
composer install
```

Set your database credentials in your `.env` file
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=testdb
DB_USERNAME=root
DB_PASSWORD=
```

Generate your application key
```bash
php artisan key:generate
```

Migrate tables
```bash
php artisan migrate
```

## Usage
Run the import command to populate your local database

```bash
php artisan stats_import:players
```
#### Note:
This command can also be used as a Cron Job and is currently set to run daily if ever it was triggered. 
To change the frequency, you can change it in `app/Console/Kernel.php@schedule`

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('stats_import:players')->daily();
}
```
<https://laravel.com/docs/7.x/scheduling#schedule-frequency-options>


Set an initial Cron Job in your server, that runs `php artisan schedule:run`:

#### Example:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

This will constantly check if there are jobs to run in `app/Console/Kernel.php@schedule`. For future developments, you can set additional scheduled jobs in the said method, instead of doing it all in you server (which is pretty convenient).

## API's

### Fetch all players

`{{your_domain}}/api/v1/stats/players`

Paginated by default of 100 records per page


#### Query Parameters

Parameter | Type | Values | Description
--- | --- | --- | ---
mode | string/nullable | simple | If mode is set to simple, it will show just the `id` and `full_name` of the players
page | integer | any integer | Sets the current page number

Example URL:

`{{your_domain}}/api/v1/stats/players?page=2&mode=simple`

Example Response:

```json
[
  {
    "id": 101,
    "full_name": "Ashley Westwood"
  },
  {
    "id": 102,
    "full_name": "Jack Cork"
  },
  {
    "id": 103,
    "full_name": "Marcos Alonso"
  },
  {
    "id": 104,
    "full_name": "Antonio Rüdiger"
  }
]
```

### Fetch single player by ID

`{{your_domain}}/api/v1/stats/players/{id}`

#### URL Parameters

Parameter | Type | Values | Description
--- | --- | --- | ---
id | integer | any integer | Player's ID (based on data imported from API)

#### Query Parameters

Parameter | Type | Values | Description
--- | --- | --- | ---
mode | string/nullable | simple | If mode is set to simple, it will show just the `id` and `full_name` of the player

Example URL:

`{{your_domain}}/api/v1/stats/players/444`

Example Response:

```json
{
  "id": 444,
  "bps": 31,
  "code": 7645,
  "form": "0.0",
  "news": "",
  "team": 15,
  "bonus": 0,
  "photo": "7645.jpg",
  "saves": 0,
  "status": "a",
  "threat": "2.0",
  "assists": 0,
  "ep_next": "0.0",
  "ep_this": "0.0",
  "minutes": 128,
  "special": false,
  "now_cost": 41,
  "web_name": "Jagielka",
  "ict_index": "4.5",
  "influence": "39.0",
  "own_goals": 0,
  "red_cards": 0,
  "team_code": 49,
  "creativity": "4.7",
  "first_name": "Phil",
  "news_added": null,
  "value_form": "0.0",
  "second_name": "Jagielka",
  "threat_rank": 419,
  "clean_sheets": 0,
  "element_type": 2,
  "event_points": 0,
  "goals_scored": 0,
  "in_dreamteam": false,
  "squad_number": null,
  "total_points": 4,
  "transfers_in": 16536,
  "value_season": "1.0",
  "yellow_cards": 0,
  "transfers_out": 46790,
  "goals_conceded": 3,
  "ict_index_rank": 431,
  "influence_rank": 405,
  "creativity_rank": 417,
  "dreamteam_count": 0,
  "penalties_saved": 0,
  "points_per_game": "1.0",
  "penalties_missed": 0,
  "threat_rank_type": 154,
  "cost_change_event": 0,
  "cost_change_start": -4,
  "transfers_in_event": 0,
  "ict_index_rank_type": 155,
  "influence_rank_type": 150,
  "selected_by_percent": "0.3",
  "transfers_out_event": 0,
  "creativity_rank_type": 154,
  "cost_change_event_fall": 0,
  "cost_change_start_fall": 4,
  "chance_of_playing_next_round": null,
  "chance_of_playing_this_round": null
}
```

## Unit Testing

```bash
./vendor/bin/phpunit
```

```php
Player Stats Import (Tests\Feature\Console\Commands\PlayerStatsImport)
 ✔ Run player stats import command success

Player Stats Controller (Tests\Feature\Http\Controllers\PlayerStatsController)
 ✔ Get players api success
 ✔ Get players api simple mode success
 ✔ Get player api success
 ✔ Get player api invalid id failure

Time: 573 ms, Memory: 28.00 MB

OK (5 tests, 15 assertions)
```
