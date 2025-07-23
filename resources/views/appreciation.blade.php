@extends('layout.layout')

@php
    $title='Penghargaan';
    $subTitle = 'Penghargaan';
    $script= '<script src="' . asset('assets/js/homeOneChart.js') . '"></script>';
@endphp

@section('content')
    <section class="flex items-center justify-center">
        <div class="grid grid-cols-3 p-0 dots-style-circle dots-positioned gap-4 items-center" style="width: 75%">
            
            {{-- 2st  --}}
            <div>
                <div class="user-grid-card">
                    <div class="appreciation-winner-card py-8 relative flex items-center justify-center border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                        
                        <div>
                            <p class="text-xs font-neutral-600 text-center mb-2 mt-2">
                                2nd Top Performer
                            </p>
                            <img src="{{ asset('assets/images/user-grid/user-grid-img1.png') }}" alt="" class="border br-white border-width-2-px w-[100px] h-[100px] ms-auto me-auto rounded-full object-fit-cover">
                            <h6 class="text-lg text-center mb-2 mt-2">
                                {{ $top->get(1)->name }}
                            </h6>
                            <p class="text-2xl text-primary-600 font-semibold text-center mb-2 mt-2">
                                {{ $top->get(1)->points }}
                                pts
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 1nd --}}
            <div>
                <div class="user-grid-card">
                    <div style="border-width: 5px; border-color: #FFD700" class="appreciation-winner-card py-16 relative bg-white flex items-center justify-center border rounded-2xl overflow-hidden p-4">
                        
                        <div>
                            <p class="text-base font-semibold text-center mb-2 mt-2">
                                1st Top Performer
                            </p>

                            <img src="{{ asset('assets/images/user-grid/user-grid-img1.png') }}" alt="" class="border br-white border-width-2-px w-[100px] h-[100px] ms-auto me-auto rounded-full object-fit-cover">
                            
                            <h6 class="text-lg text-center mb-2 mt-2">
                                {{ $top->get(0)->name }}
                            </h6>
                            <p class="text-2xl text-primary-600 font-semibold text-center mb-2 mt-2">
                                {{ $top->get(0)->points }}
                                pts
                            </p>
                            <div class="flex items-center justify-center">
                                <p class="text-center bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-base mt-6" style="width: fit-content">Congratulation!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3rd --}}
            <div>
                <div class="user-grid-card">
                    <div style="border-width: 5px; border-color: #CD7F32" class="appreciation-winner-card py-8 relative bg-white flex items-center justify-center border rounded-2xl overflow-hidden p-4">
                        
                        <div>
                            <p class="text-xs font-neutral-600 text-center mb-2 mt-2">
                                3rd Top Performer
                            </p>
                            <img src="{{ asset('assets/images/user-grid/user-grid-img1.png') }}" alt="" class="border br-white border-width-2-px w-[100px] h-[100px] ms-auto me-auto rounded-full object-fit-cover">
                            <h6 class="text-lg text-center mb-2 mt-2">
                                {{ $top->get(2)->name }}
                            </h6>
                            <p class="text-2xl text-primary-600 font-semibold text-center mb-2 mt-2">
                                {{ $top->get(2)->points }}
                                pts
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="card h-full mt-6 rounded-xl border-0 overflow-hidden">
        <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-base font-medium text-secondary-light mb-0">Peringkat Peserta</span>                
            </div>
        </div>
        <div class="card-body p-6">
            <table id="appreciation-ranking-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                <thead>
                    <tr>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="form-check style-check flex items-center">
                                <input class="form-check-input" id="serial" type="checkbox">
                                <label class="ms-2 form-check-label" for="serial">
                                    Peringkat
                                </label>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Nama Pengguna
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Point
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Departemen
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        
                    <tr>
                        <td>
                            <div class="form-check style-check flex items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="ms-2 form-check-label">
                                    #{{ $index + 4 }}
                                </label>
                            </div>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->points }}
                        </td>
                        <td>
                            {{ $user->department }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <section class="mt-8">
        <h2 class="text-2xl text-center text-primary-600 py-4">Bagaimana Cara Mendapatkan Point?</h2>

        <div class="flex items-center justify-center">
            <div class="grid grid-cols-2 p-0 dots-style-circle dots-positioned gap-4 items-center" style="width: 75%">
            
                <div>
                    <div class="user-grid-card">
                        <div class="appreciation-info-card relative bg-white border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                            
                            <div class="flex items-center gap-4">
                                <div class="btn bg-primary-600 hover:bg-primary-700 text-white rounded-lg px-3.5 py-2 text-sm flex items-center gap-2 justify-center">
                                    <iconify-icon icon="mingcute:task-2-line" class="text-xl"></iconify-icon>
                                </div>
                                <h6 class="text-2xl font-semibold text-center mb-2 mt-2">
                                    Poin Kehadiran
                                </h6>
                            </div>

                            <p class="text-base mb-2 mt-2">
                                Dapatkan poin dengan secara konsisten menghadiri jalan kaki Gemba dan berpartisipasi dalam aktivitas harian.
                            </p>

                            <p class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-md font-medium text-base mb-2">
                                Menghadiri Gemba = +10
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="user-grid-card">
                        <div class="appreciation-info-card relative bg-white border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                            
                            <div class="flex items-center gap-4">
                                <div class="btn bg-primary-600 hover:bg-primary-700 text-white rounded-lg px-3.5 py-2 text-sm flex items-center gap-2 justify-center">
                                    <iconify-icon icon="mdi:brain" class="text-xl"></iconify-icon>
                                </div>
                                <h6 class="text-2xl font-semibold text-center mb-2 mt-2">
                                    Analisa Akar Masalah
                                </h6>
                            </div>

                            <p class="text-base mb-2 mt-2">
                                Kirimkan analisis akar masalah berkualitas tinggi untuk mendapatkan poin berdasarkan kedalaman dan dampaknya.
                            </p>

                            <p class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-md font-medium text-base mb-2">
                                Memberikan Akar Masalah = +1 hingga +100
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-8">

        <div class="flex items-center justify-center">
            <div class="grid grid-cols-2 p-0 dots-style-circle dots-positioned gap-4 items-center" style="width: 75%">
            
                <div class="col-span-2">
                    <div class="user-grid-card">
                        <div class="appreciation-info-card relative bg-white border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                            
                            <div class="flex items-center justify-center gap-2">
                                <div class="btn text-primary-600 rounded-lg px-3.5 py-2 text-sm flex items-center gap-2 justify-center">
                                    <iconify-icon icon="mdi:clock" class="text-2xl"></iconify-icon>
                                </div>
                                <h6 class="text-2xl font-semibold text-center mb-2 mt-2">
                                    Poin Akan Direset Setiap Bulannya
                                </h6>
                            </div>

                            <p class="text-base mb-2 mt-2 text-center">
                                Untuk menjaga kompetisi tetap segar dan adil, semua poin akan di-reset pada tanggal 1 setiap bulannya. Bersiaplah untuk mengklaim tempat Anda lagi di papan peringkat berikutnya!
                            </p>

                            <div class="text-center mb-4">
                                <p class="text-gray-700 text-base font-medium mb-2">Reset Selanjutnya:</p>
                                <div id="countdown" class="flex justify-center items-baseline text-blue-600 font-bold text-2xl">
                                    <span id="days" class="mx-2">00 Hari</span>
                                    <span> : </span>
                                    <span id="hours" class="mx-2">00 Jam</span>
                                    <span> : </span>
                                    <span id="minutes" class="mx-2">00 Menit</span>
                                    {{-- <span id="seconds" class="mx-1 text-base">00 Seconds</span> Optional: uncomment if you want seconds --}}
                                </div>
                            </div>
                        
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                <div id="progress-bar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                            <p id="progress-text" class="text-center text-sm text-gray-500">0% dari [Current Month] telah selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('user-script')
<script src="{{ asset('assets/js/data-table/appreciation-ranking.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countdownElement = document.getElementById('countdown');
        const daysElement = document.getElementById('days');
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        // const secondsElement = document.getElementById('seconds'); // Uncomment if you want seconds
    
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
    
        function updateCountdownAndProgress() {
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth(); // 0-indexed (0 for Jan, 11 for Dec)
    
            // Calculate the 1st day of the next month
            let nextResetDate = new Date(year, month + 1, 1);
    
            // If it's already the 1st of the current month and after the reset time,
            // it means the reset happened, so the next one is next month.
            // This logic assumes reset happens precisely at 00:00:00 on the 1st.
            // If your reset has a specific time of day, you'll need to adjust.
            if (now.getDate() === 1 && now.getTime() > nextResetDate.setHours(0,0,0,0)) {
                // If current time is past 1st of current month, next reset is 1st of next month
                nextResetDate = new Date(year, month + 2, 1); // Go to month + 2 for the correct next month
            } else if (now.getDate() > 1) {
                 // If it's after the 1st, the next reset is 1st of next month
                 nextResetDate = new Date(year, month + 1, 1);
            } else {
                // If it's the 1st and before the reset time, or if it's the 31st/30th,
                // then the next reset is the 1st of the current month (which will be in the future).
                // This case handles when 'now' is *before* the current month's reset.
                // Example: Today is June 10th, next reset is July 1st.
                // Example: Today is May 30th, next reset is June 1st.
                nextResetDate = new Date(year, month + 1, 1);
            }
    
            // --- Countdown Logic ---
            const distance = nextResetDate - now;
    
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            // const seconds = Math.floor((distance % (1000 * 60)) / 1000); // Uncomment if you want seconds
    
            daysElement.textContent = `${String(days).padStart(2, '0')} Hari`;
            hoursElement.textContent = `${String(hours).padStart(2, '0')} Jam`;
            minutesElement.textContent = `${String(minutes).padStart(2, '0')} Menit`;
            // if (secondsElement) secondsElement.textContent = `${String(seconds).padStart(2, '0')} Seconds`; // Uncomment if you want seconds
    
            // If the countdown is finished, display a message
            if (distance < 0) {
                clearInterval(countdownInterval);
                countdownElement.innerHTML = '<span class="text-green-600">Poin Telah Direset!</span>';
                progressBar.style.width = '100%';
                progressText.textContent = 'Saatnya Ganti Bulan';
                return; // Stop further execution for this interval
            }
    
            // --- Progress Bar Logic ---
            const firstDayOfCurrentMonth = new Date(year, month, 1);
            const firstDayOfNextMonth = new Date(year, month + 1, 1);
    
            const totalMonthDuration = firstDayOfNextMonth - firstDayOfCurrentMonth;
            const elapsedMonthDuration = now - firstDayOfCurrentMonth;
    
            let percentageCompleted = (elapsedMonthDuration / totalMonthDuration) * 100;
            percentageCompleted = Math.min(100, Math.max(0, percentageCompleted)); // Clamp between 0 and 100
    
            progressBar.style.width = `${percentageCompleted}%`;
            
            const currentMonthName = new Date(year, month, 1).toLocaleString('id-ID', { month: 'long' });
            progressText.textContent = `${Math.round(percentageCompleted)}% dari ${currentMonthName} telah selesai`;
        }
    
        // Update every minute (or every second if you include seconds in the countdown)
        updateCountdownAndProgress(); // Call immediately to avoid initial blank
        const countdownInterval = setInterval(updateCountdownAndProgress, 60 * 1000); // Update every minute
        // If you enable seconds: setInterval(updateCountdownAndProgress, 1000);
    });
    </script>
    
@endsection