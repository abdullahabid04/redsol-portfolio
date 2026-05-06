<div>
    @if($successMessage)
        <div class="bg-success/10 border border-success/30 rounded-xl p-6 text-center animate-fade-in">
            <div class="w-16 h-16 bg-success/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-white font-display font-bold text-2xl mb-2">Message Sent!</h3>
            <p class="text-text-dark/80">{{ $successMessage }}</p>
            <button wire:click="$set('successMessage', '')" class="mt-6 text-primary hover:text-white font-bold transition-colors">Send another message</button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="space-y-6">
            @error('rate_limit')
                <div class="p-4 bg-neon-red/10 border border-neon-red/30 rounded-lg text-neon-red text-sm mb-6">
                    {{ $message }}
                </div>
            @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-text-dark/80 mb-2">Full Name *</label>
                    <input type="text" id="full_name" wire:model="full_name" class="w-full bg-white/5 border @error('full_name') border-neon-red/50 @else border-white/10 @enderror rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="John Doe">
                    @error('full_name') <span class="text-neon-red text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-text-dark/80 mb-2">Email Address *</label>
                    <input type="email" id="email" wire:model="email" class="w-full bg-white/5 border @error('email') border-neon-red/50 @else border-white/10 @enderror rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="john@hospital.com">
                    @error('email') <span class="text-neon-red text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-text-dark/80 mb-2">Phone Number</label>
                    <input type="tel" id="phone" wire:model="phone" class="w-full bg-white/5 border @error('phone') border-neon-red/50 @else border-white/10 @enderror rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="+1 (555) 000-0000">
                    @error('phone') <span class="text-neon-red text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Company/Hospital -->
                <div>
                    <label for="company" class="block text-sm font-medium text-text-dark/80 mb-2">Hospital / Organization</label>
                    <input type="text" id="company" wire:model="company" class="w-full bg-white/5 border @error('company') border-neon-red/50 @else border-white/10 @enderror rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="City General Hospital">
                    @error('company') <span class="text-neon-red text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Country -->
                <div>
                    <label for="country" class="block text-sm font-medium text-text-dark/80 mb-2">Country</label>
                    <input type="text" id="country" wire:model="country" class="w-full bg-white/5 border @error('country') border-neon-red/50 @else border-white/10 @enderror rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="e.g. United States">
                    @error('country') <span class="text-neon-red text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Service Interest -->
                <div>
                    <label for="service_interest" class="block text-sm font-medium text-text-dark/80 mb-2">I am interested in... *</label>
                    <select id="service_interest" wire:model="service_interest" class="w-full bg-navy border @error('service_interest') border-neon-red/50 @else border-white/10 @enderror rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        <option value="his">Health Information System (HIS)</option>
                        <option value="cms">Campus Management System (CMS)</option>
                        <option value="custom_dev">Custom Software Development</option>
                        <option value="other">Other Inquiry</option>
                    </select>
                    @error('service_interest') <span class="text-neon-red text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-text-dark/80 mb-2">Your Message *</label>
                <textarea id="message" wire:model="message" rows="5" class="w-full bg-white/5 border @error('message') border-neon-red/50 @else border-white/10 @enderror rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all resize-none" placeholder="How can we help you?"></textarea>
                @error('message') <span class="text-neon-red text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2 flex justify-end items-center">
                <div wire:loading wire:target="submit" class="mr-4 text-primary">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
                <button type="submit" class="bg-gradient-to-br from-primary to-neon-red text-white font-bold py-3 px-8 rounded-full shadow-[0_0_20px_rgba(192,57,43,0.4)] hover:shadow-[0_0_30px_rgba(231,76,60,0.6)] hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed" wire:loading.attr="disabled">
                    Send Message
                </button>
            </div>
        </form>
    @endif
</div>
