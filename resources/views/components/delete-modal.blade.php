<div>
    <div class="modal fade modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div {{ $attributes->merge(['class' => 'modal-dialog']) }} role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-basic-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-basic-body" id="modal-html">
                    <div class="modal-body-custome">
                        <div class="text-center">
                            <div class="loader">
                                <div class="ball-pulse">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <form action="" method="POST" id="form-modal-delete">
                    @method('delete')
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Back</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>