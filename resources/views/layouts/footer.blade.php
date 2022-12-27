


        <!--Scroll to top-->
        {{-- <button class="scroll-top scroll-to-target" data-target="html">
            <span class="ri-arrow-up-line"></span>
        </button> --}}
    </div>

<script>
        window.trans = <?php
        // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
        $lang_files = File::files(resource_path() . '/lang/' . session('lang'));
        $trans = [];
        foreach ($lang_files as $f) {
            $filename = pathinfo($f)['filename'];
            $trans[$filename] = trans($filename);
        }
        echo json_encode($trans);
        ?>;
    </script>
    <!-- jequery plugins -->
    <script src="/js/app.js"></script>
    <script src="/assets2/js/jquery.js"></script>
    <script src="/assets2/js/wow.js"></script>
    <!-- main-js -->
    <script src="/assets2/js/script.js"></script>

</body><!-- End of .page_wrapper -->

</html>
