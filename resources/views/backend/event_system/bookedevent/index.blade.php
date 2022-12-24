@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All Booked Events')}}</h1>
        </div>
    </div>
</div>
<br>

<div class="card">
    <form class="" id="sort_events" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('All Booked Events') }}</h5>
            </div>
            
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}">
                </div>
            </div>
        </div>
        </from>
        <div class="card-body">
            <table class="table mb-0 aiz-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Event')}}</th>
                        <th>{{translate('User')}}</th>
                        <th>{{translate('Payment Status')}}</th>
                        <!--<th class="text-right">{{translate('Options')}}</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                    <tr>
                        <td>
                            {{ ($key+1) + ($events->currentPage() - 1) * $events->perPage() }}
                        </td>
                        <td>
                            {{ $event->event_name }}
                            <br>
                           Price: {{ $event->price }}
                        </td>
                        <td>
                            {{ $event->user_name }}
                            <br>
                            {{ $event->user_email }}
                            <br>
                           Game Id: {{ $event->game_id }}
                            <br>
                          Discard Id: {{ $event->discard_id }}
                        </td>
                        <td>
                            <span style="background-color: #355d35;padding: 5px 10px;border-radius: 7px;color: white;">{{ $event->payment_status }}</span>
                        </td>
                        <!--<td>-->
                        <!--    <label class="aiz-switch aiz-switch-success mb-0">-->
                        <!--        <input type="checkbox" onchange="change_status(this)" value="{{ $event->id }}" <?php if($event->status == 1) echo "checked";?>>-->
                        <!--        <span></span>-->
                        <!--    </label>-->
                        <!--</td>-->
                        <!--<td class="text-right">-->
                        <!--    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('event.edit',$event->id)}}" title="{{ translate('Edit') }}">-->
                        <!--        <i class="las la-pen"></i>-->
                        <!--    </a>-->
                            
                        <!--    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('event.destroy', $event->id)}}" title="{{ translate('Delete') }}">-->
                        <!--        <i class="las la-trash"></i>-->
                        <!--    </a>-->
                        <!--</td>-->
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

    <script type="text/javascript">
        function change_status(el){
            var status = 0;
            if(el.checked){
                var status = 1;
            }
            $.post('{{ route('event.change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Change Event status successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection
