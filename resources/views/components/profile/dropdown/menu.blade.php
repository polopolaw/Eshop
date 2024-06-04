<div
    x-show="dropdownProfile"
    @click.away="dropdownProfile = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="absolute z-50 top-0 -right-20 xs:-right-8 sm:right-0 w-[280px] sm:w-[300px] mt-14 p-4 rounded-lg shadow-xl bg-card"
>
    <h5 class="text-body text-xs">Мой профиль</h5>
    <div class="flex items-center mt-3">
        <x-profile.avatar/>
        <span class="ml-3 text-xs md:text-sm font-bold">{{ auth()->user()->name }}</span>
    </div>
    <div class="mt-4">
        <ul class="space-y-2">
            <li><a href="#" class="text-body hover:text-white text-xs font-medium">Мои
                    заказы</a></li>
            <li><a href="#"
                   class="text-body hover:text-white text-xs font-medium">Редактировать
                    профиль</a></li>
        </ul>
    </div>
    <div class="mt-6">

    </div>
</div>
