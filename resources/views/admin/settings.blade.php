
  
  @extends('admin.layouts.master')
    @section('content')
	<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
              <page-header :title="'{{$pageTitle}}'" :subtitle="'{{$pageSubTitle}}'"> </page-header>
              <settings :settings="{{settings()}}"></settings>
          </div>
        </div>
        </div>
        


       

    @endsection