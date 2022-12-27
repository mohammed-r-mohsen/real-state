
  
  @extends('admin.layouts.master')
    @section('content')
	<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
              <page-header :title="'{{$pageTitle}}'" :subtitle="'{{$pageSubTitle}}'"> </page-header>
                    <all-nots :nots="{{$nots}}"></all-nots>
              
          </div>
        </div>
        </div>
        


       

    @endsection