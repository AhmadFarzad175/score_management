@props(['page'])
<!DOCTYPE html>
<html>

<head>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Score Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" />

    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.css') }}">
    <!-- my style -->
    <link rel="stylesheet" href="{{ asset('dist/css/myCss.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('assets/plugins/twitter-bootstrap-wizard/form-wizard.css') }}" />
    <style>
        body {
            background-image: url("{{ asset('imge/bg6.jpg') }}") !important;
            background-size: cover;
        }
    </style>
</head>




<body class="hold-transition">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white best-shadow">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 1 ? 'active' : '' }}"
                            href="{{ route('classes.index') }}">Class</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 2 ? 'active' : '' }}"
                            href="{{ route('students.index') }}">Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 3 ? 'active' : '' }}"
                            href="{{ route('attendances.index') }}">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 4 ? 'active' : '' }}"
                            href="{{ route('subjects.index') }}">Subject</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 5 ? 'active' : '' }}"
                            href="{{ route('scores.index') }}">Score</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 6 ? 'active' : '' }}"
                            href="/results">Result</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper mx-2">
            <!-- Main content -->
            <section class="row">
                <div class="col-12">
                    {{ $slot }}
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>

    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- page script -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('dist/js/message.js') }}"></script>

    <script src="{{ asset('assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ asset('assets/plugins/twitter-bootstrap-wizard/form-wizard.js') }}"></script>


    @if (session('success'))
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif ($errors->any())
        <script type="text/javascript">
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            });
        </script>
    @endif








    <!-- Select2 FOR SELECT ELEMENT -->
    <script src="../../plugins/select2/js/select2.full.min.js"></script>

    <!-- Page script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    @if ($page == 2 || $page == 3 || $page == 5 || $page == 6)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const currentYear = new Date().getFullYear();
                const startYear = currentYear - 10; // Adjust as necessary
                const endYear = currentYear + 10; // Adjust as necessary
                let select = document.getElementById('year-picker');

                // Assuming this value is set by your server-side logic
                let selectedYear = "{{ request('year') }}";

                for (let year = startYear; year <= endYear; year++) {
                    let isSelected = year == selectedYear ? 'selected' : '';
                    select.innerHTML += `<option ${isSelected} value="${year}">${year}</option>`;
                }

                // Select the current year by default if no year is selected
                if (!selectedYear) {
                    select.value = currentYear;
                }
            });
        </script>
    @endif


</body>

</html>
