<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{--<img src="https://laravel.com/img/notification-logo.png" alt="Laravel Logo">--}}
<img src="{{asset('assets/images/logo.png')}}" alt="Logo Transfert Union">
@else
{{-- $slot --}}
<img src="{{asset('assets/images/logo.png')}}" alt="Logo Transfert Union">
@endif
</a>
</td>
</tr>
