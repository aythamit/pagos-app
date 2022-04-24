<div class="modal fade" id="modal-paypal" tabindex="-1" aria-labelledby="modal-paypal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Paypal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-paypal" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="paypal_client_id">Paypal ID Cliente *</label>
                                <input type="text" class="form-control" name="paypal_client_id" id="paypal_client_id" placeholder="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="paypal_action">Paypal Action *</label>
                                <input type="text" class="form-control" name="paypal_action" id="paypal_action" placeholder="Sale">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="paypal_currency">Paypal Currency *</label>
                                <input type="text" class="form-control" name="paypal_currency" id="paypal_currency" placeholder="EUR">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="paypal_notify_url">URL Webhook</label>
                                <input type="text" class="form-control" name="paypal_notify_url" id="paypal_notify_url" placeholder="URL Webhook">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect">Cancelar</button>
                <button type="submit" form="form-paypal" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
            </div>
        </div>
    </div>
</div>
