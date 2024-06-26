<div class="modal fade" id="modal-lg" >
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
                    style="display: flex; flex-wrap: wrap;">
                    @csrf
                    @if (isset($method))
                        @method('PUT')
                    @endif
                    {{-- image --}}
                    <div class="form-group col-3" style="position: relative">
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
                    <div class="form-group col-12 d-flex flex-wrap">


                       


                        {{-- FIRSTNAME --}}
                        <div class="form-group firstname mb-3 col-md-4">
                            <label for="firstname">First name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="firstname" class="form-control">

                        </div>

                        <div class="d-none d-md-block col-md-1">
                        </div>

                        <div class="firstname mb-3 col-md-4">
                            <label for="firstname">En:First name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="firstname" class="form-control">

                        </div>

                        {{-- LASTNAME --}}
                        <div class="lastname col-md-4">
                            <label for="lastname">Last name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="lastname" class="form-control">

                        </div>


                        


                        
                    </div>





                    <div class="form-group col-12 col-md-6">
                        <label for="fathername">Father name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" id="fathername" class="form-control">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                        <input name="dob" type="date" id="dob" class="form-control">
                    </div>




                    <div class="form-group col-12 col-md-6">
                        <label>Class <span class="text-danger">*</span></label>
                        <select name="classs_id" class="form-control classSelect" id="class">
                            @foreach ($classes as $class)
                                <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                    value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label for="base">Year <span class="text-danger">*</span></label>
                        <select class="form-control" name="year" id="year-picker-create">
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label for="base">Base Number <span class="text-danger">*</span></label>
                        <input name="base_number" type="text" id="base" class="form-control">
                    </div>


                    <div class="form-group col-12 col-md-6">
                        <label for="tazkira">Tazkira Number <span class="text-danger">*</span></label>
                        <input name="tazkira_number" type="text" id="tazkira" class="form-control">
                    </div>


                    <div class="form-group col-12 col-md-6">
                        <label for="main">Main residence <span class="text-danger">*</span></label>
                        <select name="main_residence" class="form-control mainSelect" id="main">
                            @foreach ($provinces as $province)
                                <option {{ request('classs_id') == $province->id ? 'selected' : '' }}
                                    value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>

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
