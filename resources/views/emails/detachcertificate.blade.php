<x-mail::message>
Hallo {{$user->name}},

@if ($condition == 'detach')
Saat ini sertifikat untuk menyelesaikan kelas {{$class->masterClass->name}}
Ditarik oleh mentor, silahkan hubungi mentor untuk kelas tersebut, yaa....
@else
Selamat kamu sudah menyelesaikan kelas {{$class->masterClass->name}}, silahkan klaim sertifikat di dashboard yaa...
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
