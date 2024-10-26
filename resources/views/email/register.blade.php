<div class="container">
  Hi {{$array['name']}},<br>
  @php
  echo \App\Models\Sendmail::where('mailto','=', 'register')->first()->body;
  @endphp
</div>
