<div x-data="{
    open: false,

    scrollTo(target) {
        const element = document.querySelector(target);

        if(element) {
            element.scrollIntoView({ behavior: 'smooth'});
        }

    },

    }">
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5">
                <span class="sr-only">My finance</span>
                <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="My finance">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button @click="open=!open" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Abrir menu principal</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a @click.prevent="scrollTo('#features')" href="#features" class="text-sm font-semibold leading-6 text-gray-900">Recursos</a>
                <a @click.prevent="scrollTo('#pricing')" href="#pricing" class="text-sm font-semibold leading-6 text-gray-900">Planos e preços</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="/admin" class="text-sm font-semibold leading-6 text-gray-900">Login <span aria-hidden="true">&rarr;</span></a>
            </div>
        </nav>

        <!-- Mobile menu, show/hide based on menu open state. -->
        <div x-show="open" class="lg:hidden" role="dialog" aria-modal="true" style="display: none;">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div @click="open=!open" class="fixed inset-0 z-50"></div>
            <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                <a href="/" class="-m-1.5 p-1.5">
                    <span class="sr-only">My finance</span>
                    <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="">
                </a>
                <button @click="open=!open" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <a @click.prevent="scrollTo('#features'), open=!open"  href="#features" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Recursos</a>
                            <a @click.prevent="scrollTo('#pricing'), open=!open" href="#pricing" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Planos e preços</a>
                        </div>
                        <div class="py-6">
                            <a href="/admin/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>