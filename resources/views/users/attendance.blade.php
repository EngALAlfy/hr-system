@extends('layouts.panel')

@section('title')
    @lang('roles.users_attendance')
@endsection

@push('actions')
    <style>
        .attendance {
            border: none !important;
            background: transparent;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="container p-l-30 p-r-30">
            <div class="row">
                <div class="col-md-12 p-t-50">
                    <div class="d-flex">
                        <span>
                            <h4><i class="fa fa-square color-today"></i> @lang('labels.today') </h4>
                        </span>
                        <span class="m-l-40"></span>
                        <span>
                            <h4><i class="fa fa-square color-friday"></i> @lang('labels.friday') </h4>
                        </span>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>@lang('labels.name')</th>
                                @for ($i = 1; $i <= \Carbon\Carbon::now()->daysInMonth; $i++)
                                    <th @class([
                                        'text-center',
                                        'bg-friday' =>
                                            \Carbon\Carbon::now()->day($i)->dayOfWeek == \Carbon\Carbon::FRIDAY,
                                        'bg-today' => \Carbon\Carbon::today()->day($i) == \Carbon\Carbon::today(),
                                    ])>
                                        {{ \Carbon\Carbon::now()->day($i)->translatedFormat('D') }} </br>
                                        {{ \Carbon\Carbon::now()->day($i)->translatedFormat('d-M') }} </th>
                                @endfor
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="all">{{ $user->name }}</td>
                                        @for ($i = 1; $i <= \Carbon\Carbon::now()->daysInMonth; $i++)
                                            @php
                                                $key = \Carbon\Carbon::now()
                                                    ->day($i)
                                                    ->format('Y-m-d');

                                                $situation = $user->attendances->has($key) ? $user->attendances[$key]->situation : 'none';
                                            @endphp
                                            <td @class([
                                                'bg-friday' =>
                                                    \Carbon\Carbon::now()->day($i)->dayOfWeek == \Carbon\Carbon::FRIDAY,
                                                'bg-today' => \Carbon\Carbon::today()->day($i) == \Carbon\Carbon::today(),
                                            ])>
                                                <select data-date="{{ $key }}" data-user="{{ $user->id }}"
                                                    @class([
                                                        'attendance',
                                                        'text-success' => $situation == 'attend',
                                                        'text-danger' => $situation == 'absent',
                                                        'text-warning' => $situation == 'patiant',
                                                        'text-info' => $situation == 'holiday',
                                                    ])>
                                                    <option value="null" class="text-muted" class="">
                                                        @lang('labels.choose_attendance')</option>
                                                    <option value="attend" {{ $situation == 'attend' ? 'selected' : '' }}
                                                        class="text-success">@lang('labels.attend')</option>
                                                    <option value="absent" {{ $situation == 'absent' ? 'selected' : '' }}
                                                        class="text-danger">@lang('labels.absent')</option>
                                                    <option value="patiant" {{ $situation == 'patiant' ? 'selected' : '' }}
                                                        class="text-warning">@lang('labels.patiant')</option>
                                                    <option value="holiday" {{ $situation == 'holiday' ? 'selected' : '' }}
                                                        class="text-info">@lang('labels.holiday')</option>
                                                </select>
                                            </td>
                                            {{-- <td>{{ $user->attendances["2022-08-21"]->situation}}
                                        </td> --}}
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <!-- table library -->
    @include('includes.larafy-table', ['items' => $users])

    <script>
        larafy('.table-responsive', {
            filter: false,
            title:false,
        });


        $('.attendance').change(function() {
            var date = $(this).data('date');
            var attendance = $(this).val();
            var user = $(this).data('user');

            $.post({
                url: "{{ url('/') }}" + `/users/${user}/attendance/store`,
                data: {
                    date: date,
                    situation: attendance,
                    user_id: user,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data == true) {
                        toastr.success("@lang('labels.success')");
                    }
                    console.log(data);
                },
                error: function(error) {

                    toastr.error("@lang('labels.error')");

                    console.error(error);
                }
            });
        });
    </script>
@endpush
