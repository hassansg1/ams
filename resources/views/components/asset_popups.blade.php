

<div class="modal fade" id="asset_functions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asset Function</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="asset_functions" id="asset_functions" action="/your_url" method="post">
                    <label for="asset_function_name" class="form-label required">Asset Fucntion</label>
                    <input type="text" class="form-control" id="asset_function_name" name="asset_function_name">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="asset_function">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="make_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="{{ isset($item) ? $item->id:'' }}hardware_make"
                                       class="form-label required">Hardware Make</label>
                                <input type="text"
                                       value="{{ isset($item) ? $item->hardware_make:old('hardware_make') ?? ''  }}"
                                       class="form-control" id="hardware_make"
                                       name="hardware_make">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="{{ isset($item) ? $item->id:'' }}hardware_model"
                                       class="form-label">Hardware Model</label>
                                <input type="text"
                                       value="{{ isset($item) ? $item->hardware_model:old('hardware_model') ?? ''  }}"
                                       class="form-control" id="hardware_model"
                                       name="hardware_model">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="{{ isset($item) ? $item->id:'' }}part_number"
                                       class="form-label">Part Number</label>
                                <input type="text"
                                       value="{{ isset($item) ? $item->part_number:old('part_number') ?? ''  }}"
                                       class="form-control" id="hardware_part_number" name="hardware_part_number">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="make_model_button">Save</button>
            </div>
        </div>
    </div>
</div>