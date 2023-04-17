@props(['style' => session('flash.mensajeTipo', 'EXITO'), 'message' => session('flash.mensaje')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
    :class="{ 'bg-green-500': style == 'EXITO', 'bg-red-700': style == 'ALARMA','bg-sky-700': style == 'INFO', 'bg-gray-500': style != 'EXITO' && style != 'ALARMA'&& style != 'INFO' }"
    style="display: none;" x-show="show && message" x-init="
                document.addEventListener('banner-message', event => {
                    style = event.detail.style;
                    message = event.detail.message;
                    show = true;
                });
            ">
    <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg"
                    :class="{ 'bg-green-600': style == 'EXITO', 'bg-red-600': style == 'ALARMA', 'bg-sky-600': style == 'INFO' }">

                    <svg x-show="style == 'EXITO'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>

                    <svg x-show="style == 'ALARMA' || style == 'INFO' || style == 'GENERAL'"
                        xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                </span>

                <p class="ml-3 font-bold text-md text-white truncate" x-text="message"></p>
            </div>

                <button type="button" class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition"
                    :class="{ 'hover:bg-green-600 focus:bg-green-600': style == 'EXITO', 'hover:bg-red-600 focus:bg-red-600': style == 'ALARMA' , 'hover:bg-sky-600 focus:bg-sky-600': style == 'INFO' }"
                    aria-label="Dismiss" x-on:click="show = false; livewire.emit('bannerCerrar',{{session('flash.mensajeId')}})">
                    <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
