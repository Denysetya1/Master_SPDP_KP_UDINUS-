@component('mail::message')
# Email Information

Email anda telah di daftarkan menjadi Koordinator KP Universitas Dian Nuswantoro

@component('mail::panel')
Email &emsp;&emsp;&emsp;= <strong>{{$email}}</strong><br>
Password &emsp; = '<strong>{{$password}}</strong>'
@endcomponent

Silahkan menuju halaman admin
@component('mail::button', ['url' => url('/koorkp')])
Masuk
@endcomponent

Terima Kasih,<br>
Udinus TIM
@endcomponent
