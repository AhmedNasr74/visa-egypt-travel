{{--<a href="{{ route('dashboard.customized-trips.edit', $id) }}">--}}
{{--    <i class="fa fa-edit"></i>--}}
{{--</a>--}}

<a data-delete-url="{{ route('dashboard.customized-trips.destroy', $id) }}" href="javascript:;"
   type="button" class="btn-delete-resource-modal" data-bs-toggle="modal" data-bs-target="#deleteResourceModal">
    <i class="fa fa-trash"></i>
</a>
<a target="_blank" href="{{ route('dashboard.customized-trips.show', $id) }}">
    <i class="fa fa-eye"></i>
</a>
