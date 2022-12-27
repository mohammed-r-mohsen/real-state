
  
  @extends('admin.layouts.master')
    @section('content')
	<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
              <page-header :title="'{{$pageTitle}}'" :subtitle="'{{$pageSubTitle}}'"> </page-header>
              <users-chat></users-chat>


          </div>
        </div>
        </div>
        


        @push('js')
         <!-- glightbox js -->
            <script src="/assets/libs/glightbox/js/glightbox.min.js"></script>

            <!-- fgEmojiPicker js -->
             <script src="/assets/js/pages/chat.init.js"></script>
        @endpush
       

    @endsection