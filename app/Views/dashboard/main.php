<div class="container-fluid">
      <div class="row m-1">
            <div class="col">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Sensor <i class="bi bi-plus-square"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Sensor</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                          <form method="post" action="<?= base_url('/tambah'); ?>">
                                                <div class="mb-3">
                                                      <label for="name" class="form-label">Nama Sensor</label>
                                                      <input type="text" class="form-control" id="name" name="name">
                                                </div>
                                                <div class="mb-3">
                                                      <label for="deskripsi" class="form-label">Deskripsi</label>
                                                      <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                                                </div>


                                    </div>
                                    <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Tambah</button>
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>

      <div class="row">

            <?php if (!empty($sensors)) {
                  foreach ($sensors as $card) : ?><div class="col-auto">
                              <div class="card text-center mb-3" style="width: 18rem;">
                                    <div class="card-body">
                                          <h5 class="card-title"><?= $card->sensor_name; ?></h5>
                                          <p class="card-text"><?= $card->sensor_key; ?></p>
                                          <a href="<?= base_url('/detail' . '/' . $card->sensor_key); ?>" class="btn btn-primary">Detail</a>
                                    </div>
                              </div>
                        </div>
            <?php endforeach;
            } ?>

      </div>
</div>