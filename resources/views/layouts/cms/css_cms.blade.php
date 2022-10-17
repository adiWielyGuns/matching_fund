<!-- DataTables -->
<link href="{{ asset('assets/cms/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/cms/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/cms/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/cms/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css">

{{-- Summernote --}}
<link href="{{ asset('assets/cms/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/cms/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/cms/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/cms/css/style.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
{{-- Dropify --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Full Calendar --}}
<link href="{{ asset('assets/cms/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />

<style>
    .is-invalid {
        border: 1px solid red;
    }

    .alertify-logs {
        z-index: 99999999999999999999999999999999999999999999999999999;
    }

    .pointer {
        cursor: pointer !important;
    }

    .loading {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, .5);
        z-index: 99999999999999999999999999999999;
        display: none;
    }

    .loading-wheel {
        width: 20px;
        height: 20px;
        margin-top: -40px;
        margin-left: -40px;

        position: absolute;
        top: 50%;
        left: 50%;

        border-width: 30px;
        border-radius: 50%;
        -webkit-animation: spin 1s linear infinite;
    }

    .style-2 .loading-wheel {
        border-style: double;
        border-color: #ccc transparent;
    }

    .spinner-loading {
        top: 50% !important;
        left: 50%;
    }

    tr.active td {
        background-color: #605daf;
        color: white
    }

    tr.active td a {
        background-color: #605daf;
        color: white
    }

    .cms-item{
        cursor: pointer;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0);
        }

        100% {
            -webkit-transform: rotate(-360deg);
        }
    }
</style>
