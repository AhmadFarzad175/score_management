@props(['route'])
<form action="{{ route('attendances.' .$route) }}">
    @csrf
    <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
        <div class="col-12 col-sm-8 col-md-18 d-flex justify-content-between">
            <div class="input-group h45px">
                <div class="input-group-prepend">
                    <button type="button" class="btn-primary input_radious_left h45px">Class</button>
                    <select class="form-control select2 input_radious_none w-200 h45px" name="classs_id" id="classs">
                        @foreach ($classes as $class)
                            <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                value="{{ $class->id }}">{{ $class->name . ' ' . $class->year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="input-group h45px">
                <div class="input-group-prepend">
                    <button type="button" class="btn-primary input_radious_left h45px">Year</button>
                    <select class="form-control select2 input_radious_none w-200 h45px" name="year" id="year">
                        @foreach ($years as $year)
                            <option {{ request('year') == $year ? 'selected' : '' }}
                                value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <button for="attendance_type" type="button"
                        class="btn-primary input_radious_left text-nowrap h45px">Attendance Type</button>
                    <select class="form-control w-200 h45px input_radious_none" name="attendance_type" id="attendance_type">
                        <option value="0" {{ request('attenddance_type') == '0' ? 'selected' : '' }}>Midterm
                            Term</option>
                        <option value="1" {{ request('attenddance_type') == '1' ? 'selected' : '' }}>Final Term
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-4 col-md-3 text-right mb-3 align-self-end">
            <button type="sbmit" class="btn btn-outline-primary">
                <i class="fas fa-search"></i>
                Search
            </button>
        </div>
    </div>
</form><br>