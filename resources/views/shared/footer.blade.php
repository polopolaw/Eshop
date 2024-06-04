@php use Illuminate\Support\Facades\Vite; @endphp
    <!-- Site footer -->
<footer class="footer py-8 sm:py-12 xl:py-16">
    <div class="container">
        <div class="flex flex-wrap lg:flex-nowrap items-center">
            <div class="footer-logo order-0 basis-full sm:basis-1/2 lg:basis-1/3 shrink-0 text-center sm:text-left">
                <a href="{{ route('home') }}" class="inline-block" rel="home">
                    <img src="{{Vite::image('logo-dark.svg')}}" class="w-[155px] h-[38px]"
                         alt="CutCode">
                </a>
            </div><!-- /.footer-logo -->
            <div class="footer-copyright order-2 lg:order-1 basis-full lg:basis-1/3 mt-8 lg:mt-0">
                <div class="text-[#999] text-xxs xs:text-xs sm:text-sm text-center">
                    EcomShop, {{ now()->year }} © {{ __('All rights reserved') }}
                </div>
            </div><!-- /.footer-copyright -->
            <div class="footer-social order-1 lg:order-2 basis-full sm:basis-1/2 lg:basis-1/3 mt-8 sm:mt-0">
                <div class="flex flex-wrap items-center justify-center sm:justify-end space-x-6">
                    <a href="https://t.me/guruarticles" class="inline-flex items-center text-white hover:text-pink"
                       target="_blank"
                       rel="nofollow noopener">
                        <img class="h-5 lg:h-6" src="{{ Vite::image('icons/telegram.svg') }}" alt="Telegram">
                        <span class="ml-2 lg:ml-3 text-xxs font-semibold">Telegram</span>
                    </a>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</footer>
@include('shared.mobile-menu')

@include('shared.modals')
@yield('footer-assets')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
