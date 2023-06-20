<div class="container-fluid">
      <div class="row">
            <div class="col-6">
                  <button type="button" class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Sensor <i class="bi bi-plus-circle"></i></button>
            </div>
      </div>
      <div class="row"><?php if (!empty($cardSensor)) {
                              foreach ($cardSensor as $card) : ?>
                        <div class="col col-auto">
                              <div class="card text-center m-1 shadow-sm" style="width: 15rem;">
                                    <div class="card-body">
                                          <p class="card-title fw-bold fs-3 " id="<?= 'card' . $card->id; ?>"></p>
                                          <p class="card-text p-0 m-0">Nama : <?= $card->sensor_name; ?></p>
                                          <p class="card-text p-0 m-0">key : <?= $card->sensor_key; ?></p>
                                          <a href="detail/<?= $card->sensor_key; ?>" class="btn btn-sm btn-primary">Detail <i class="bi bi-arrow-right-square"></i></a>
                                    </div>
                              </div>
                        </div>
                        <script>
                              setInterval(function() {
                                    $.ajax({
                                          url: "<?php echo base_url('/updateCard' . '/' . $card->sensor_key); ?>",
                                          type: "GET",
                                          dataType: "json",
                                          success: function(response) {
                                                var p = $('<?= '#card' . $card->id; ?>');
                                                p.empty();

                                                $.each(response.data, function(index, row) {
                                                      var newRow = row.value_nilai;
                                                      p.append(newRow);
                                                });
                                          }
                                    });
                              }, 2000);
                        </script>


            <?php endforeach;
                        } ?>
      </div>
</div>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <form action="tambah" method="post">
            <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Sensor</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                              <div class="mb-3">
                                    <label for="name" class="form-label">Nama Sensor</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>

                              </div>
                              <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" id="deskripsi">
                              </div>
                              <div class="mb-3">
                                    <label for="unit" class="form-label">unit</label>
                                    <input type="text" class="form-control" name="unit" id="unit">
                              </div>

                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                  </div>
            </div>
      </form>
</div>