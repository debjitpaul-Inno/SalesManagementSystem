<!-- ================== BEGIN DELETE MODAL ================== -->
<div class="modal modal-cover fade" id="danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: red"><i class="bi bi-exclamation-triangle-fill"></i> WARNING </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <form id="delForm" method="POST">
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    <div>
                        <p class="mb-3">Are you sure want to <h3 class="modal-title" style="color: red">DELETE <i class="bi bi-exclamation-octagon"></i></h3></p>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-danger btn-lg btn-block"><i class="bi bi-trash"></i> DELETE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ================== END DELETE MODAL ================== -->
