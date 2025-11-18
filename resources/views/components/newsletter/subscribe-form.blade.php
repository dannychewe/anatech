{{-- resources/views/components/newsletter/subscribe-form.blade.php --}}
<form action="{{ route('newsletter.subscribe') }}" method="POST" class="cs_newsletter_form position-relative">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" required
           class="cs_newsletter_input text-white cs_fs_14 cs_rounded_5 border-0 w-100 cs_pt_10"
           placeholder="Enter your email">
    <input type="text" name="name" value="{{ old('name') }}" class="d-none"> {{-- optional hidden name --}}
    <button class="cs_newsletter_btn cs_fs_14 cs_rounded_5 cs_transition_4 bg-accent position-absolute text-uppercase">
        <span>Go</span>
    </button>
    @error('email') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror
    @if(session('success')) <small class="text-success d-block mt-2">{{ session('success') }}</small> @endif
    @if(session('error')) <small class="text-danger d-block mt-2">{{ session('error') }}</small> @endif
</form>
