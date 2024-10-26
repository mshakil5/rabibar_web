<div class="container">
  Hi {{$array['name']}},<br>
  @php
  echo \App\Models\Sendmail::where('mailto','=', 'notparticipate')->first()->body;
  @endphp
</div>
