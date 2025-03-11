<center>
    <h1>Laporan Buku</h1>
</center>

<table style="width: 100%; border-collapse: collapse; text-align: left;" border="1">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px; border: 1px solid black;">Judul</th>
            <th style="padding: 8px; border: 1px solid black;">Penerbit</th>
            <th style="padding: 8px; border: 1px solid black;">Tahun</th>
            <th style="padding: 8px; border: 1px solid black;">Anggota</th>
            <th style="padding: 8px; border: 1px solid black;">Tanggal Verifikasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->judul }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->penerbit }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->tahun }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->anggota }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
