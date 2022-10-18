@extends('../layouts/cms/main_cms')
@section('body_main')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Cms</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon-contain">
                                <div class="row">
                                    <div class="col-2 align-self-center">
                                        <i class="fas fa-tasks text-gradient-success"></i>
                                    </div>
                                    <div class="col-10 text-right">
                                        <h5 class="mt-0 mb-1">{{ \App\Models\Category::count() }}</h5>
                                        <p class="mb-0 font-12 text-muted">Category</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body justify-content-center">
                            <div class="icon-contain">
                                <div class="row">
                                    <div class="col-2 align-self-center">
                                        <i class="far fa-gem text-gradient-danger"></i>
                                    </div>
                                    <div class="col-10 text-right">
                                        <h5 class="mt-0 mb-1">{{ \App\Models\MasterMenu::count() }}</h5>
                                        <p class="mb-0 font-12 text-muted">Menu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{-- <div id='calendar' class="col-xl-12"></div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
    
    </script>
@endsection
