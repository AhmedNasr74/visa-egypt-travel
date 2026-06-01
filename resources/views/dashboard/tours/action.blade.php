@can('tours.edit')
<a title="Edit"  href="{{ route('dashboard.tours.edit', $id) }}">
    <i class="fa fa-edit"></i>
</a>
@endcan

@can('tours.delete')
<a title="Delete"  data-delete-url="{{ route('dashboard.tours.destroy', $id) }}" href="javascript:;"
   type="button" class="btn-delete-resource-modal" data-bs-toggle="modal" data-bs-target="#deleteResourceModal">
    <i class="fa fa-trash"></i>
</a>
@endcan

@can('tours.duplicate')
<a title="Duplicate" target="_blank" href="{{ route('dashboard.tours.duplicate', $id) }}">
    <i class="fa fa-clone"></i>
</a>
@endcan

<a title="View On Site" target="_blank" href="{{ route('site.tour_details', $slug) }}">
    <i class="fa fa-eye"></i>
</a>
