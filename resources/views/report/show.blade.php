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

  .active-button {
    background-color: #e91e63;
    /* or any color you prefer */
    color: white;
    /* optional: change text color if needed */
  }

  #search {
    margin-top: 40px;
  }

  #product {
    background-color: #CCDDEB;
    color: #e91e63;
  }

  #clear {
    margin-top: 40px;
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
            <h5 class="mb-0">@lang('public.win_lose_report')</h5>
          </div>
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
              <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">@lang('public.export')</button>
            </div>
          </div>

        </div>
      </div>
      <div class="container">
        <form>
          <div class="row">
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>From</label>
                <input type="date" class="form-control" id="fromDate" name="fromDate">
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>To</label>
                <input type="date" class="form-control" id="toDate" name="toDate">
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group input-group-static my-3">
                <label>Player</label>
                <input type="text" class="form-control" id="player_name" name="player_name" value="{{Request::query('player_name')}}">
              </div>
            </div>
            <div class="col-md-3">
              <button class="btn btn-sm btn-primary" id="search">@lang('public.search')</button>
            </div>

        </form>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-flush" id="users-search">
        <thead class="thead-light bg-gradient-info">
          <tr>
            <th rowspan="2" class="text-white">@lang('public.player_id')</th>
            <th rowspan="2" class="text-white">@lang('public.total_valid_bet')</th>
            <th rowspan="2" class="text-white">@lang('public.total_bet')</th>
            <th rowspan="2" class="text-white">@lang('public.total_payout')</th>
            <th colspan="3" class="text-white">@lang('public.member_win_lose') </th>
            <th colspan="2" class="text-white">@lang('public.agent_win_lose') </th>
            <th rowspan="2" class="text-white">@lang('public.action')</th>
          </tr>
          <tr>
                <th>@lang('public.win_lose')</th>
                <th>@lang('public.commission')</th>
                <th>@lang('public.total')</th>
                <th>@lang('public.win_lose')</th>
                <th>@lang('public.total')</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($reports as $rep)
          <tr>
            <td>{{ $rep->user_name}}</td>
            <td>{{ $rep->total_valid_bet_amount}}</td>
            <td>{{ $rep->total_bet_amount}}</td>
            <td>{{ $rep->total_payout_amount}}</td>
            @php
              $result = $rep->total_payout_amount - $rep->total_valid_bet_amount;
              $agentPercent = $result * $rep->agent_commission/100;
            @endphp
            @if($result > 0)
            <td class="text-sm text-success font-weight-bold">{{$result}}</td>
            @else
            <td class="text-sm  font-weight-bold">{{$result}}</td>
            @endif
            <td class="text-sm font-weight-bold">{{$rep->total_commission_amount}}</td>
            @if($result > 0)
            <td class="text-sm text-success font-weight-bold">{{$rep->commission_amount+ $result}}</td>
            @else
            <td class="text-sm text-danger font-weight-bold">{{$rep->commission_amount + $result}}</td>
            @endif
            <td class="text-sm font-weight-bold">{{$agentPercent}}</td>
            <td class="text-sm font-weight-bold">{{$agentPercent}}</td>
            <td><a href="{{route('admin.report.detail',$rep->user_id)}}" class="btn btn-sm btn-info">Detail</a></td>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $(document).on('click', '#search', function(event) {
      event.preventDefault();
      const fromDate = $('#fromDate').val();
      const toDate = $('#toDate').val();
      const playerName = $('#player_name').val();
      const gameTypeId = $('.game-type-btn.active').data('id');
      $('.game-type-btn').removeClass('btn_primary');
      $('.game-type-btn[data-id="' + gameTypeId + '"]').addClass('btn_primary');
      $.ajax({
        url: "{{ route('admin.report.index') }}",
        type: "GET",
        data: {
          fromDate: fromDate,
          toDate: toDate,
          playerName: playerName,
          gameTypeId: gameTypeId,
        },
        success: function(response) {
          console.log(response);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        },
      });
    });

    $('.game-type-btn').on('click', function() {
      $('.game-type-btn').removeClass('btn-primary');
      $(this).addClass('btn-primary active');
      var gameTypeId = $(this).data('id');
    });

  });
</script>
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
