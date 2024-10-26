<div class="container">
  Hi {{$array['name']}},<br>
  @php
  echo \App\Models\Sendmail::where('mailto','=', 'attend')->first()->body;
  @endphp
</div>
