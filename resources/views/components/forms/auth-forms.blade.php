@props([
    'title' => '',
    'method' => 'post'
])
<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
    <h1 class="mb-5 text-lg font-semibold">
        {{ $title }}
    </h1>
    <form class="space-y-3" {{$attributes}} method="{{ $method }}">
        @csrf
        {{ $slot }}
    </form>

    {{ $socialAuth }}

    {{ $actions }}

    {{ $docs }}

</div>
