<center>
    <h1>Laporan Ijazah</h1>
</center>

<table style="width: 100%; border-collapse: collapse; text-align: left;" border="1">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px; border: 1px solid black;">Nama</th>
            <th style="padding: 8px; border: 1px solid black;">Pendidikan</th>
            <th style="padding: 8px; border: 1px solid black;">Tipe</th>
            <th style="padding: 8px; border: 1px solid black;">Tanggal Verifikasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->user->name }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->pendidikan }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->tipe }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
