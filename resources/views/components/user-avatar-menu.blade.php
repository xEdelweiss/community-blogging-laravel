<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button
            class="flex items-center text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">

            @auth
                <x-avatar :user="auth()->user()"
                    class="h-10 w-10 cursor-pointer rounded-xl" />
            @else
                <svg class="h-10 w-10 cursor-pointer rounded-xl"
                    viewBox="0 0 61.7998 61.7998" xmlns="http://www.w3.org/2000/svg"
                    fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                        stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title></title>
                        <g data-name="Layer 2" id="Layer_2">
                            <g data-name="—ÎÓÈ 1" id="_ÎÓÈ_1">
                                <path
                                    d="M23.255 38.68l15.907.146v15.602l-15.907-.147V38.68z"
                                    fill="#333333" fill-rule="evenodd"></path>
                                <path
                                    d="M53.478 51.993A30.813 30.813 0 0 1 30.9 61.8a31.225 31.225 0 0 1-3.837-.237A34.072 34.072 0 0 1 15.9 57.919a31.036 31.036 0 0 1-7.857-6.225l1.284-3.1 13.925-6.212c0 4.535 1.31 10.02 7.439 10.113 7.57.113 8.47-5.475 8.47-10.15l12.79 6.282z"
                                    fill="#857a6e" fill-rule="evenodd"></path>
                                <path
                                    d="M31.462 52.495c-3.342-5.472-9.388-6.287-11.359-6.6-5.42-.86-14.56-4.28-8.564-9.72 10.765-9.764 6.898-22.032 19.513-22.032 13.47 0 8.873 12.268 19.638 22.032 5.997 5.44-3.143 8.86-8.565 9.72a14.292 14.292 0 0 0-10.663 6.6z"
                                    fill="#333333" fill-rule="evenodd"></path>
                                <path
                                    d="M39.964 42.252c-1.125 4.01-4.008 6.397-8.598 6.207-3.94-.163-7.297-2.397-8.11-6.204z"
                                    fill-rule="evenodd" opacity="0.18"></path>
                                <path
                                    d="M31.129 8.432c21.281 0 12.987 35.266 0 35.266-12.267 0-21.281-35.266 0-35.266z"
                                    fill="#ffe8be" fill-rule="evenodd"></path>
                                <path
                                    d="M18.365 24.045c-3.07 1.34-.46 7.687 1.472 7.658a31.973 31.973 0 0 1-1.472-7.658z"
                                    fill="#f9dca4" fill-rule="evenodd"></path>
                                <path
                                    d="M44.14 24.045c3.07 1.339.46 7.687-1.471 7.658a31.993 31.993 0 0 0 1.471-7.658z"
                                    fill="#f9dca4" fill-rule="evenodd"></path>
                                <path
                                    d="M19.113 25.706c-2.83-4.958-2.783-9.375-1.362-11.817 2.048-3.52 4.922-3.688 5.315-4.517 4.025-8.479 24.839-2.048 23.97 11.09a14.798 14.798 0 0 0-1.522-2.486s-.075 4.991-1.437 6.957c-1.64.464-15.061.239-20.053-9.948-4.006 2.268-5.06 7.015-4.91 10.72z"
                                    fill="#969696" fill-rule="evenodd"></path>
                                <path
                                    d="M31.15 46.543c-2.66.022-15.617-4.022-12.61-26.045 0 0 .65 9.916 2.775 12.788 1.382 1.868 2.625 2.57 3.82.746 1.248-1.9 3.946-3.473 6.038-1.677 1.737-1.85 4.848-.212 6.084 1.677 1.195 1.823 2.44 1.123 3.822-.746 2.125-2.872 2.586-12.456 2.586-12.456 3.456 23.6-9.855 25.735-12.515 25.713z"
                                    fill="#969696" fill-rule="evenodd"></path>
                                <path
                                    d="M26.527 36.802a7.118 7.118 0 0 1 4.568-2.096 7.29 7.29 0 0 1 4.503 2.099c-.788.525-5.874 1.737-9.071-.003z"
                                    fill="#ffe8be" fill-rule="evenodd"></path>
                                <path
                                    d="M26.611 51.297a29.35 29.35 0 0 0-8.171-3.501c-4.778-.758-13.423-1.518-11.271-10.086C12.023 18.38 18.85 3.688 31.457 3.87c12.836.184 19.09 15.8 23.84 33.865 1.904 7.238-6.79 9.313-11.508 10.06A21.129 21.129 0 0 0 36 51.14c-6.963 4.765-1.812 4.7-9.389.158zm4.851 1.198a14.292 14.292 0 0 1 10.663-6.6c5.422-.86 14.562-4.28 8.565-9.72-10.765-9.764-6.167-22.032-19.638-22.032-12.615 0-8.748 12.268-19.513 22.032-5.997 5.44 3.143 8.86 8.564 9.72 1.97.313 8.017 1.127 11.36 6.6z"
                                    fill="#7d7062" fill-rule="evenodd"></path>
                                <path
                                    d="M24.202 50.213s5.988 3.256 7.588 7.992c1.61-5.121 7.627-8.327 7.627-8.327S33.07 52.33 31.7 55.534c-.973-1.722-2.707-3.4-7.497-5.321z"
                                    fill="#333333" fill-rule="evenodd"></path>
                            </g>
                        </g>
                    </g>
                </svg>
            @endauth

            <div class="ms-1">
                <x-icons.chevron-down class="h-4 w-4 fill-current" />
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        @auth()
            <x-dropdown-link :href="route('profile')" wire:navigate>
                {{ __('Profile') }}
            </x-dropdown-link>

            <button wire:click="logout" class="w-full text-start">
                <x-dropdown-link>
                    {{ __('Log out') }}
                </x-dropdown-link>
            </button>
        @else
            <x-dropdown-link :href="route('login')" wire:navigate>
                {{ __('Login') }}
            </x-dropdown-link>

            <x-dropdown-link :href="route('register')" wire:navigate>
                {{ __('Register') }}
            </x-dropdown-link>
        @endauth
    </x-slot>
</x-dropdown>
