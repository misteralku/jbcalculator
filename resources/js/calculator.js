(function () {
    const { packages, meetingsPerWeek, durationOffsetDays } = window.APP_CONFIG;

    const $ = (id) => document.getElementById(id);
    const packageSelect = $('packageSelect');
    const startDateInput = $('startDate');
    const meetingInput = $('meetingInput');
    const resetBtn = $('resetBtn');
    const weekBox = $('weekBox');
    const weekResult = $('weekResult');
    const resultPackage = $('resultPackage');
    const resultStart = $('resultStart');
    const resultNormalEnd = $('resultNormalEnd');
    const resultDeadline = $('resultDeadline');
    const resultNote = $('resultNote');

    const DEFAULT_NOTE = 'Silakan pilih paket dan tanggal mulai.';
    const DAYS = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    function formatDate(date) {
        if (!date || isNaN(date.getTime())) return '—';
        return `${DAYS[date.getDay()]}, ${date.getDate()} ${MONTHS[date.getMonth()]} ${date.getFullYear()}`;
    }

    function addDays(date, days) {
        const d = new Date(date);
        d.setDate(d.getDate() + days);
        return d;
    }

    function clearDeadlineResults(note = DEFAULT_NOTE) {
        resultPackage.textContent = '—';
        resultStart.textContent = '—';
        resultNormalEnd.textContent = '—';
        resultDeadline.textContent = '—';
        resultNote.textContent = note;
    }

    function calculateDeadline() {
        const pkg = packages[packageSelect.value];
        const startStr = startDateInput.value;

        if (!pkg || !startStr) {
            clearDeadlineResults();
            return;
        }

        const startDate = new Date(startStr + 'T00:00:00');
        if (isNaN(startDate.getTime())) {
            clearDeadlineResults('Silakan pilih tanggal mulai.');
            return;
        }

        const normalEnd = addDays(startDate, pkg.weeks * 7 + durationOffsetDays);
        const deadline = addDays(normalEnd, pkg.extension);

        resultPackage.textContent = pkg.label;
        resultStart.textContent = formatDate(startDate);
        resultNormalEnd.textContent = formatDate(normalEnd);
        resultDeadline.textContent = formatDate(deadline);
        resultNote.textContent = 'Sisa pertemuan akan hangus apabila masa berlaku (check out) paket telah berakhir.';
    }

    function setWeekActive(active) {
        weekBox.classList.toggle('bg-white', !active);
        weekBox.classList.toggle('border-[#d6e2ed]', !active);
        weekBox.classList.toggle('bg-[#d3e3f5]', active);
        weekBox.classList.toggle('border-[#2b6c9e]', active);
    }

    function calculateWeek() {
        const val = meetingInput.value.trim();

        if (val === '' || isNaN(val) || Number(val) < 1) {
            weekResult.textContent = '—';
            weekResult.className = 'text-[#5a7d99]';
            setWeekActive(false);
            return;
        }

        const week = Math.ceil(Math.floor(Number(val)) / meetingsPerWeek);
        weekResult.textContent = `Week ${week}`;
        weekResult.className = 'text-[#0b2b44] font-bold';
        setWeekActive(true);
    }

    function resetToDefault() {
        packageSelect.value = '';
        startDateInput.value = '';
        meetingInput.value = '';
        clearDeadlineResults();
        calculateWeek();
    }

    resetBtn.addEventListener('click', resetToDefault);
    [packageSelect, startDateInput].forEach((el) => {
        el.addEventListener('change', calculateDeadline);
        el.addEventListener('input', calculateDeadline);
    });
    meetingInput.addEventListener('input', calculateWeek);
    window.addEventListener('pageshow', resetToDefault);

    resetToDefault();
})();