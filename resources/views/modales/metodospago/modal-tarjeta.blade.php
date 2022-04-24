<div class="modal fade" id="modal-tarjeta" tabindex="-1" aria-labelledby="modal-tarjeta" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tarjeta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tarjeta" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="redsys_key">Redsys Key *</label>
                                <input type="text" class="form-control" name="redsys_key" id="redsys_key" placeholder="Código de Redsys">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="redsys_merchantcode">Redsys Merchantcode *</label>
                                <input type="text" class="form-control" name="redsys_merchantcode" id="redsys_merchantcode" placeholder="Código de vendedor">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="redsys_terminal">Redsys Terminal *</label>
                                <input type="text" class="form-control" name="redsys_terminal" id="redsys_terminal" placeholder="Terminal de Redsys">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="redsys_emviroment">Redsys enviroment *</label>
                                <input type="text" class="form-control" name="redsys_emviroment" id="redsys_emviroment" placeholder="Entorno de Redsys">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="redsys_tradename">Redsys tradename *</label>
                                <input type="text" class="form-control" name="redsys_tradename" id="redsys_tradename" placeholder="Nombre comercial">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="redsys_titular">Nombre titular *</label>
                                <input type="text" class="form-control" name="redsys_titular" id="redsys_titular" placeholder="Nombre titular">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label font-medium-1" for="redsys_descripcion">Descripción *</label>
                                <input type="text" class="form-control" name="redsys_descripcion" id="redsys_descripcion" placeholder="Descripción">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect">Cancelar</button>
                <button type="submit" form="form-tarjeta" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
            </div>
        </div>
    </div>
</div>
