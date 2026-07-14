<?php

namespace App\Observers;

use App\Models\Book;
use App\Mail\BookCreatedMail;
use Illuminate\Support\Facades\Mail;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        //
        
        $user = auth()->user();

        if ($user && $user->email) {
            Mail::to($user->email)->queue(new BookCreatedMail($book));
        }
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
