<table class="table table-head-fixed table-hover table-bordered table-striped" style="font-size: 10pt;">
    <thead>
        <tr>
            <th style="width: 10%;">No.</th>
            <th>ID</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Jml</th>
            <th>Keluar</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @if(count($data) > 0)
            <?php foreach ($data as $key => $value) { ?>
                <tr>
                    <td><?=  $key + 1; ?></td>
                    <td><?= $value->id_barang; ?></td>
                    <td><?= $value->deskripsi; ?></td>
                    <td><?= $value->kategori; ?></td>
                    <td><?= $value->jml; ?></td>
                    <td><?= $value->stok_out; ?></td>
                    <td><?=  $value->jml - $value->stok_out; ?></td>
                </tr>
            <?php } ?>
        @else
            <tr>
                <td colspan="4">Data Kosong</td>
            </tr>
        @endif
    </tbody>
</table>
