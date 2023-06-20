<div class="container-fluid m-1">
      <div class="row m-1">
            <div class="col"><a href="/export/<?= $sensor[0]->sensor_key; ?>"><button type="button" class="btn btn-success">export data</button></a></div>
      </div>
      <div class="text-center">
            <h1>Real Time Data</h1>
      </div>
      <div class="card shadow">
            <div class="row m-1">
                  <div class="col-6">
                        <div class="card shadow">
                              <canvas id="Tchart"></canvas>
                        </div>
                  </div>

                  <div class="col-6 text-center">
                        <table class="table table-sm table-striped table-bordered " id="table-data">
                              <thead>
                                    <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Nilai</th>
                                          <th scope="col">Deskripsi</th>
                                    </tr>
                              </thead>
                              <tbody>

                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
</div>
<div class="container-fluid m-1">
      <div class="text-center">
            <h1>Adjust Data</h1>
      </div>
      <div class="card shadow">
            <div class="row m-1">
                  <div class="col-6">
                        <form id="" method="post" action="/setValueAdjust">
                              <div class="form-group">
                                    <label for="nilai">Nilai</label>
                                    <input type="text" id="my-input" value="0" name="nilai" class="form-control" readonly>
                                    <input type="hidden" name="key" id="key" value="<?= $sensor[0]->sensor_key; ?>">
                              </div>
                              <div class="form-group">
                                    <label for="name">deskripsi</label>
                                    <input type="text" name="deskripsi" id="deskripsi" class="form-control">
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                  </div>
                  <div class="col-6 text-center">
                        <table class="table table-sm table-striped table-bordered " id="table-adjust">
                              <thead>
                                    <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Nilai</th>
                                          <th scope="col">Deskripsi</th>
                                          <th scope="col">Waktu</th>
                                    </tr>
                              </thead>
                              <tbody>

                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
</div>
<div class="container-fluid m-1">
      <div class="row">
            <div class="col">
                  <table class="table table-sm table-striped table-bordered " id="table-think">
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">field</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Waktu</th>
                              </tr>
                        </thead>
                        <tbody>

                        </tbody>
                  </table>
            </div>
      </div>
</div>


<!-- grfik -->
<script>
      $(document).ready(function() {
            var ctx = document.getElementById('Tchart').getContext('2d');
            var chart = new Chart(ctx, {
                  type: 'line',

                  data: {
                        labels: [],
                        datasets: [{
                              label: '<?= $sensor[0]->sensor_name; ?>',
                              data: [],
                              backgroundColor: 'rgba(75, 192, 192, 0.2)',
                              borderColor: 'rgba(75, 192, 192, 1)',
                              borderWidth: 1,
                              fill: true,
                        }]
                  },
                  options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                              y: {
                                    beginAtZero: true,

                              },
                              x: {
                                    reverse: true,
                              }
                        }
                  }
            });

            function updateChart() {
                  $.ajax({
                        url: "<?php echo base_url('getChart/' . $sensor[0]->sensor_key); ?>",
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                              var labels = [];
                              var data = [];

                              response.forEach(function(item) {
                                    labels.push(item.created_at);
                                    data.push(item.value_nilai);
                              });

                              chart.data.labels = labels;
                              chart.data.datasets[0].data = data;
                              chart.update();
                        }
                  });
            }

            setInterval(function() {
                  updateChart();
            }, 1000);
      });
</script>

<!-- table -->

<script>
      $(document).ready(function() {
            setInterval(function() {
                  $.ajax({
                        url: "<?php echo base_url('getTable/' . $sensor[0]->sensor_key); ?>", // Ubah dengan URL aksi di sisi server Anda
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                              // Hapus data yang ada dari tabel
                              var tbody = $('#table-data tbody').empty();
                              var i = 1;
                              // Tambahkan data baru ke dalam tabel
                              $.each(response, function(index, data) {
                                    var newRow = '<tr>' +
                                          '<td>' + i + '</td>' +
                                          '<td>' + data.value_nilai + '</td>' +
                                          '<td>' + data.created_at + '</td>' +
                                          // Tambahkan kolom lain sesuai kebutuhan
                                          '</tr>';
                                    tbody.append(newRow);
                                    i++;
                              });
                        },
                        error: function(xhr, status, error) {
                              console.error(xhr.responseText);
                        }
                  });
            }, 1000); // Ubah angka ini jika Anda ingin memperbarui pada interval waktu yang berbeda
      });
