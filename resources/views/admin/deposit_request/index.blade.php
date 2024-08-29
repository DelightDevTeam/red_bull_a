@extends('admin_layouts.app')
@section('styles')
<style>
  .transparent-btn {
    background: none;
    border: none;
    padding: 0;
    outline: none;
    cursor: pointer;
    box-shadow: none;
    appearance: none;
    /* For some browsers */
  }
</style>
@endsection
@section('content')
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <!-- Card header -->
      <div class="card-header pb-0">
        <div class="d-lg-flex">
          <div>
            <h5 class="mb-0">@lang('public.deposit_requested_lists')</h5>

          </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-flush" id="users-search">
      <thead class="thead-light">
        <th>#</th>
        <th>@lang('public.player_name')</th>
        <th>@lang('public.requested_amount')</th>
        <th>@lang('public.payment_method')</th>
        <th>@lang('public.bank_account_name')</th>
        <th>@lang('public.bank_account_number')</th>
        <th>@lang('public.status')</th>
        <th>@lang('public.created_at')</th>
        <th>@lang('public.action')</th>
      </thead>
      <tbody>
        @foreach ($deposits as $deposit)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>
            <span class="d-block">{{ $deposit->user->name }}</span>
          </td>
          <td>{{ number_format($deposit->amount) }}</td>
          <td>{{ $deposit->bank->paymentType->name }}</td>
          <td>{{$deposit->bank->account_name}}</td>
          <td>{{$deposit->bank->account_number}}</td>
          <td>
            @if ($deposit->status == 0)
                <span class="badge text-bg-warning text-white mb-2">Pending</span>
            @elseif ($deposit->status == 1)
                <span class="badge text-bg-success text-white mb-2">Approved</span>
            @elseif ($deposit->status == 2)
                <span class="badge text-bg-danger text-white mb-2">Rejected</span>
            @endif
          </td>


          <td>{{ $deposit->created_at->format('d-m-Y') }}</td>
          <td>
    <div class="d-flex align-items-center">
        <form action="{{ route('admin.agent.depositStatusUpdate', $deposit->id) }}" method="post">
            @csrf
            <input type="hidden" name="amount" value="{{ $deposit->amount }}">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="player" value="{{ $deposit->user_id }}">
            @if($deposit->status == 0)
                <button class="btn btn-success p-1 me-1" type="submit">
                    <i class="fas fa-check"></i>
                </button>
            @endif
        </form>

         <form action="{{ route('admin.agent.depositStatusreject', $deposit->id) }}" method="post">
            @csrf
            <input type="hidden" name="status" value="2">
             @if($deposit->status == 0)
                 <button class="btn btn-danger p-1 me-1" type="submit">
                     <i class="fas fa-xmark"></i>
                 </button>
             @endif
        </form>
    </div>
</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>

<script>
  if (document.getElementById('users-search')) {
    const dataTableSearch = new simpleDatatables.DataTable("#users-search", {
      searchable: true,
      fixedHeight: false,
      perPage: 7
    });

    document.querySelectorAll(".export").forEach(function(el) {
      el.addEventListener("click", function(e) {
        var type = el.dataset.type;

        var data = {
          type: type,
          filename: "material-" + type,
        };

        if (type === "csv") {
          data.columnDelimiter = "|";
        }

        dataTableSearch.export(data);
      });
    });
  };
</script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>
@endsection
