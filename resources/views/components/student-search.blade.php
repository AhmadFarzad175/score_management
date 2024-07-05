@props(['menu'])
<form action="{{ $menu }}">
    @csrf
    <div class="card d-flex flex-row pt-3 justify-content-between flex-wrap">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="input-group">
                    <button type="button" class="btn-primary input_radious_left" style="">Class</button>
                    <select class="form-control select2 input_radious_none" name="classs_id" id="classs">
                        @foreach ($classes as $class)
                            <option {{ request('classs_id') == $class->id ? 'selected' : '' }}
                                value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="input-group">
                    <button type="button" class="btn-primary input_radious_left ">Year</button>
                    <select class="form-control select2 input_radious_none" name="year" id="year-picker">
                    </select>
            </div>
        </div>
        @if ($menu == 'results')
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">

                <div class="input-group">
                        <button type="button" class="btn-primary input_radious_left text-nowrap">Exam
                            Type</button>
                        <select class="form-control input_radious_none" name="exam_type">
                            <option value="0" {{ request('exam_type') == '0' ? 'selected' : '' }}>Midterm
                                Term</option>
                            <option value="1" {{ request('exam_type') == '1' ? 'selected' : '' }}>Final Term
                            </option>
                        </select>
                </div>
            </div>
        @endif

        <div class="col-12 {{$menu == 'results' ? 'col-sm-4 col-md-12' : 'col-sm-12 col-md-4' }} col-lg-3 text-right mb-3 align-self-end ">
            <button type="sbmit" class="btn btn-outline-primary">
                <i class="fas fa-search"></i>
                Search
            </button>
        </div>
    </div>
</form>
