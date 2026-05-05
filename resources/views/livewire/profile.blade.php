<div x-data="{  'isProfileInfoModal': @entangle('isProfileInfoModal'), 'isProfileAddressModal': @entangle('isProfileAddressModal') }">
    <div class="rounded-2xl border border-gray-200 bg-white p-5 lg:p-6 dark:border-gray-800 dark:bg-white/[0.03]"
        >
        <h3 class="mb-5 text-lg font-semibold text-gray-800 lg:mb-7 dark:text-white/90">
            Profile
        </h3>

        <div class="mb-6 rounded-2xl border border-gray-200 p-5 lg:p-6 dark:border-gray-800" >
            <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between" >
                <div class="flex w-full flex-col items-center gap-6 xl:flex-row" >
                    <div class="h-20 w-20 overflow-hidden rounded-full border border-gray-200 dark:border-gray-800"
                        >
                        <img src="src/images/user/owner.jpg" alt="user">
                    </div>
                    <div class="order-3 xl:order-2" >
                        <h4
                            class="mb-2 text-center text-lg font-semibold text-gray-800 xl:text-left dark:text-white/90">
                            {{ $name }}
                        </h4>
                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left"
                            >
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $designation }}
                            </p>
                            <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700" >
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $profile->city ?? 'No City' }}, {{ $profile->country?? 'No Country' }}
                            </p>
                        </div>
                    </div>
                    <div class="order-2 flex grow items-center gap-2 xl:order-3 xl:justify-end" >
                        <a href="#" target="_blank"
                            class="shadow-theme-xs flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.6666 11.2503H13.7499L14.5833 7.91699H11.6666V6.25033C11.6666 5.39251 11.6666 4.58366 13.3333 4.58366H14.5833V1.78374C14.3118 1.7477 13.2858 1.66699 12.2023 1.66699C9.94025 1.66699 8.33325 3.04771 8.33325 5.58342V7.91699H5.83325V11.2503H8.33325V18.3337H11.6666V11.2503Z"
                                    fill=""></path>
                            </svg>
                        </a>

                        <a href="#" target="_blank"
                            class="shadow-theme-xs flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.1708 1.875H17.9274L11.9049 8.75833L18.9899 18.125H13.4424L9.09742 12.4442L4.12578 18.125H1.36745L7.80912 10.7625L1.01245 1.875H6.70078L10.6283 7.0675L15.1708 1.875ZM14.2033 16.475H15.7308L5.87078 3.43833H4.23162L14.2033 16.475Z"
                                    fill=""></path>
                            </svg>
                        </a>

                        <a href="#" target="_blank"
                            class="shadow-theme-xs flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.78381 4.16645C5.78351 4.84504 5.37181 5.45569 4.74286 5.71045C4.11391 5.96521 3.39331 5.81321 2.92083 5.32613C2.44836 4.83904 2.31837 4.11413 2.59216 3.49323C2.86596 2.87233 3.48886 2.47942 4.16715 2.49978C5.06804 2.52682 5.78422 3.26515 5.78381 4.16645ZM5.83381 7.06645H2.50048V17.4998H5.83381V7.06645ZM11.1005 7.06645H7.78381V17.4998H11.0672V12.0248C11.0672 8.97475 15.0422 8.69142 15.0422 12.0248V17.4998H18.3338V10.8914C18.3338 5.74978 12.4505 5.94145 11.0672 8.46642L11.1005 7.06645Z"
                                    fill=""></path>
                            </svg>
                        </a>

                        <a href="#" target="_blank"
                            class="shadow-theme-xs flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.8567 1.66699C11.7946 1.66854 12.2698 1.67351 12.6805 1.68573L12.8422 1.69102C13.0291 1.69766 13.2134 1.70599 13.4357 1.71641C14.3224 1.75738 14.9273 1.89766 15.4586 2.10391C16.0078 2.31572 16.4717 2.60183 16.9349 3.06503C17.3974 3.52822 17.6836 3.99349 17.8961 4.54141C18.1016 5.07197 18.2419 5.67753 18.2836 6.56433C18.2935 6.78655 18.3015 6.97088 18.3081 7.15775L18.3133 7.31949C18.3255 7.73011 18.3311 8.20543 18.3328 9.1433L18.3335 9.76463C18.3336 9.84055 18.3336 9.91888 18.3336 9.99972L18.3335 10.2348L18.333 10.8562C18.3314 11.794 18.3265 12.2694 18.3142 12.68L18.3089 12.8417C18.3023 13.0286 18.294 13.213 18.2836 13.4351C18.2426 14.322 18.1016 14.9268 17.8961 15.458C17.6842 16.0074 17.3974 16.4713 16.9349 16.9345C16.4717 17.397 16.0057 17.6831 15.4586 17.8955C14.9273 18.1011 14.3224 18.2414 13.4357 18.2831C13.2134 18.293 13.0291 18.3011 12.8422 18.3076L12.6805 18.3128C12.2698 18.3251 11.7946 18.3306 10.8567 18.3324L10.2353 18.333C10.1594 18.333 10.0811 18.333 10.0002 18.333H9.76516L9.14375 18.3325C8.20591 18.331 7.7306 18.326 7.31997 18.3137L7.15824 18.3085C6.97136 18.3018 6.78703 18.2935 6.56481 18.2831C5.67801 18.2421 5.07384 18.1011 4.5419 17.8955C3.99328 17.6838 3.5287 17.397 3.06551 16.9345C2.60231 16.4713 2.3169 16.0053 2.1044 15.458C1.89815 14.9268 1.75856 14.322 1.7169 13.4351C1.707 13.213 1.69892 13.0286 1.69238 12.8417L1.68714 12.68C1.67495 12.2694 1.66939 11.794 1.66759 10.8562L1.66748 9.1433C1.66903 8.20543 1.67399 7.73011 1.68621 7.31949L1.69151 7.15775C1.69815 6.97088 1.70648 6.78655 1.7169 6.56433C1.75786 5.67683 1.89815 5.07266 2.1044 4.54141C2.3162 3.9928 2.60231 3.52822 3.06551 3.06503C3.5287 2.60183 3.99398 2.31641 4.5419 2.10391C5.07315 1.89766 5.67731 1.75808 6.56481 1.71641C6.78703 1.70652 6.97136 1.69844 7.15824 1.6919L7.31997 1.68666C7.7306 1.67446 8.20591 1.6689 9.14375 1.6671L10.8567 1.66699ZM10.0002 5.83308C7.69781 5.83308 5.83356 7.69935 5.83356 9.99972C5.83356 12.3021 7.69984 14.1664 10.0002 14.1664C12.3027 14.1664 14.1669 12.3001 14.1669 9.99972C14.1669 7.69732 12.3006 5.83308 10.0002 5.83308ZM10.0002 7.49974C11.381 7.49974 12.5002 8.61863 12.5002 9.99972C12.5002 11.3805 11.3813 12.4997 10.0002 12.4997C8.6195 12.4997 7.50023 11.3809 7.50023 9.99972C7.50023 8.61897 8.61908 7.49974 10.0002 7.49974ZM14.3752 4.58308C13.8008 4.58308 13.3336 5.04967 13.3336 5.62403C13.3336 6.19841 13.8002 6.66572 14.3752 6.66572C14.9496 6.66572 15.4169 6.19913 15.4169 5.62403C15.4169 5.04967 14.9488 4.58236 14.3752 4.58308Z"
                                    fill=""></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <button @click="isProfileInfoModal = true"
                    class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 lg:inline-flex lg:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                            fill=""></path>
                    </svg>
                    Edit
                </button>
            </div>
        </div>

        <div class="mb-6 rounded-2xl border border-gray-200 p-5 lg:p-6 dark:border-gray-800" >
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between" >
                <div >
                    <h4 class="text-lg font-semibold text-gray-800 lg:mb-6 dark:text-white/90">
                        Personal Information
                    </h4>

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32" >
                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Name
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $name }}
                            </p>
                        </div>



                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Email address
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                               {{$email}}
                            </p>
                        </div>

                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Phone
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $phone?? 'N/A' }}
                            </p>
                        </div>
                        <br>
                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Bio
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{$profile->bio?? 'N/A'}}
                            </p>
                        </div>
                    </div>
                </div>

                <button @click="isProfileInfoModal = true"
                    class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 lg:inline-flex lg:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                            fill=""></path>
                    </svg>
                    Edit
                </button>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 p-5 lg:p-6 dark:border-gray-800" >
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between" >
                <div >
                    <h4 class="text-lg font-semibold text-gray-800 lg:mb-6 dark:text-white/90">
                        Address
                    </h4>

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32" >
                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Country
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $profile->country ?? 'N/A' }}
                            </p>
                        </div>

                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                City/State
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $profile->city ?? 'N/A' }}
                            </p>
                        </div>

                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Postal Code
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $profile->postal_code ?? 'N/A' }}
                            </p>
                        </div>
                        <div >
                            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                Address
                            </p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $profile->address ?? 'N/A' }}
                            </p>
                        </div>


                    </div>
                </div>

                <button @click="isProfileAddressModal = true"
                    class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 lg:inline-flex lg:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                            fill=""></path>
                    </svg>
                    Edit
                </button>
            </div>
        </div>
    </div>
    <div x-show="isProfileInfoModal"
        class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;"
        >
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            ></div>
        <div @click.outside="isProfileInfoModal = false"
            class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11"
            >
            <!-- close btn -->
            <button @click="isProfileInfoModal = false"
                class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                        fill=""></path>
                </svg>
            </button>
            <div class="px-2 pr-14" >
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Edit Personal Information
                </h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                    Update your details to keep your profile up-to-date.
                </p>
            </div>
            <form class="flex flex-col" wire:submit.prevent="updateProfile">
                <div class="custom-scrollbar h-[450px] overflow-y-auto px-2" >
                    <div >
                        <h5 class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">
                            Social Links
                        </h5>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2" >
                            <div >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Facebook
                                </label>
                                <input type="text" wire:model="facebook"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>

                            <div >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    X.com
                                </label>
                                <input type="text" wire:model="twitter"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>

                            <div >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Linkedin
                                </label>
                                <input type="text" wire:model="linkedin"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>

                            <div >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Instagram
                                </label>
                                <input type="text" wire:model="instagram"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>
                        </div>
                    </div>
                    <div class="mt-7" >
                        <h5 class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">
                            Personal Information
                        </h5>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2" >
                            <div class="col-span-1 lg:col-span-1" >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Full Name
                                </label>
                                <input type="text" wire:model="name"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>


                            <div class="col-span-2 lg:col-span-1" >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Email Address
                                </label>
                                <input type="text" wire:model="email" disabled
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 disabled:bg-gray-100 disabled:cursor-not-allowed">
                            </div>

                            <div class="col-span-2 lg:col-span-1" >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Phone
                                </label>
                                <input type="text" wire:model="phone"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>
                             <div class="w-full px-2.5">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Date of Birth
                                </label>

                                <div class="relative">
                                    <div class="flatpickr-wrapper"><input type="text" placeholder="Select date"
                                            class="dark:bg-dark-900 datepickerTwo shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 flatpickr-input"
                                            >
                                        <div class="flatpickr-calendar animate static null" tabindex="-1">
                                            <div class="flatpickr-months"><span class="flatpickr-prev-month"><svg
                                                        class="stroke-current" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.25 6L9 12.25L15.25 18.5" stroke=""
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg></span>
                                                <div class="flatpickr-month">
                                                    <div class="flatpickr-current-month"><span
                                                            class="cur-month">October </span>
                                                        <div class="numInputWrapper"><input class="numInput cur-year"
                                                                type="number" tabindex="-1" aria-label="Year"><span
                                                                class="arrowUp"></span><span class="arrowDown"></span>
                                                        </div>
                                                    </div>
                                                </div><span class="flatpickr-next-month"><svg class="stroke-current"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.75 19L15 12.75L8.75 6.5" stroke=""
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg></span>
                                            </div>
                                            <div class="flatpickr-innerContainer">
                                                <div class="flatpickr-rContainer">
                                                    <div class="flatpickr-weekdays">
                                                        <div class="flatpickr-weekdaycontainer">
                                                            <span class="flatpickr-weekday">
                                                                Sun</span><span
                                                                class="flatpickr-weekday">Mon</span><span
                                                                class="flatpickr-weekday">Tue</span><span
                                                                class="flatpickr-weekday">Wed</span><span
                                                                class="flatpickr-weekday">Thu</span><span
                                                                class="flatpickr-weekday">Fri</span><span
                                                                class="flatpickr-weekday">Sat
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="flatpickr-days" tabindex="-1">
                                                        <div class="dayContainer"><span
                                                                class="flatpickr-day prevMonthDay"
                                                                aria-label="September 28, 2025"
                                                                tabindex="-1">28</span><span
                                                                class="flatpickr-day prevMonthDay"
                                                                aria-label="September 29, 2025"
                                                                tabindex="-1">29</span><span
                                                                class="flatpickr-day prevMonthDay"
                                                                aria-label="September 30, 2025"
                                                                tabindex="-1">30</span><span class="flatpickr-day"
                                                                aria-label="October 1, 2025"
                                                                tabindex="-1">1</span><span class="flatpickr-day"
                                                                aria-label="October 2, 2025"
                                                                tabindex="-1">2</span><span class="flatpickr-day"
                                                                aria-label="October 3, 2025"
                                                                tabindex="-1">3</span><span class="flatpickr-day"
                                                                aria-label="October 4, 2025"
                                                                tabindex="-1">4</span><span class="flatpickr-day"
                                                                aria-label="October 5, 2025"
                                                                tabindex="-1">5</span><span class="flatpickr-day"
                                                                aria-label="October 6, 2025"
                                                                tabindex="-1">6</span><span class="flatpickr-day"
                                                                aria-label="October 7, 2025"
                                                                tabindex="-1">7</span><span class="flatpickr-day"
                                                                aria-label="October 8, 2025"
                                                                tabindex="-1">8</span><span class="flatpickr-day"
                                                                aria-label="October 9, 2025"
                                                                tabindex="-1">9</span><span class="flatpickr-day"
                                                                aria-label="October 10, 2025"
                                                                tabindex="-1">10</span><span class="flatpickr-day"
                                                                aria-label="October 11, 2025"
                                                                tabindex="-1">11</span><span class="flatpickr-day"
                                                                aria-label="October 12, 2025"
                                                                tabindex="-1">12</span><span class="flatpickr-day"
                                                                aria-label="October 13, 2025"
                                                                tabindex="-1">13</span><span class="flatpickr-day"
                                                                aria-label="October 14, 2025"
                                                                tabindex="-1">14</span><span class="flatpickr-day"
                                                                aria-label="October 15, 2025"
                                                                tabindex="-1">15</span><span class="flatpickr-day"
                                                                aria-label="October 16, 2025"
                                                                tabindex="-1">16</span><span class="flatpickr-day"
                                                                aria-label="October 17, 2025"
                                                                tabindex="-1">17</span><span class="flatpickr-day"
                                                                aria-label="October 18, 2025"
                                                                tabindex="-1">18</span><span class="flatpickr-day"
                                                                aria-label="October 19, 2025"
                                                                tabindex="-1">19</span><span class="flatpickr-day"
                                                                aria-label="October 20, 2025"
                                                                tabindex="-1">20</span><span class="flatpickr-day"
                                                                aria-label="October 21, 2025"
                                                                tabindex="-1">21</span><span class="flatpickr-day"
                                                                aria-label="October 22, 2025"
                                                                tabindex="-1">22</span><span class="flatpickr-day"
                                                                aria-label="October 23, 2025"
                                                                tabindex="-1">23</span><span class="flatpickr-day"
                                                                aria-label="October 24, 2025"
                                                                tabindex="-1">24</span><span class="flatpickr-day"
                                                                aria-label="October 25, 2025"
                                                                tabindex="-1">25</span><span class="flatpickr-day"
                                                                aria-label="October 26, 2025"
                                                                tabindex="-1">26</span><span class="flatpickr-day"
                                                                aria-label="October 27, 2025"
                                                                tabindex="-1">27</span><span class="flatpickr-day"
                                                                aria-label="October 28, 2025"
                                                                tabindex="-1">28</span><span class="flatpickr-day"
                                                                aria-label="October 29, 2025"
                                                                tabindex="-1">29</span><span
                                                                class="flatpickr-day today"
                                                                aria-label="October 30, 2025" aria-current="date"
                                                                tabindex="-1">30</span><span class="flatpickr-day"
                                                                aria-label="October 31, 2025"
                                                                tabindex="-1">31</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 1, 2025"
                                                                tabindex="-1">1</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 2, 2025"
                                                                tabindex="-1">2</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 3, 2025"
                                                                tabindex="-1">3</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 4, 2025"
                                                                tabindex="-1">4</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 5, 2025"
                                                                tabindex="-1">5</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 6, 2025"
                                                                tabindex="-1">6</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 7, 2025"
                                                                tabindex="-1">7</span><span
                                                                class="flatpickr-day nextMonthDay"
                                                                aria-label="November 8, 2025" tabindex="-1">8</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span
                                        class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                fill=""></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="col-span-2" >
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Bio
                                </label>
                                <input type="text" wire:model="bio"
                                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end" >
                    <button @click="isProfileInfoModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Close
                    </button>
                    <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div x-show="isProfileAddressModal"
        class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;"
        >
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            ></div>
        <div @click.outside="isProfileAddressModal = false"
            class="no-scrollbar relative flex w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11"
            >
            <!-- close btn -->
            <button @click="isProfileAddressModal = false"
                class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                        fill=""></path>
                </svg>
            </button>

            <div class="px-2 pr-14" >
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Edit Address
                </h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                    Update your details to keep your profile up-to-date.
                </p>
            </div>
            <form class="flex flex-col" wire:submit.prevent="updateAddress">
                <div class="px-2 overflow-y-auto custom-scrollbar" >
                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2" >
                        <div >
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Country
                            </label>
                            <input type="text" wire:model="country"
                                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        </div>

                        <div >
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                City/State
                            </label>
                            <input type="text" wire:model="city"
                                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        </div>

                        <div >
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Postal Code
                            </label>
                            <input type="text" wire:model="postal_code"
                                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        </div>

                        <div >
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Full Address
                            </label>
                            <textarea type="text" wire:model="address" cols="10"
                                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-6 lg:justify-end" >
                    <button @click="isProfileAddressModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Close
                    </button>
                    <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
