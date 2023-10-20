@extends('layouts.admin')
@section('content')
@can('message_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success text-white" href="{{ route('admin.messages.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 2px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ trans('global.add') }} {{ trans('cruds.message.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.message.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Message">
                <thead>
                    <tr>
                        <th width="10">

                        </th>

                        <th>
                            {{ trans('cruds.message.fields.title') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.message.fields.message') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.message.fields.sent_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.message.fields.status') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    <tr>
                        <td width="10">
                        </td>

                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        {{-- <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td> --}}
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $key => $message)
                        <tr data-entry-id="{{ $message->id }}">
                            <td width="10">

                            </td>

                            <td>
                                {{ $message->title ?? '' }}
                            </td>
                            {{-- <td>
                                {{ $message->message ?? '' }}
                            </td> --}}
                            <td>
                                {{ $message->sent_at ?? '' }}
                            </td>
                            <td>
                                {{ $message->status ?? '' }}
                            </td>
                            <td>
                                @can('message_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.messages.show', $message->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('message_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.messages.edit', $message->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('message_delete')
                                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('styles')
@parent
<style>
.dt-buttons {
    margin-top: 0;
}
.dt-buttons a.buttons-excel{
    background: #008393;
    border-radius: 6px;
    color: white;
}
</style>
@endsection
@section('scripts')
@parent
<script>
     $('th[width="10"]').hide();
    $('td[width="10"]').hide();
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    // Find the indexes of buttons to remove
    const buttonsToKeep = ['excel'];
    const indexesToRemove = dtButtons
    .map((button, index) => (buttonsToKeep.includes(button.extend) ? -1 : index))
    .filter((index) => index !== -1);

    // Remove the buttons at the identified indexes
    indexesToRemove.reverse().forEach((index) => dtButtons.splice(index, 1));

    // Change the name of 'excel' to 'Download Excel'
    const excelButtonIndex = dtButtons.findIndex((button) => button.extend === 'excel');
    if (excelButtonIndex !== -1) {
        dtButtons[excelButtonIndex].text = 'Download Excel';
        dtButtons[excelButtonIndex].className = 'btn btn-info'; // Use className instead of class for Bootstrap styling
        dtButtons[excelButtonIndex].customize = function (xlsx) {
        const sheet = xlsx.xl.worksheets['sheet1.xml'];

        // Remove the last column from the exported Excel file
        // $('row c:last', sheet).remove();
        $('row', sheet).each(function () {
        const cells = $(this).children('c');
        cells.last().remove();
        });
    };
        }


  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Message:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection
