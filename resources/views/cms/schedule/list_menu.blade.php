@foreach ($data as $item)
    <div class='fc-event d-flex justify-between bg-dark'>
        <img src="{{ $item->image }}" alt="Error" class="rounded bg-light mr-2" width="25" height="25">
        <span class="my-auto">{{ $item->name }}</span>
        <input type="hidden" class="master_menu_id" value="{{ $item->id }}">
    </div>
@endforeach
