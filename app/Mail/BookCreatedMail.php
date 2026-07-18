<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Book $book;

    /**
     * Create a new message instance.
     */
    public function __construct(Book $book)
    {
        //
        $this->book = $book;
    }

    /**
     * Get the message envelope.
     */
    public function getEnvelope(): Envelope
{
    return new Envelope(
        subject: '📚 New Book Registered: ' . $this->book->name,
    );
}

    /**
     * Get the message content definition.
     */
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.books.created'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
