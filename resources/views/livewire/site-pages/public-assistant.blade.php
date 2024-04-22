<div class="h-[calc(100svh-72px)] xl:h-[calc(100svh-64px)] max-w-7xl flex flex-col justify-center mx-auto">
    <section class="p-4 space-y-4">
        <div class="flex flex-col min-h-[36rem] md:min-h-[42rem] lg:min-h-[36rem] max-h-[36rem] md:max-h-[42rem] lg:max-h-[36rem]
        scroll-smooth overflow-y-auto dark:bg-gray-900 border border-gray-500 rounded-lg p-4">
            @foreach($messages as $message)
            <div class="w-full p-4 flex flex-col space-y-2 dark:bg-gray-700 rounded-md text-left mb-4">
                <div class="flex items-center dark:text-gray-200 font-semibold">
                    @if($message['role'] == 'user')
                    <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-square-rounded">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                        <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                    </svg>
                    Usuario
                    @else
                    <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-message-chatbot">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                        <path d="M9.5 9h.01" />
                        <path d="M14.5 9h.01" />
                        <path d="M9.5 13a3.5 3.5 0 0 0 5 0" />
                    </svg>
                    Asistente
                    @endif
                </div>
                <div class="dark:text-gray-200 text-pretty">
                    {{ $message['content'] }}
                </div>
            </div>
            @endforeach
            <div wire:loading>
                <div class="flex justify-center items-center dark:text-gray-200 text-xl">
                    <div role="status">
                        <svg aria-hidden="true"
                            class="w-6 h-6 me-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Cargando...</span>
                    </div>
                    <span>Cargando...</span>
                </div>
            </div>
        </div>
        <form wire:submit="callAssistant">
            <label for="chat" class="sr-only">Su consulta</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                <textarea wire:model="prompt" wire:loading.attr="disabled" wire:loading.class="opacity-50" id="chat"
                    rows="1"
                    class="block mr-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Escriba su consulta aquí"></textarea>
                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Enviar</span>
                </button>
            </div>
        </form>
    </section>
</div>