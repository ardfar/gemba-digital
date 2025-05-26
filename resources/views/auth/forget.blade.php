<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<x-head />  

<body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">

    @include('sweetalert::alert')

    <section class="bg-white dark:bg-neutral-700 flex flex-wrap min-h-[100vh]">
        <div class="lg:w-1/2 lg:block hidden">
            <div class="flex items-center flex-col h-full justify-center">
                <img src="{{ asset('assets/images/auth/forgot-pass-img.png') }}" alt="">
            </div>
        </div>
        <div class="lg:w-1/2 py-8 px-6 flex flex-col justify-center">
            <div class="lg:max-w-[464px] mx-auto w-full">
                <div>
                    <h4 class="mb-3">Lupa Kata Sandi</h4>
                    <p class="mb-8 text-secondary-light text-lg">Masukan alamat email akun Anda untuk mengirimkan link untuk mengatur ulang kata sandi Anda.</p>
                </div>
                <form action="{{ route('auth.forget.attempt') }}" method="POST">
                    <div class="icon-field mb-6 relative">
                        @csrf
                        <span class="absolute start-4 top-1/2 -translate-y-1/2 pointer-events-none flex text-xl">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" id="email" class="form-control h-[56px] ps-11 border-neutral-300 bg-neutral-50 dark:bg-neutral-600 rounded-xl" placeholder="Email">
                    </div>
                    {{-- <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="btn btn-primary justify-center text-sm btn-sm px-3 py-4 w-full rounded-xl"> Kirim Link Verifikasi</button> --}}
                    <button type="submit" class="btn btn-primary justify-center text-sm btn-sm px-3 py-4 w-full rounded-xl"> Kirim Link Verifikasi</button>

                    <div class="text-center">
                        <a href="{{ route('auth.login') }}" class="text-primary-600 font-bold mt-6 hover:underline">Kembali ke Halaman Masuk</a>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <x-script/>

    {{-- <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-10 w-full max-w-[496px] max-h-full rounded-2xl bg-white dark:bg-neutral-700">
            <button type="button" class="absolute top-4 end-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Tutup</span>
            </button>
            <div class="p-2.5 text-center">
                <div class="mb-8 inline-flex">
                    <img src="{{ asset('assets/images/auth/envelop-icon.png') }}" alt="">
                </div>
                <h6 class="mb-3">Cek Inbox Email Anda</h6>
                <p class="text-secondary-light text-sm mb-0">Terima Kasih, instruksi untuk atur ulang kata sandi anda sudah dikirim ke Email Anda.</p>
                <button type="button" class="btn btn-primary justify-center text-sm btn-sm px-3 py-4 w-full rounded-xl mt-8">Oke</button>
                <div class="mt-8 text-sm">
                    <p class="mb-0">Tidak Menerima Email? <a href="javascript:void(0)" class="text-primary-600 font-semibold">Kirim Ulang</a></p>
                </div>
            </div>
        </div>
    </div> --}}



</body>
</html>
