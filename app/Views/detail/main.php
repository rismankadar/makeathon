<div class="container-fluid">
      <div class="row">
            <div class="col-6">
                  <table class="table" id="table-data">
                        <thead>
                              <?php $i = 1; ?>
                              <tr>
                                    <th scope="col">No</th>
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

<script>
      $(document).ready(function() {
            setInterval(function() {
                  $.ajax({
                        url: "<?php echo base_url('getTable/' . $sensors[0]->sensor_key); ?>", // Ubah dengan URL aksi di sisi server Anda
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