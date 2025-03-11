<center>
    <h1>Laporan Pangkat</h1>
</center>

<table style="width: 100%; border-collapse: collapse; text-align: left;" border="1">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px; border: 1px solid black;">Nama</th>
            <th style="padding: 8px; border: 1px solid black;">TMT</th>
            <th style="padding: 8px; border: 1px solid black;">Tanggal Verifikasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->user->name ?? null }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->tmt }}</td>
                <td style="padding: 8px; border: 1px solid black;">{{ $d->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
