<div x-data="{dropdownProfile: false}" class="profile relative">
    <button @click="dropdownProfile = ! dropdownProfile"
            class="flex items-center text-white hover:text-pink transition">
        <span class="sr-only">Профиль</span>
        <x-profile.avatar/>
        <span class="hidden md:block ml-2 font-medium">{{ auth()->user()->name}}</span>
        <svg class="shrink-0 w-3 h-3 ml-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
             viewBox="0 0 30 16">
            <path fill-rule="evenodd"
                  d="M27.536.72a2 2 0 0 1-.256 2.816l-12 10a2 2 0 0 1-2.56 0l-12-10A2 2 0 1 1 3.28.464L14 9.397 24.72.464a2 2 0 0 1 2.816.256Z"
                  clip-rule="evenodd"/>
        </svg>
    </button>
    <x-profile.dropdown.menu/>
</div>
