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
            <h5 class="mb-0">@lang('public.player_dashboards')</h5>

          </div>
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
              <a href="{{ route('admin.player.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;@lang('public.create_new_player')</a>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-flush" id="users-search">
          <thead class="thead-light">
            <th>#</th>
            <th>@lang('public.player_id')</th>
            <th>@lang('public.name')</th>
            <th>@lang('public.phone_number')</th>
            <th>@lang('public.status')</th>
            <th>@lang('public.balance')</th>
            <th>@lang('public.action')</th>
            <th>@lang('public.transaction')</th>
          </thead>
          <tbody>
          {{-- kzt --}}
            @if(isset($users))
            @if(count($users)>0)
            @foreach ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <span class="d-block">{{ $user->user_name }}</span>

              </td>
              <td>{{$user->name}}</td>
              <td>{{ $user->phone }}</td>
              <td>
              <small class="badge bg-gradient-{{ $user->status == 1 ? 'success' : 'danger' }}">{{ $user->status == 1 ? "active" : "inactive" }}</small>
              </td>
              <td>{{number_format($user->balanceFloat,2) }}</td>
              <td>
                @if ($user->status == 1)
                <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();" class="me-2" href="#" data-bs-toggle="tooltip" data-bs-original-title="Active Player">
                  <i class="fas fa-user-check text-success" style="font-size: 20px;"></i>
                </a>
                @else
                <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();" class="me-2" href="#" data-bs-toggle="tooltip" data-bs-original-title="InActive Player">
                  <i class="fas fa-user-slash text-danger" style="font-size: 20px;"></i>
                </a>
                @endif
                <form class="d-none" id="banUser-{{ $user->id }}" action="{{ route('admin.player.ban', $user->id) }}" method="post">
                  @csrf
                  @method('PUT')
                </form>
                <a class="me-1" href="{{ route('admin.player.getChangePassword', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Change Password">
                  <i class="fas fa-lock text-info" style="font-size: 20px;"></i>
                </a>
                <a class="me-1" href="{{ route('admin.player.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit Player">
                  <i class="fas fa-pen-to-square text-info" style="font-size: 20px;"></i>
                </a>

              </td>
              <td>
                <a href="{{ route('admin.player.getCashIn', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Deposit To Player" class="btn btn-info btn-sm">
                  <i class="fas fa-plus text-white me-1"></i>
                  @lang('public.deposit')
                </a>
                <a href="{{ route('admin.player.getCashOut', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="WithDraw To Player" class="btn btn-info btn-sm">
                <i class="fas fa-minus text-white me-1"></i>
                @lang('public.withdraw')
                </a>
                <a href="{{ route('admin.report.view', $user->user_name) }}" data-bs-toggle="tooltip" data-bs-original-title="Reports" class="btn btn-info btn-sm">
                  <i class="fas fa-line-chart text-white me-1"></i>
                  @lang('public.reports')
                </a>
                <a href="{{ route('admin.logs', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Reports" class="btn btn-info btn-sm">
                  <i class="fas fa-right-left text-white me-1"></i>
                  @lang('public.logs')
                </a>
                <a href="{{ route('admin.transferLogDetail', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Reports" class="btn btn-info btn-sm">
                  <i class="fas fa-right-left text-white me-1"></i>
                 @lang('public.transfer_logs')
                </a>
          </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td col-span=8>
                    @lang('public.there_was_no_players')
                </td>
            </tr>
            @endif
            @endif

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

{{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
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
