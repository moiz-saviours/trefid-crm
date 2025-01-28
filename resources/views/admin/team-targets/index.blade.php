@extends('admin.layouts.app')
@section('title','Team Targets')
@section('datatable', true)
@section('content')
    @push('style')
        @include('admin.team-targets.style')
    @endpush
    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <header class="custm_header">
                    <div class="new_head">
                        <h1 class="page-title mb-2">Team Targets <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                        <h2 id="record-count" class="h6">{{count($teams)}} records</h2>
                    </div>
                    <div class="filters">
                        <div class="actions">
                            <h1><i class="fa fa-lock" aria-hidden="true"></i> Data Quality</h1>
                            <button class="header_btn">Actions <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                            <button class="header_btn">Import</button>
{{--                            <button class="create-contact open-form-btn">Create New</button>--}}
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="container">
                    <div class="custom-tabs">
                        <ul class="tab-nav">
                            <li class="tab-item active" data-tab="home">Team Targets
                                <i class="fa fa-times close-icon" aria-hidden="true"></i></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="card">
                                <div class="card-header">
                                    <div class="container">
                                        <div class="row fltr-sec">
                                            <div class="col-md-8">
                                                <ul class="custm-filtr">
                                                    <div class="table-li">
                                                        <li class="">Company Owner <i class="fa fa-caret-down"
                                                                                      aria-hidden="true"></i></li>
                                                        <li class="">Create date <i class="fa fa-caret-down"
                                                                                    aria-hidden="true"></i></li>
                                                        <li class="">Last activity date <i class="fa fa-caret-down"
                                                                                           aria-hidden="true"></i>
                                                        </li>
                                                        <li class="">Lead status <i class="fa fa-caret-down"
                                                                                    aria-hidden="true"></i></li>
                                                        <li class=""><i class="fa fa-bars" aria-hidden="true"></i> All
                                                            filters
                                                        </li>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 right-icon" id="right-icon-0"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="allTeamTargetsTable" class="table table-striped datatable-exportable
                            stripe row-border order-column nowrap
                            initTable
                            ">
                                        <thead>
                                        <tr>
                                            <th>Team</th>
                                            @for($i = 1; $i < 13; $i++)
                                                <th>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</th>
                                            @endfor
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($teams as $team)
                                            <tr data-team-key="{{ $team->team_key }}">
                                                <td>{{ $team->name }}</td>
                                                @for($i = 1; $i < 13; $i++)
                                                    <td class="editable" data-month="{{ $i }}" data-year="{{ date('Y') }}">
                                                        @php
                                                            $target = $team->targets()->where('month', $i)->where('year', date('Y'))->first();
                                                        @endphp
                                                        <span class="target-value">
                                                            {{ $target ? number_format($target->target_amount) : 0 }}
                                                        </span>
                                                        <input type="number" class="target-input" value="{{ $target ? $target->target_amount : 0 }}" style="display:none;">
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    @include('admin.team-targets.custom-form')--}}
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    @push('script')
        @include('admin.team-targets.script')
        <script>
            $(document).ready(function() {
                // Double-click to edit target
                $('.editable').dblclick(function() {
                    var currentCell = $(this);
                    currentCell.find('.target-value').hide();
                    currentCell.find('.target-input').show().focus();
                });

                // Save on blur or Enter
                $('.target-input').blur(function() {
                    var currentInput = $(this);
                    var targetAmount = currentInput.val();
                    var team_key = currentInput.closest('tr').data('team-key');
                    var month = currentInput.parent('td.editable').data('month');
                    var year = currentInput.parent('td.editable').data('year');

                    // Send update request via AJAX
                    $.ajax({
                        url: '/admin/team-target/update/' + team_key + '/' + month + '/' + year,
                        method: 'POST',
                        data: {
                            target_amount: targetAmount,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            currentInput.hide();
                            currentInput.siblings('.target-value').text(targetAmount).show();
                        }
                    });
                });

                // Save on Enter key press
                $('.target-input').keypress(function(e) {
                    if (e.which == 13) {
                        $(this).blur();
                    }
                });
            });
        </script>
    @endpush
@endsection
