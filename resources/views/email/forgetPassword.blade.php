<div>
    @php
    $email =\App\Models\Sendmail::where('mailto','=', 'forget_password')->first();
    echo $email->body;
    @endphp
    <a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
    
</div>

