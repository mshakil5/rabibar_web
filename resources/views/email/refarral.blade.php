<div class="container">
  Hi,<br>
  <p>Your friend {{$array['name']}}, sent you a request to join https://www.rabibar.com
If you want to join or see about Rabibar. Please use following code at reference id <br>
<span style="text-align:center">
"{{Auth::user()->id}}"
<br>
or
</span>
<br>
Click this link: {{$array['ref_link']}}
  @php
  echo \App\Models\Sendmail::where('mailto','=', 'referral')->first()->body;
  @endphp
  {{$array['email']}} <br>
</div>
