<div class="accordion mt-10">
    <hr class="mb-5">

    <div id="accordion">
        @foreach ($groupMenu->sortBy('sequence') as $i => $item)
            <div class="card">
                <div class="card-header" id="heading{{ $i + 1 }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $i + 1 }}"
                            aria-expanded="{{ $i == 0 ? 'true' : 'false' }}"
                            aria-controls="collapse{{ $i + 1 }}">
                            <h5> <b>{{ $item->name }}</b></h5>
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $i + 1 }}" class="collapse {{ $i == 0 ? 'show' : '' }}"
                    aria-labelledby="heading{{ $i + 1 }}" data-parent="#accordion">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th class="text-center ">
                                    <div class="icheck-primary">
                                        <label for="view">View</label>
                                        <input type="checkbox" id="view"
                                            onclick="changePrivilegeGlobal('view',this,{{ $item->id }},{{ $req->id }})">
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="icheck-primary">
                                        <label for="view">Create</label>
                                        <input type="checkbox" id="view"
                                            onclick="changePrivilegeGlobal('create',this,{{ $item->id }},{{ $req->id }})">
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="icheck-primary">
                                        <label for="view">Edit</label>
                                        <input type="checkbox" id="view"
                                            onclick="changePrivilegeGlobal('edit',this,{{ $item->id }},{{ $req->id }})">
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="icheck-primary">
                                        <label for="view">Delete</label>
                                        <input type="checkbox" id="view"
                                            onclick="changePrivilegeGlobal('delete',this,{{ $item->id }},{{ $req->id }})">
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="icheck-primary">
                                        <label for="view">Print</label>
                                        <input type="checkbox" id="view"
                                            onclick="changePrivilegeGlobal('print',this,{{ $item->id }},{{ $req->id }})">
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="icheck-primary">
                                        <label for="view">Validation</label>
                                        <input type="checkbox" id="view"
                                            onclick="changePrivilegeGlobal('validation',this,{{ $item->id }},{{ $req->id }})">
                                    </div>
                                </th>
                                {{-- <th class="text-center">
                                    <div class="icheck-primary">
                                        <label for="view">Global</label>
                                        <input type="checkbox" id="view"
                                            onclick="changePrivilegeGlobal('global',this,{{ $item->id }},{{ $req->id }})">
                                    </div>
                                </th> --}}
                            </thead>
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($item->menu->sortBy('sequence') as $i1 => $d1)
                                @php
                                    $id = 0;

                                    if ($d1->privilege) {
                                        $check = $d1->privilege->where('role_id', $req->id)->first();
                                        if ($check) {
                                            $id = $check->id;
                                        }
                                    }

                                    $index++;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index }}</td>
                                    <td>
                                        {{ $d1->name }}
                                    </td>
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" @if (!empty($check) and $check->view == 1) checked @endif
                                                id="view_{{ $item->id }}_{{ $index }}"
                                                onclick="changePrivilege({{ $id }},'view',this,{{ $req->id }},{{ $d1->id }})"
                                                class="view_{{ $item->id }}">
                                            <label for="view_{{ $item->id }}_{{ $index }}">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" @if (!empty($check) and $check->create == 1) checked @endif
                                                id="create_{{ $item->id }}_{{ $index }}"
                                                onclick="changePrivilege({{ $id }},'create',this,{{ $req->id }},{{ $d1->id }})"
                                                class="create_{{ $item->id }}">
                                            <label for="create_{{ $item->id }}_{{ $index }}">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" @if (!empty($check) and $check->edit == 1) checked @endif
                                                id="edit_{{ $item->id }}_{{ $index }}"
                                                onclick="changePrivilege({{ $id }},'edit',this,{{ $req->id }},{{ $d1->id }})"
                                                class="edit_{{ $item->id }}">
                                            <label for="edit_{{ $item->id }}_{{ $index }}">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" @if (!empty($check) and $check->delete == 1) checked @endif
                                                id="delete_{{ $item->id }}_{{ $index }}"
                                                onclick="changePrivilege({{ $id }},'delete',this,{{ $req->id }},{{ $d1->id }})"
                                                class="delete_{{ $item->id }}">
                                            <label for="delete_{{ $item->id }}_{{ $index }}">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" @if (!empty($check) and $check->print == 1) checked @endif
                                                id="print_{{ $item->id }}_{{ $index }}"
                                                onclick="changePrivilege({{ $id }},'print',this,{{ $req->id }},{{ $d1->id }})"
                                                class="print_{{ $item->id }}">
                                            <label for="print_{{ $item->id }}_{{ $index }}">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" @if (!empty($check) and $check->validation == 1) checked @endif
                                                id="validation_{{ $item->id }}_{{ $index }}"
                                                onclick="changePrivilege({{ $id }},'validation',this,{{ $req->id }},{{ $d1->id }})"
                                                class="validation_{{ $item->id }}">
                                            <label for="validation_{{ $item->id }}_{{ $index }}">
                                            </label>
                                        </div>
                                    </td>
                                    {{-- <td class="text-center">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" @if (!empty($check) and $check->global == 1) checked @endif
                                                id="global_{{ $item->id }}_{{ $index }}"
                                                onclick="changePrivilege({{ $id }},'global',this,{{ $req->id }},{{ $d1->id }})"
                                                class="global_{{ $item->id }}">
                                            <label for="global_{{ $item->id }}_{{ $index }}">
                                            </label>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
