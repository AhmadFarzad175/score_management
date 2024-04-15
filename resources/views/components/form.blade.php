<form id="studentForm" action="{{ isset($method) ? route('students.update', $students->id) : route('students.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    @if(isset($method))
        @method('PUT')
    @endif

<div class="row">
    <div class="col-12 col-sm-8 mt-4">
        <div class="form-group local-forms">
            <label for="firstname">First name <span class="text-danger">*</span></label>
            <input value="{{ old('first_name', optional($student ?? null)->first_name) }}" type="text"
                name="first_name" id="firstname" class="form-control" placeholder="Ahmad Farzad">
        </div>
        <div class="form-group local-forms">
            <label for="lastname">Last name <span class="text-danger">*</span></label>
            <input value="{{ old('last_name', optional($student ?? null)->last_name) }}" type="text" name="last_name"
                id="lastname" class="form-control" placeholder="Hakimi">
        </div>

        <div class="form-group local-forms">
            <label for="fathername">Father name <span class="text-danger">*</span></label>
            <input value="{{ old('father_name', optional($student ?? null)->father_name) }}" type="text"
                name="father_name" id="fathername" class="form-control">
        </div>
    </div>

    <div class="col-12 col-sm-1">
    </div>

    <div class="col-12 col-sm-2">
        <div class="container form-group local-forms">
            <div class="best-shadow" id="headImageContainer" onclick="showFileInput()">
                <img id="headImage" class="img-fluid" src="{{ asset('images/default_image.jpeg') }}"
                    alt="Default Image">
            </div>
            <input type="file" name="image" required id="fileInput" style="display: none;"
                onchange="handleFileSelect()" value="{{ old('image', 'images/default_image.jpeg') }}">
        </div>
    </div>
    <div class="col-12 col-sm-1">
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
            <input value="{{ old('dob', optional($student ?? null)->dob) }}" name="dob" type="date"
                id="dob" class="form-control">
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Class <span class="text-danger">*</span></label>
            <select name="classs_id" class="form-control" id="class">
                {{-- @foreach ($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ old('class', optional($student ?? null)->classs_id) == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}</option>
                @endforeach --}}
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label for="base">Base Number <span class="text-danger">*</span></label>
            <input value="{{ old('base_number', optional($student ?? null)->base_number) }}" name="base_number"
                type="text" id="base" class="form-control">
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label for="tazkira">Tazkira Number <span class="text-danger">*</span></label>
            <input value="{{ old('tazkira', optional($student ?? null)->tazkira_number) }}" name="tazkira_number"
                type="text" id="tazkira" class="form-control">
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label for="current">Current residence <span class="text-danger">*</span></label>
            <select name="current_residence" class="form-control" id="current">
                {{-- @foreach ($provinces as $province)
                    <option value="{{ $province->id }}"
                        {{ old('current_residence', optional($student ?? null)->current_residence) == $province->id ? 'selected' : '' }}>
                        {{ $province->name }}</option>
                @endforeach --}}
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label for="main">Main residence <span class="text-danger">*</span></label>
            <select name="main_residence" class="form-control" id="main">
                {{-- @foreach ($provinces as $province)
                    <option value="{{ $province->id }}"
                        {{ old('main_residence', optional($student ?? null)->main_residence) == $province->id ? 'selected' : '' }}>
                        {{ $province->name }}</option>
                @endforeach --}}
            </select>
        </div>
    </div>

    <div class="col-12">
        <div class="student-submit">
            <button type="submit" class="btn btn-primary">{{ isset($method) ? 'Update' : 'Create' }}</button>
        </div>
    </div>
</div>
</form>
