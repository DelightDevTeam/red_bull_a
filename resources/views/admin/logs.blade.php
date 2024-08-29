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
    <div class="d-flex justify-content-between">
        {{-- <a class="btn btn-icon btn-2 btn-primary" href="{{ route('admin.agent.index') }}">
         <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i> @lang('public.back')</span>
        </a> --}}
       </div>
    <div class="card">
      <!-- Card header -->
      <div class="card-header pb-0">
        <div class="d-lg-flex">
          <div>
            <h5 class="mb-0">@lang('public.last_login')</h5>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-flush" id="users-search">
          <thead class="thead-light">
            <th>#</th>
            <th>@lang('public.user_id')</th>
            <th>@lang('public.ip_address')</th>
            <th>@lang('public.login_time')</th>
          </thead>
          <tbody>
            @if(isset($logs))
            @if(count($logs)>0)
              @foreach ($logs as $log)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <span class="d-block">{{ $log->user->user_name }}</span>
                </td>
                <td class="text-sm  font-weight-bold">{{ $log->ip_address }}</td>
                <td>{{ $log->created_at}}</td>
              </tr>
              @endforeach
            @else
            <tr>
                <td col-span=8>
                    There was no Players.
                </td>
            </tr>
            @endif
            @endif
            {{-- kzt --}}

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
