@php use Illuminate\Support\Facades\Vite; @endphp
<div id="mobileMenu" class="hidden bg-white fixed inset-0 z-[9999]">
    <div class="container">
        <div class="mmenu-heading flex items-center pt-6 xl:pt-12">
            <div class="shrink-0 grow">
                <a href="{{ route('home') }}" rel="home">
                    <img src="{{ Vite::image('logo-dark.svg') }}" class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]"
                         alt="{{ config('app.name') }}">
                </a>
            </div>
            <div class="shrink-0 flex items-center">
                <button id="closeMobileMenu" class="text-dark hover:text-purple transition">
                    <span class="sr-only">{{ __('Close menu') }}</span>
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div><!-- /.mmenu-heading -->
        <div class="mmenu-inner pt-10">
            @guest
                <x-actions.login/>
            @elseauth
                <div class="flex items-center">
                    <x-profile.avatar/>
                    <div class="flex flex-col items-start ml-4">
                        <span class="text-dark text-xs md:text-sm font-bold">{{ auth()->user()->name }}</span>
                        <x-actions.logout/>
                    </div>
                </div>
            @endauth


            <nav class="flex flex-col mt-8">
                <a href="{{ route('home') }}" class="self-start py-1 text-dark hover:text-pink text-md font-bold">Главная</a>
                <a href="catalog.html" class="self-start py-1 text-dark hover:text-pink text-md font-bold">Каталог
                    товаров</a>
                <a href="orders.html" class="self-start py-1 text-dark hover:text-pink text-md font-bold">Мои заказы</a>
                <a href="cart.html" class="self-start py-1 text-dark hover:text-pink text-md font-bold">Корзина</a>
            </nav>
            <div class="flex flex-wrap items-center space-x-6 mt-8">
                <a href="#" class="inline-flex items-center text-darkblue hover:text-purple" target="_blank"
                   rel="nofollow noopener">
                    <img class="h-5 lg:h-6" src="{{ Vite::image('icons/telegram.svg') }}" alt="Telegram">
                    <span class="ml-2 lg:ml-3 text-xxs font-semibold">Telegram</span>
                </a>
            </div>
        </div><!-- /.mmenu-inner -->
    </div><!-- /.container -->
</div>
