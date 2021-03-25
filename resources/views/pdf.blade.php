<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/dost.png') }}">

  <style>
.page-break {
    page-break-after: always;
}
</style>
</head>
<body> <table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  @foreach($a_findings as $a)
    <tr>
        <td>{{$a->auditfinding}}</td>
    </tr>
  @endforeach
</table>

  <script type="text/php">
    if ( isset($pdf) ) {
        $font = $fontMetrics->getFont("Arial");
        $pdf->page_text(745, 550, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
    }
</script>
</body>
</html>

