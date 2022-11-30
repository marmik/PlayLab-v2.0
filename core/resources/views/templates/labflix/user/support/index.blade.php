@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="card custom--card">
                        <div class="card-body">
                            <div class="table table--responsive--lg">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('Subject')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Priority')</th>
                                        <th>@lang('Last Reply')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($supports as $key => $support)
                                        <tr>
                                            <td data-label="@lang('Subject')"> <a href="{{ route('ticket.view', $support->ticket) }}" class="font-weight-bold text-white"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                                            <td data-label="@lang('Status')">
                                                @if($support->status == 0)
                                                    <span class="badge badge--success">@lang('Open')</span>
                                                @elseif($support->status == 1)
                                                    <span class="badge badge--primary">@lang('Answered')</span>
                                                @elseif($support->status == 2)
                                                    <span class="badge badge--warning">@lang('Customer Reply')</span>
                                                @elseif($support->status == 3)
                                                    <span class="badge badge--dark">@lang('Closed')</span>
                                                @endif
                                            </td>
                                            <td data-label="@lang('Priority')">
                                                @if($support->priority == 1)
                                                    <span class="badge badge--dark">@lang('Low')</span>
                                                @elseif($support->priority == 2)
                                                    <span class="badge badge--success">@lang('Medium')</span>
                                                @elseif($support->priority == 3)
                                                    <span class="badge badge--primary">@lang('High')</span>
                                                @endif
                                            </td>
                                            <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                            <td data-label="@lang('Action')">
                                                <a href="{{ route('ticket.view', $support->ticket) }}" class="cmn-btn btn-sm">
                                                    <i class="fa fa-desktop"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                           <td colspan="100" class="data-not-found">
                                                <div class="data-not-found__text text-center">
                                                <h6 class="empty-table__text mt-1">{{ __($emptyMessage) }} </h6>
                                              </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

                                {{$supports->links()}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
