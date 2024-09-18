@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-body">

                <form method="GET" action="{{ route('users.index') }}">
                    <div class="form-group d-flex">
                        <label class="col-form-label text-right mr-4">Unit</label>
                        <div class="d-flex flex-column">
                            <select name="unit_id" id="unit_id" class="form-control form-control-sm">
                                <option value="">All</option>
                                @foreach($units as $unit)
                                    <option
                                        value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group d-flex mt-2">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="fas fa-fw fa-search"></i>
                                        Filter
                                    </button>
                                    <a href="{{ route('users.index') }}" class="btn btn-default btn-sm">
                                        <i class="fas fa-undo"></i>
                                        Reset Filter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <a href="{{route('users.create')}}" class="btn btn-default text-blue">
                    <i class="fas fa-plus"></i>
                    Tambah User
                </a>

                <table id="data-table" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                    <th>OPTIONS</th>
                    <th>NIP</th>
                    <th>NAMA LENGKAP</th>
                    <th>UNIT</th>
                    <th>AKTIF</th>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('users.show', 1) }}"
                                       class="btn btn-sm btn-default text-blue"><i class="fas fa-info-circle"></i>
                                        Detail</a>
                                    <form action="{{route('users.destroy', $user->id)}}" method="post"
                                          id="delete-form-{{$user->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $user->id }})"
                                                class="btn btn-sm btn-default text-danger"><i
                                                class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    <button onclick="resetpass()" class="btn btn-sm btn-default text-info"><i
                                            class="fas fa-fw fa-lock-open"></i> Reset Pass
                                    </button>
                                    {{--                                <a href="{{ route('users.akses') }}" class="btn btn-sm btn-default text-blue"><i--}}
                                    {{--                                        class="fas fa-check"></i> Akses</a>--}}
                                    <a href="{{route('users.edit', $user->id)}}"
                                       class="btn btn-sm btn-default text-blue">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                </div>
                            </td>
                            <td>{{$user->nip}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->unit->name}}</td>
                            <td>
                                @if($user->active)
                                    <span class="badge badge-success">YES</span>
                                @else
                                    <span class="badge badge-danger">NO</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex my-2">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script !src="">
        $(document).ready(function() {
            $('#data-table').DataTable({
                'scrollX': true,
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': false,
                'autoWidth': false,
                'responsive': true,
            });
        });
    </script>
@endsection
