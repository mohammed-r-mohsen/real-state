@extends('layouts.master')
@section('content')
<!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            
            <div class="page-content">
                <div class="container-fluid">
                   

                    <Reservation></Reservation>

  
        </div>
        </div>
        </div>
        <!-- end main content-->


        @push('js')
            <script src="/assets/js/pages/form-wizard.init.js"></script>
       
          <!-- autocomplete js -->
          <script src="/assets/js/pages/form-advanced.init.js"></script>
          <script src="/assets/js/pages/form-input-spin.init.js"></script>
          <script src="/assets/js/pages/form-pickers.init.js"></script>
          <script>
               $(document).ready(function(){


               $('#flatpicker').flatpickr({
                 "inline":true,
                 "disable": [
                  function(date) {
                    return (date.getDay() === 0 || date.getDay() === 6 );  // disable weekends
                  },
                  "2021-01-28", "2025-02-21", "2025-03-08",
              ],
              "locale": {
                  "firstDayOfWeek": 1 // set start day of week to Monday
              }
               })
                              })
         
             </script>
        @endpush

@endsection