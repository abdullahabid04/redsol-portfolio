<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactInquiry;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ContactForm extends Component
{
    public $full_name = '';
    public $email = '';
    public $phone = '';
    public $company = '';
    public $country = '';
    public $department = '';
    public $service_interest = 'his';
    public $message = '';
    
    public $successMessage = '';

    protected $rules = [
        'full_name' => 'required|min:3|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'company' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'department' => 'nullable|string|max:255',
        'service_interest' => 'required|in:his,cms,custom_dev,other',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        $ip = request()->ip();
        $key = 'contact-form:' . $ip;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'rate_limit' => "Too many submissions. Please try again in {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($key, 3600); // 1 hour timeout

        ContactInquiry::create([
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'country' => $this->country,
            'department' => $this->department,
            'service_interest' => $this->service_interest,
            'message' => $this->message,
            'ip_address' => $ip,
        ]);

        $this->reset(['full_name', 'email', 'phone', 'company', 'country', 'department', 'service_interest', 'message']);
        
        $this->successMessage = 'Thank you! Your inquiry has been submitted successfully. Our team will contact you shortly.';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
