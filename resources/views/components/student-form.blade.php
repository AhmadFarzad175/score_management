{{-- <div class="modal" id="modal-lg" style="display: block"> --}}
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <!-- form start -->
                <form action="{{ route('students.store') }}" enctype="multipart/form-data" method="POST"
                    class="d-flex justify-content-between col-12 flex-wrap">
                    @csrf
                    {{-- image --}}
                    <div class="col-6 col-lg-4">
                        <div class="best-shadow headImageContainer" id="headImageContainerCreate"
                            onclick="showFileInput('fileInputCreate')">
                            <i class="fas fa-user-edit text-white text-sm user_edit best-shadow"></i>
                            <img id="headImageCreate" class="img-fluid headImage"
                                src="{{ asset('imge/default_image.jpeg') }}">
                        </div>
                        <input type="file" name="image" id="fileInputCreate" style="display: none;"
                            onchange="handleFileSelect('fileInputCreate', 'headImageCreate')"
                            value="{{ 'imge/default_image.jpeg' }}">
                    </div>

                    <div class="col-6 col-lg-4">
                        {{-- FIRSTNAME --}}
                        <div class="form-group mb-3">
                            <label for="firstname">First name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="firstname" class="form-control">

                        </div>

                        {{-- En: firstname --}}
                        <div class="form-group mb-3">
                            <label for="firstname_en">En: First name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name_en" id="firstname_en" class="form-control">

                        </div>

                    </div>

                    <div class="col-12 justify-content-between col-lg-4 d-flex d-lg-block">
                        {{-- LASTNAME --}}
                        <div class="form-group mb-3" style="margin-right: 10px">
                            <label for="lastname">Last name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="lastname" class="form-control">

                        </div>

                        {{-- EN:LASTNAME --}}
                        <div class="form-group mb-3">
                            <label for="lastname_en">En: Last name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name_en" id="lastname" class="form-control">

                        </div>

                    </div>







                    <div class="form-group col-6 col-lg-4">
                        <label for="fathername">Father name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" id="fathername" class="form-control">
                    </div>

                    <div class="form-group col-6 col-lg-4">
                        <label for="fathername_en">En: Father name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name_en" id="fathername_en" class="form-control">
                    </div>

                    <div class="form-group col-6 col-lg-4">
                        <label for="grand_father">Grand Father name <span class="text-danger">*</span></label>
                        <input type="text" name="grand_father" id="grand_father" class="form-control">
                    </div>

                    <div class="form-group col-6 col-lg-4">
                        <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                        <input name="dob" type="date" id="dob" class="form-control">
                    </div>




                    <div class="form-group col-6 col-lg-4">
                        <label>Class <span class="text-danger">*</span></label>
                        <select name="classs_id" class="form-control classSelect" id="class">
                            @foreach ($classes as $class)
                                <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                    value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-6 col-lg-4">
                        <label for="base">Year <span class="text-danger">*</span></label>
                        <select class="form-control" name="year" id="year-picker-create">
                        </select>
                    </div>

                    <div class="form-group col-6 col-lg-4">
                        <label for="base">Base Number <span class="text-danger">*</span></label>
                        <input name="base_number" type="text" id="base" class="form-control">
                    </div>


                    <div class="form-group col-6 col-lg-4">
                        <label for="tazkira">Tazkira Number <span class="text-danger">*</span></label>
                        <input name="tazkira_number" type="text" id="tazkira" class="form-control">
                    </div>


                    <div class="form-group col-6 col-lg-4">
                        <label for="main">Main residence <span class="text-danger">*</span></label>
                        <select name="main_residence" class="form-control mainSelect" id="main">
                            @foreach ($provinces as $province)
                                <option {{ request('classs_id') == $province->id ? 'selected' : '' }}
                                    value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer ">
                        <div class="student-submit text-left">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>

                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
