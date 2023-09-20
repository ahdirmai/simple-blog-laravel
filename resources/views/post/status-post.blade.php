<form action="{{ $url }}" method="POST">

    <p class="">
        Publish/UnPublish
    </p>

    @method('PUT')
    @csrf
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>