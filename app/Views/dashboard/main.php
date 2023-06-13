<div class="container-fluid">
      <div class="row">

            <?php if (!empty($sensors)) {
                  foreach ($sensors as $card) : ?><div class="col-auto">
                              <div class="card text-center mb-3" style="width: 18rem;">
                                    <div class="card-body">
                                          <h5 class="card-title"><?= $card->sensor_name; ?></h5>
                                          <p class="card-text"><?= $card->sensor_key; ?></p>
                                          <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                              </div>
                        </div>
            <?php endforeach;
            } ?>

      </div>
</div>