<section class="section_default">
    <div class="grid_admin wide">
        <div class="w-full flex bg-slate-100 max-w-full">
            <div class="form_all_menu_admin group/form_all_menu_admin h-[initial] flex-initial ">
                <div class="action_menu_admin group-[&.active]/form_all_menu_admin:opacity-70 group-[&.active]/form_all_menu_admin:pointer-events-auto fixed top-0 left-0 w-[100vw] h-[100vh] bg-black pointer-events-none opacity-0 z-[30] transition-all duration-300 delay-200"></div>
                <div class="  fixed group-[&.active]/form_all_menu_admin:translate-x-0 lg:sticky top-0 left-0 -translate-x-full lg:translate-x-0 z-40 transition-all duration-300 ">
                    <?php include_once _form . "left_tpl.php" ?>
                </div>
            </div>
            <div class="flex-1 max-w-full">
                <?php include_once _form . "header_tpl.php" ?>
                <?php include_once _layouts . $template . "_tpl.php" ?>
            </div>
        </div>
    </div>
</section>