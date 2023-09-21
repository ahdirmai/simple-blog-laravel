@extends('layouts.admin.app')
@section('title','Data Users')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Users</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Email</th>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                    Post Count</th>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                    Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $user->email }}</p>
                                </td>
                                <td>
                                    <div class="align-middle text-center">

                                        <span class="text-xs font-weight-bold">{{ $user->posts->count() }}</span>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <a class="btn btn-link text-info text-gradient px-3 mb-0" data-bs-toggle="modal"
                                        data-bs-target=".modal-reset"
                                        data-url="{{ route('users.reset-pass',$user->id) }}"><i
                                            class="far fa-rotate-left me-2"></i></i>Reset
                                        Password</a>
                                    <button class="btn btn-link text-danger text-gradient px-3 mb-0"
                                        data-message="Are you sure delete this user?" data-bs-toggle="modal"
                                        data-bs-target=".modal-delete" data-title="Delete User"
                                        data-url="{{ route('users.delete',$user->id) }}"><i
                                            class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modal-section')
<x-delete-modal class="modal-md"></x-delete-modal>

<div class="modal fade modal-reset" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-reset-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-reset-body">
                Reset Selected User Password
            </div>
            <form action="" method="POST" id="modal-reset-form">
                @method('PUT')
                @csrf
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
    $(document).ready(function($) {
            $('.modal-reset').on('show.bs.modal',(event) =>{
                // console.log(button);
                var button = $(event.relatedTarget)
                var modal = $(this)
                var url = button.data('url')
                modal.find('#modal-reset-form').attr('action',url)
            });
        })
</script>
@endpush
@endsection