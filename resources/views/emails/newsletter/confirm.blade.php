{{-- resources/views/emails/newsletter/confirm.blade.php --}}
<p>Hi{{ $subscriber->name ? ' '.$subscriber->name : '' }},</p>
<p>Please confirm your subscription:</p>
<p><a href="{{ $confirmUrl }}">Confirm subscription</a></p>
<p>If you didn’t request this, ignore this email.</p>
