<?php
if ($total > 0) {
    if (isset($options)) {
        $attr = '';
        if (isset($options['page'])) $attr .= " data-page=" . $options['page'];
    }
?>
    <div class="flex">
        <div class=" basis-full flex justify-center mt-[40px] mb-5">
            <a <?= trim($attr) ?> class='px-[40px] py-4 rounded-[8px] border border-[var(--html-bg-webiste)] transition-all duration-300 text-[var(--html-bg-website)] font-main text-[12px] font-bold leading-none tracking-[1.8px] uppercase hover:bg-[var(--html-bg-website)] cursor-pointer hover:text-white flex justify-center items-center gap-2 view__load  ' title='Xem thêm'>
                <span>
                    <?= "Xem thêm" ?> <span><?= $total ?></span> <?= $title ?>
                </span>
                <div class="">
                    <i class='fa fa-chevrons-down mr-1 '></i>
                </div>
            </a>
            <div class="rp-loader w-[40px] hidden h-[40px] m-auto p-1 animate-[rotate_2s_linear_infinite]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" style="width: 100%; height: 100%; fill: var(--html-bg-website);">
                    <circle r="80" cx="500" cy="90" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="500" cy="910" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="90" cy="500" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="910" cy="500" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="212" cy="212" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="788" cy="212" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="212" cy="788" style="fill: var(--html-bg-website);"></circle>
                    <circle r="80" cx="788" cy="788" style="fill: var(--html-bg-website);"></circle>
                </svg>
            </div>
        </div>
    </div>
<?php
}
?>