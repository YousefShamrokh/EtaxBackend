<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\PruneSoftDeletedBooksJob;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new PruneSoftDeletedBooksJob())->daily()->at('00:00')->timezone('Africa/Cairo');

// PruneSoftDeletedBooksJob::dispatch(); used to test if it works, but now it is scheduled to run daily at midnight