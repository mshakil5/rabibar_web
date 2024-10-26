<div class="container">
  Hi {{$array['name']}},<br>
  @php
  echo \App\Models\Sendmail::where('mailto','=', 'alluser')->first()->body;
  @endphp
</div>
