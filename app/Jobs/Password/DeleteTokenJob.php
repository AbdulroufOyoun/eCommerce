<?php

namespace App\Jobs\Password;

use Illuminate\Bus\Queueable;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $token;
    /**
     * Create a new job instance.
     */

     public function __construct( string $email,string $token)
    {
       $this->email = $email;
       $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {     
        Log::info("Job started for email: {$this->email}, token: {$this->token}");
        PasswordResetToken::where('email', $this->email)
                            ->where('token', $this->token)
                            ->delete();
        Log::info("Deleted password reset tokens");

    }
}
