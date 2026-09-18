<?php require BASE_PATH . '/resources/views/layout/header.php'; ?>

<div class="card-scroll w-full max-w-3xl max-h-[95vh] overflow-y-auto bg-white/80 backdrop-blur-sm rounded-[0.4rem] p-6 sm:p-8 shadow-[0_25px_45px_-12px_rgba(0,20,40,0.35),0_4px_12px_rgba(0,0,0,0.05)] border border-white/50">

    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#0b2b44] flex items-center justify-center gap-2 flex-wrap border-b-2 border-[#0b2b44]/10 pb-3 mb-6">
        Jago Bahasa
    </h1>

    <h2 class="text-lg sm:text-xl font-bold tracking-tight text-[#0b2b44] flex items-center gap-2 mt-2 mb-4">
        📋 Deadline Counter
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">

        <div class="flex flex-col gap-1.5">
            <label for="packageSelect" class="font-semibold text-sm text-[#1b3b57] tracking-wide flex items-center gap-1.5">
                📦 Paket belajar <i class="not-italic bg-[#d4e0eb] rounded-full px-2.5 text-[0.7rem] text-[#1b3b57]">durasi</i>
            </label>

            <select id="packageSelect" autocomplete="off" class="select-chevron w-full bg-white border border-[#d6e2ed] rounded-full px-5 py-2.5 text-sm font-medium text-[#0a263b] outline-none transition focus:border-[#2b6c9e] focus:ring-3 focus:ring-[#2b6c9e]/15 appearance-none bg-no-repeat bg-position-[right_1.2rem_center] bg-size-[14px] shadow-sm">
                <option value="" selected></option>
                <?php foreach ($packages as $key => $pkg): ?>
                    <option value="<?= e($key) ?>">Paket <?= e($pkg['label']) ?></option>
                <?php endforeach; ?>
            </select>

            <span class="text-[0.7rem] text-[#4b6f8b] pl-2.5">✧ pilih durasi paket</span>
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="startDate" class="font-semibold text-sm text-[#1b3b57] tracking-wide flex items-center gap-1.5">
                📅 Tanggal mulai <i class="not-italic bg-[#d4e0eb] rounded-full px-2.5 text-[0.7rem] text-[#1b3b57]">start</i>
            </label>

            <div class="bg-white border border-[#d6e2ed] rounded-full px-5 py-2.5 flex items-center gap-1.5 shadow-sm">
                <input type="date" id="startDate" autocomplete="off" class="border-none p-0 bg-transparent font-medium w-full outline-none text-[#0a263b] text-sm" />
            </div>

            <span class="text-[0.7rem] text-[#4b6f8b] pl-2.5">✧ hari pertama paket</span>
        </div>

    </div>

    <h2 class="text-lg sm:text-xl font-bold tracking-tight text-[#0b2b44] flex items-center gap-2 mt-6 mb-4">
        📊 Weekly Counter
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8 mt-6 sm:mt-8">

        <div class="flex flex-col gap-1.5">
            <label for="meetingInput" class="font-semibold text-sm text-[#1b3b57] tracking-wide flex items-center gap-1.5">
                📝 Meeting <i class="not-italic bg-[#d4e0eb] rounded-full px-2.5 text-[0.7rem] text-[#1b3b57]">number</i>
            </label>

            <input type="text" inputmode="numeric" pattern="[0-9]*" id="meetingInput" placeholder="contoh: 5" autocomplete="off" class="w-full bg-white border border-[#d6e2ed] rounded-full px-5 py-2.5 text-sm font-medium text-[#0a263b] outline-none transition focus:border-[#2b6c9e] focus:ring-3 focus:ring-[#2b6c9e]/15 shadow-sm placeholder:text-[#94a3b8]" />

            <span class="text-[0.7rem] text-[#4b6f8b] pl-2.5">✧ masukkan angka meeting</span>
        </div>

        <div class="flex flex-col gap-1.5">
            <div class="font-semibold text-sm text-[#1b3b57] tracking-wide flex items-center gap-1.5">
                📊 Week <i class="not-italic bg-[#d4e0eb] rounded-full px-2.5 text-[0.7rem] text-[#1b3b57]">result</i>
            </div>

            <div id="weekBox" class="w-full bg-white border border-[#d6e2ed] rounded-full px-5 py-2.5 text-sm font-medium text-[#0a263b] shadow-sm min-h-10.5 flex items-center">
                <span id="weekResult" class="text-[#5a7d99]">—</span>
            </div>

            <span class="text-[0.7rem] text-[#4b6f8b] pl-2.5">✧ otomatis dari meeting</span>
        </div>

    </div>

    <div class="flex flex-wrap items-center justify-between mt-8 gap-4">
        <div>
            <button id="resetBtn" class="bg-[#d4e0eb] text-[#134a70] border border-[#bccddb] px-9 py-3 rounded-full font-bold text-base cursor-pointer transition hover:bg-[#c4d3e1] active:scale-95 inline-flex items-center gap-2">↺ Reset</button>
        </div>

        <span class="bg-[#e6eef7] px-4 py-1 rounded-full text-[0.7rem] font-semibold text-[#1b4a6b]">berlaku H+7 · H+14 · H+30 · H+60</span>
    </div>

    <div id="resultBox" class="bg-[#f0f6fe] rounded-[1.8rem] p-6 mt-7 border border-[#d8e6f3] border-l-[6px] border-l-[#2b6c9e] shadow-inner flex flex-col gap-3">

        <div class="grid grid-cols-1 sm:grid-cols-[1fr_auto] items-center gap-4 text-base text-[#17334d] py-2.5 border-b border-dashed border-[#d3e0ed]">
            <div class="font-medium flex items-center gap-2">
                📌 Paket <strong id="resultPackage" class="font-bold">—</strong>
            </div>
            <div class="flex items-center justify-start sm:justify-end gap-2 flex-wrap">
                <span class="text-[#5a7d99] text-sm font-bold">• mulai :</span>
                <span id="resultStart" class="bg-white px-4 py-1.5 rounded-full font-bold text-sm border border-[#b6cfdf] text-[#0a263b] whitespace-nowrap">—</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-[1fr_auto] items-center gap-4 text-base text-[#17334d] py-2.5 border-b border-dashed border-[#d3e0ed]">
            <div class="font-medium flex items-center gap-2">✅ Batas normal paket belajar</div>
            <div class="flex items-center justify-start sm:justify-end gap-2 flex-wrap">
                <span class="text-[#5a7d99] font-semibold">:</span>
                <span id="resultNormalEnd" class="bg-white px-4 py-1.5 rounded-full font-bold text-sm border border-[#b6cfdf] text-[#0a263b] whitespace-nowrap">—</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-[1fr_auto] items-center gap-4 text-base text-[#17334d] py-2.5">
            <div class="font-medium flex items-center gap-2">⛔ Batas akhir paket (check-out)</div>
            <div class="flex items-center justify-start sm:justify-end gap-2 flex-wrap">
                <span class="text-[#5a7d99] font-semibold">:</span>
                <span id="resultDeadline" class="bg-[#d3e3f5] px-4 py-1.5 rounded-full font-bold text-sm border border-[#2b6c9e] text-[#0b2b44] whitespace-nowrap">—</span>
            </div>
        </div>

        <div id="resultNote" class="mt-1 text-[0.82rem] text-[#1a405b] bg-white/65 px-4 py-2 rounded-full border border-dashed border-[#b6cfdf] text-center">Silakan pilih paket dan tanggal mulai.</div>

    </div>

    <hr class="border-none border-t border-[#dbe3ed] mt-5 mb-1" />

    <div class="flex flex-wrap items-center justify-between gap-2">
        <span class="bg-[#e3ecf5] rounded-full px-4 py-1 text-[0.7rem] text-[#1f4b69] inline-block">📘 Contoh: paket 1 bulan start 16 Sep → deadline 30 Okt</span>
        <span class="bg-[#d5e3f0] rounded-full px-4 py-1 text-[0.7rem] text-[#1f4b69] inline-block">↳ paket 2 minggu → H+7</span>
    </div>

    <div class="text-[0.75rem] text-[#346185] mt-2.5 flex gap-5 flex-wrap">
        <span>📌 paket 2 minggu → H+7</span>
        <span>📌 1 bulan → H+14</span>
        <span>📌 2-5 bulan → H+30</span>
        <span>📌 6-12 bulan → H+60</span>
    </div>

</div>

<?php require BASE_PATH . '/resources/views/layout/footer.php'; ?>