</script>
<script>
      $(document).ready(function() {
            setInterval(function() {
                  $.ajax({
                        url: "https://api.thingspeak.com/channels/2020586/feeds/last.json?api_key=CJE84IHX6MWASRN7&status=true", // Ubah dengan URL aksi di sisi server Anda
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                              // Hapus data yang ada dari tabel
                              var tbody = $('#table-think tbody').empty();
                              var i = 1;
                              var data = response;

                              // Baca nilai dari setiap field
                              var createdAt = data.created_at;
                              var entryId = data.entry_id;
                              var field1 = data.field1;
                              var field2 = data.field2;
                              var field3 = data.field3;
                              var status = data.status;
                              // Tambahkan data baru ke dalam tabel
                              var isoString = createdAt;

                              // Buat objek Date dari string waktu ISO 8601
                              var date = new Date(isoString);

                              // Konversi ke waktu lokal
                              var localTime = date.toLocaleTimeString();
                              var localDate = date.toLocaleDateString();

                              var newRow = '<tr>' +
                                    '<td>' + i + '</td>' +
                                    '<td>Field1</td>' +
                                    '<td>' + data.field1 + '</td>' +
                                    '<td>' + data.created_at + '</td>' +
                                    // Tambahkan kolom lain sesuai kebutuhan
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>' + i + '</td>' +
                                    '<td>Field1</td>' +
                                    '<td>' + data.field2 + '</td>' +
                                    '<td>' + localTime + ' ' + localDate + '</td>' +
                                    // Tambahkan kolom lain sesuai kebutuhan
                                    '</tr>';
                              tbody.append(newRow);
                              i++;

                        },
                        error: function(xhr, status, error) {
                              console.error(xhr.responseText);
                        }
                  });
            }, 1000); // Ubah angka ini jika Anda ingin memperbarui pada interval waktu yang berbeda
      });
</script>


<!-- adjust -->
<script>
      $(document).ready(function() {
            setInterval(function() {
                  // Lakukan permintaan AJAX menggunakan metode POST ke URL yang ditentukan
                  $.ajax({
                        method: 'GET',
                        url: '<?php echo base_url('/adjustValue' . '/' . $sensor[0]->sensor_key); ?>',
                        // dataType: 'json',
                        success: function(response) {
                              var data = JSON.parse(response);
                              var valueNilai = data.data[0].value_nilai;
                              // Tangani respons dari server
                              // Di sini Anda dapat mengubah nilai atribut "value" dari elemen input menggunakan jQuery
                              // Contoh: Mengubah nilai atribut "value" pada elemen dengan ID "my-input"
                              $('#my-input').val(valueNilai);
                        },
                        error: function(xhr, status, error) {
                              // Tangani kesalahan yang terjadi saat melakukan permintaan AJAX
                              console.log(error);
                        }
                  });
            }, 3000); // Mengulangi setiap 1000 milidetik (1 detik)
      });
</script>

<!-- table -->

<script>
      $(document).ready(function() {
            setInterval(function() {
                  $.ajax({
                        url: "<?php echo base_url('getTableAdjust/' . $sensor[0]->sensor_key); ?>", // Ubah dengan URL aksi di sisi server Anda
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                              // Hapus data yang ada dari tabel
                              var tbody = $('#table-adjust tbody').empty();
                              var i = 1;
                              // Tambahkan data baru ke dalam tabel
                              $.each(response, function(index, data) {
                                    var newRow = '<tr>' +
                                          '<td>' + i + '</td>' +
                                          '<td>' + data.adjust_nilai + '</td>' +
                                          '<td>' + data.adjust_deskripsi + '</td>' +
                                          '<td>' + data.created_at + '</td>' +
                                          // Tambahkan kolom lain sesuai kebutuhan
                                          '</tr>';
                                    tbody.append(newRow);
                                    i++;
                              });
                        },
                        error: function(xhr, status, error) {
                              console.error(xhr.responseText);
                        }
                  });
            }, 1000); // Ubah angka ini jika Anda ingin memperbarui pada interval waktu yang berbeda
      });
</script>