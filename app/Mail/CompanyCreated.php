<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyCreated extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The order instance.
     *
     * @var \App\Models\Company
     * @var string
     */
    protected $company;
    public $subject;


    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Company  $company
     * @param  string $subject
     * @return void
     */
    public function __construct(Company $company,string $subject)
    {
        $this->company = $company;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.companyCreated')
        ->with([
            'name' => $this->company->name
        ]);
    }
}
