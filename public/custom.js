// declare DataTable
$(document).ready(function () {
    $('#tableKendaraan').DataTable();
    $('#tableSopir').DataTable();
    $('#tableUser').DataTable();
    $('#table-pemeliharaan').DataTable();
    $('#table-riwayat').DataTable();
    $('#table-pajak').DataTable();
});

flatpickr(".year-picker", {
    dateFormat: "Y",
    plugins: [
        new yearSelectPlugin({
            // berapa banyak tahun ke belakang & ke depan
            min: 1990,
            max: 2050
        })
    ]
});

