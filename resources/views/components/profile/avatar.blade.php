<img src="{{ auth()->user()->avatar ?? app(\Domain\Auth\Actions\GetDefaultUserAvatar::class)->handle(auth()->user()) }}"
     class="shrink-0 w-7 md:w-9 h-7 md:h-9 rounded-full"
     alt="{{ auth()->user()->name }}">
