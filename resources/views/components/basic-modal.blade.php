<div>
    <div class="modal fade modal-basic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        {{-- <p>{{ $message }}</p> --}}
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
            </div>
        </div>
    </div>

</div>